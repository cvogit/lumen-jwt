<?php

namespace Cvogit\LumenJWT\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cvogit\LumenJWT\Parser;

class Jwt
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
	public function __construct(Parser $parser)
	{
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

		$this->jwt = $this->parser->parse($request);
		return $this->jwt;
	}

}