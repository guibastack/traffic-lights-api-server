<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\User as User;
use App\Traits\TokenTrait as TokenTrait;
use App\Models\AuthToken as AuthToken;
use App\Http\Requests\AuthTokenRequest as AuthTokenRequest;

class AuthTokenController extends Controller {

    use TokenTrait;

    public function store(AuthTokenRequest $request): JsonResponse {

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

        dd($authToken);

    }

}
