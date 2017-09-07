<?php

namespace Cvogit\LumenJWT\Middleware;

use Closure;

class Jwt
{
    /**
     * Create a new middleware instance.
     *
     * @param  
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('age') <= 200) {
            return "no";
        }

        return $next($request);
    }

}