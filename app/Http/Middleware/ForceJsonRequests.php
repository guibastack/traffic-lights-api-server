<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request as Request;
use \Closure as Closure;
use Symfony\Component\HttpFoundation\Response as Response;

class ForceJsonRequests {

    public function handle(Request $request, Closure $next): Response {

        $request->headers->set('accept', 'application/json');

        return $next($request);

    } 

}
