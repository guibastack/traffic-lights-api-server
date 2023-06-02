<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\User as User;
use App\Traits\ResponseTrait as ResponseTrait;
use App\Traits\TokenTrait as TokenTrait;
use App\Models\BearerToken as BearerToken;

class BearerTokenController extends Controller {

    use ResponseTrait, TokenTrait;

    public function store(Request $request): JsonResponse {

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

        $bearerToken = new BearerToken();
        $bearerToken->bearer_token = $this->generateToken(config('auth.bearer_token_size'));
        $bearerToken->auth_token = $authToken->id;
        $bearerToken->save();

        return $this->responseInJSON(200, 'A new bearer token has been generated. The provided authentication token can no longer be used to generate new bearer tokens.', [
            'email_provided' => $request->email,
            'auth_token_provided' => $request->auth_token,
            'bearer_token' => $bearerToken->bearer_token,
            'bearer_token_created_at' => $bearerToken->created_at->format('d-m-y H:i:s'),
        ]);

    }

}