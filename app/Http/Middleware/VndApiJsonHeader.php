<?php

namespace App\Http\Middleware;

use Closure;

class VndApiJsonHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Content-Type','application/vnd.api+json');
        return $response;
    }
}
