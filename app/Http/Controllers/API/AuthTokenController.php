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

class AuthTokenController extends Controller {

    use TokenTrait, ResponseTrait;

    public function store(AuthTokenRequest $request): JsonResponse {

        try {
            
            $user = User::where('email', '=', $request->email)->first();
            
            if ($user == null) {
    
                $user = new User();
                $user->email = $request->email;
                $user->save();
    
            }

            $authToken = new AuthToken();
            $authToken->auth_token = $this->generateToken(config('auth.auth_token_size'));
            $authToken->user = $user->id;
            $authToken->save();
            
            return $this->responseInJSON(200, 'A token has been generated and sent to your email.', [
                'email_provided' => $request->email,
            ]);

        } catch (Exception $exception) {
            
            return $this->responseInJSON(500, 'Internal Server Error. Try again later.', null);

        }

    }

}
