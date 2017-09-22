<?php

namespace Cvogit\LumenJWT;

/**
 * A Lumen middleware package to guard routes and transfer data
 * using firebase/php-jwt implementation of JWT
 * 
 * @category Authentication
 * @author Calvin Vo <cvogit@gmail.com>
 * 
 */

use Firebase\JWT\JWT as fireJWT;
use Cvogit\LumenJWT\Payload;
use Cvogit\LumenJWT\Parser;

class JWT
{

	/**
	* The Algorithm to encode and decode the JWT
	*
	*/
	private $alg;

	/**
	* The key to sign JWT
	* set in .env file as JWT_KEY
	* 
	*/
	private $key;

	/**
	* The payload, could be customize 
	* with custom function
	* 
	*/
	private $payload;

	/**
	* The parser object
	* extract JWT from http request
	* 
	*/
	private $parser;

	public function __construct(Payload $payload, Parser $parser) {
		
		$this->key = env('JWT_KEY');
		if(is_null($this->key))
			throw new RuntimeException("JWT_KEY is not set in .env file.");

		$this->alg = env('JWT_ALG', 'HS256');
		$this->payload = $payload;
		$this->parser = $parser;
	}

	/**
	* Create the default JWT
	*
	* @return JWT 
	*/
	public function create($jti = NULL, $claims = NULL) {
		
		$jwt = fireJWT::encode($this->payload->create($jti, $claims), $this->key, $this->alg);

		return $jwt;
	}

	/**
	* Decode the JWT and obtain the payload
	*
	* @param JWT
	* @return array
	*/
	public function decode($jwt) {

		$decoded = fireJWT::decode($jwt, $this->key, array($this->alg));

		return (array) $decoded;
	}
	
	/**
	* Extract the JWT from the request and decode it
	*
	* @param \Illuminate\Http\Request  $request
	* @return array
	*/
	public function extract($request) {

		$jwt = $this->parser->parse($request);
		
		return self::decode($jwt);
	}
}