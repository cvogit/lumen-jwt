<?php

namespace Cvogit\LumenJWT\Http\Middleware;

use Closure;
use \Exception;
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
	 * @var  \Cvogit\LumenJWT\JWT  $jwt
	 */
	protected $jwt;

	/**
	 * The parser
	 *
	 * @var  \Cvogit\LumenJWT\Parser  $parser
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
			return response()->json(['message' => $e->getMessage()], 404);
    }

		try {
			$payload = $this->jwt->decode($token);
		} catch (Exception $e) {
    	return response()->json(['message' => $e->getMessage()], 404);
    }

		return $next($request);
	}

}