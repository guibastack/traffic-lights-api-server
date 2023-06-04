<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\User as User;
use App\Traits\TokenTrait as TokenTrait;
use App\Models\AuthToken as AuthToken;
use App\Http\Requests\AuthTokenRequest as AuthTokenRequest;
use \Exception as Exception;
use App\Traits\ResponseTrait as ResponseTrait;
use App\Models\Profile as Profile;
use App\Jobs\SendAuthTokenMessage as SendAuthTokenMessage;

class AuthTokenController extends Controller {

    use TokenTrait, ResponseTrait;

    public function store(AuthTokenRequest $request): JsonResponse {

        try {
            
            $user = User::where('email', '=', $request->email)->first();
            
            if ($user == null) {
    
                $user = new User();
                $user->email = $request->email;
                $user->save();

                $profile = new Profile();
                $profile->user = $user->id;
                $profile->save();

            }

            $authToken = new AuthToken();

            /*

                As the token generation and token uniqueness check methods are
                decoupled, this action is the one putting both methods
                together to form the final token generation logic.

                An important point to be aware of in this type of logic is that
                the lower the probability of generating different token (range),
                the greater the probability of an infinite loop being 
                generated on the server.

                To avoid this, throw an exception whenever the loop below 
                reaches a retry limit.

                I didn't implement the solution for the infinite looping, because
                the generation range of both tokens (auth and bearer) is too big
                for this application and for the amount of users I expect to
                receive. Perhaps in the future it will be necessary. In that 
                case, I'll leave this comment block as a 'ToDo'.

            */

            do {

                $authToken->auth_token = $this->generateToken(config('auth.auth_token_size'));

            } while (!$this->tokenIsUnique(new AuthToken(), 'auth_token', $authToken->auth_token, [
                'user' => $user->id,
            ]));

            $authToken->user = $user->id;
            $authToken->expires_at = null;
            $authToken->save();

            /*
                I did not register the validity of the token (below) with the 
                registration section of the rest of the token data (above)
                to avoid any type of delay that could be caused between the
                moment of sending the information and the actual 
                registration in the database, penalizing the datetime token
                validity.
            */

            $authToken->expires_at = $this->calculateTokenExpiryTime($authToken->created_at, config('auth.auth_token_duration'));
            $authToken->save();

            SendAuthTokenMessage::dispatch($user->email, $authToken->auth_token, $user->profile->name == null ? $user->email : $user->profile->name)->onQueue('default');

            return $this->responseInJSON(200, 'A token has been generated and sent to your email.', [
                'email_provided' => $request->email,
            ]);

        } catch (Exception $exception) {
            
            return $this->responseInJSON(500, 'Internal Server Error. Try again later.', null);

        }

    }

}
