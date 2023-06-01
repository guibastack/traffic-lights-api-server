<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Http\JsonResponse as JsonResponse;
use App\Models\User as User;

class AuthToken extends Controller {

    public function store(Request $request): JsonResponse {

        $user = User::where('email', '=', $request->email)->first();

        if ($user == null) {

            $user = new User();
            $user->email = $request->email;
            $user->save();
    
            dd("{$request->email} saved. :)");

        }

        dd("{$request->email} already exists. :D");

    }

}
