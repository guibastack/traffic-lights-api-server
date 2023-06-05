<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\User as User;
use App\Traits\ResponseTrait as ResponseTrait;
use App\Traits\TokenTrait as TokenTrait;
use App\Models\BearerToken as BearerToken;
use \Exception as Exception;
use App\Http\Requests\BearerTokenRequest as BearerTokenRequest;
use \DateTime as DateTime;
use Illuminate\Http\Request as Request;

class BearerTokenController extends Controller {

    use ResponseTrait, TokenTrait;

    public function store(BearerTokenRequest $request): JsonResponse {

        try {

            $user = User::where('email', '=', $request->email)->first();
            
            if ($user == null) {
                
                return $this->responseInJSON(401, 'The email address provided is not registered.', [
                    'email_provided' => $request->email,
                    'auth_token_provided' => $request->auth_token,
                ]);
    
            }
    
            $authToken = $user->authTokens->where('auth_token', '=', $request->auth_token)->first();
    
            if ($authToken == null) {
    
                return $this->responseInJSON(401, 'The provided authentication token is not linked to the provided email.', [
                    'email_provided' => $request->email,
                    'auth_token_provided' => $request->auth_token,
                ]);
    
            }
    
            if ($authToken->bearerToken != null) {
    
                return $this->responseInJSON(409, 'The provided authentication token has already been used.', [
                    'email_provided' => $request->email,
                    'auth_token_provided' => $request->auth_token,
                ]);
    
            }

            if ($authToken->isExpired()) {

                return $this->responseInJSON(401, 'The authentication token provided is expired.', [
                    'email_provided' => $request->email,
                    'auth_token_provided' => $request->auth_token,
                    'auth_token_expired_at' => $authToken->expires_at,
                ]);

            }
    
            $bearerToken = new BearerToken();

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

                $bearerToken->bearer_token = $this->generateToken(config('auth.bearer_token_size'));

            } while (!$this->tokenIsUnique(new BearerToken(), 'bearer_token', $bearerToken->bearer_token, null));

            $bearerToken->auth_token = $authToken->id;
            $bearerToken->expires_at = null;
            $bearerToken->save();

            /*
                I did not register the validity of the token (below) with the 
                registration section of the rest of the token data (above)
                to avoid any type of delay that could be caused between the
                moment of sending the information and the actual 
                registration in the database, penalizing the datetime token
                validity.
            */

            $bearerToken->expires_at = $this->calculateTokenExpiryTime($bearerToken->created_at, config('auth.bearer_token_duration'));
            $bearerToken->save();

            return $this->responseInJSON(200, 'A new bearer token has been generated. The provided authentication token can no longer be used to generate new bearer tokens.', [
                'email_provided' => $request->email,
                'auth_token_provided' => $request->auth_token,
                'bearer_token' => $bearerToken->bearer_token,
                'bearer_token_created_at' => $bearerToken->created_at->format('d-m-Y H:i:s'),
                'bearer_token_expires_at' => $bearerToken->expires_at->format('d-m-Y H:i:s'),
            ]);
        
        } catch (Exception $exception) {
            
            return $this->responseInJSON(500, 'Internal Server Error. Try again later.', null);

        }

    }

    public function destroy(Request $request): JsonResponse {

        try {

            if ($request->bearerToken() == null) {
                
                return $this->responseInJSON(400, 'Provide a bearer token.', [
                    'bearer_token_provided' => $request->bearerToken(),
                ]);
                
            }
            
            $bearerToken = BearerToken::where('bearer_token', '=', $request->bearerToken())->first();
    
            if ($bearerToken == null) {
    
                return $this->responseInJSON(400, 'The provided bearer token is not linked to any user account.', [
                    'bearer_token_provided' => $request->bearerToken(),
                ]);
    
            }
            
            if ($bearerToken->isExpired()) {
                
                if ($bearerToken->manually_expired_by_user_at != null) {
                    
                    return $this->responseInJSON(409, 'The provided bearer token has already been destroyed by the user.', [
                        'bearer_token_provided' => $request->bearerToken(),
                        'manually_expired_by_user_at' => $bearerToken->manually_expired_by_user_at,
                    ]);
    
                } else {
                    
                    return $this->responseInJSON(409, 'The provided bearer token is expired.', [
                        'bearer_token_provided' => $request->bearerToken(),
                        'bearer_token_expired_at' => $bearerToken->expires_at,
                    ]);
    
                }
    
            }
    
            $bearerToken->manually_expired_by_user_at = new DateTime('now');
            $bearerToken->save();
    
            return $this->responseInJson(200, 'The provided bearer token has been destroyed.', [
                'bearer_token_destroyed' => $request->bearerToken(),
                'manually_expired_by_user_at' => $bearerToken->manually_expired_by_user_at->format('Y-m-d H:i:s'),
            ]);
            
        } catch (Exception $e) {

            return $this->responseInJSON(500, 'Internal Server Error. Try again later.', null);

        }

    }

}
