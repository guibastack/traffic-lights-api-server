<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request as Request;
use \Closure as Closure;
use Symfony\Component\HttpFoundation\Response as Response;
use App\Traits\ResponseTrait as ResponseTrait;
use App\Models\BearerToken as BearerToken;
use \Exception as Exception;

class ProtectAPIRoutes {

    use ResponseTrait;

    public function handle(Request $request, Closure $next): Response {
        
        try {
            
            if ($request->bearerToken() == null) {
                
                return $this->responseInJSON(401, 'There is no bearer token in the request.', [
                    'bearer_token_provided' => $request->bearerToken(),
                ]);
    
            }
    
            $bearerToken = BearerToken::where('bearer_token', '=', $request->bearerToken())->first();
    
            if ($bearerToken == null) {
    
                return $this->responseInJSON(401, 'The provided bearer token is not linked to any user account.', [
                    'bearer_token_provided' => $request->bearerToken(),
                ]);
    
            }
    
            if ($bearerToken->isExpired()) {
    
                return $this->responseInJSON(409, 'The provided bearer token is expired.', [
                    'bearer_token_provided' => $request->bearerToken(),
                ]);
    
            }
    
            return $next($request);
            
        } catch (Exception $e) {

            return $this->responseInJSON(500, 'Internal Server Error. Try again later.', null);

        }

    }

}
