<?php

namespace Cvogit\LumenJWT\Http\Middleware;

use Closure;
use \InvalidArgumentException;
use \RuntimeException;
use Illuminate\Http\Request;
use Cvogit\LumenJWT\JWT;
use Cvogit\LumenJWT\Parser;

class JwtGuard
{
	/**
	 * The parsed jwt
	 *
	 */
	protected $jwt;

	/**
	 * The parser
	 *
	 */
	protected $parser;

	/**
	 * Create a new middleware instance.
	 *
	 * @param  
	 * @return void
	 */
	public function __construct(JWT $jwt, Parser $parser)
	{
		$this->jwt = $jwt;
		$this->parser = $parser;
	}

	/**
	 * Run the request filter.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * 
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{

		try {
			$token = $this->parser->parse($request);
		}	catch (RuntimeException $e) {
			abort(404, $e->getMessage());
    }

		try {
			$payload = $this->jwt->decode($token);
		} catch(InvalidArgumentException $e){
			abort(404, $e->getMessage());
    }

		if($payload["exp"] >= $payload["iat"])
			return $next($request);
		
		abort(404, "Token expired, please log in again.");
	}

}