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

class JWT
{

	/**
	* The Algorithm to encode and decode the JWT
	*
	*/
	private $alg;

	/**
	* The decoded JWT object
	*
	*/
	private $decoded;

	/**
	* The JWT
	*
	*/
	private $jwt;

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

	public function __construct(Payload $payload) {
		$this->key = env('JWT_KEY');
		$this->alg = env('JWT_ALG', 'HS256');
		$this->payload = $payload;
	}

	/**
	* Create the default JWT
	*
	* @return JWT 
	*/
	public function create($jti = NULL, $claims = NULL) {
		
		$this->jwt = fireJWT::encode($this->payload->create($jti, $claims), $this->key, $this->alg);

		return $this->jwt;
	}

	/**
	* Decode the JWT and obtain the payload
	*
	* @param JWT
	* @return array
	*/
	public function decode($jwt) {

		$this->decoded = fireJWT::decode($jwt, $this->key, array('HS256'));

		return (array) $this->decoded;
	}
	
}