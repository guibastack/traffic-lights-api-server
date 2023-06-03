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

            if ($this->tokenIsExpired(new DateTime($authToken->expires_at))) {

                return $this->responseInJSON(401, 'The authentication token provided is expired.', [
                    'email_provided' => $request->email,
                    'auth_token_provided' => $request->auth_token,
                    'auth_token_expired_at' => $authToken->expires_at,
                ]);

            }
    
            $bearerToken = new BearerToken();
            $bearerToken->bearer_token = $this->generateToken(config('auth.bearer_token_size'));
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

}
