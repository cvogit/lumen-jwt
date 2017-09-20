<?php

namespace Cvogit\LumenJWT\Http\Middleware;

use Closure;
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
	 * The parser
	 *
	 */
	protected $payload;

	/**
	 * The parser
	 *
	 */
	protected $token;


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
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{

		$this->token = $this->parser->parse($request);
		$this->payload = $this->jwt->decode($this->token);

		if($this->payload["exp"] >= $this->payload["iat"])
			return $next($request);
		
		abort("Token expired, please log in again.");
	}

}