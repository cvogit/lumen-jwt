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

use \InvalidArgumentException;
use \RuntimeException;

class Payload
{

	public function __construct() {
	}

	/**
	* 
	*	Generate payload with registered claims [iss, iat, exp]
	*
	* @param var
	* @param array
	*
	* @throws InvalidArgumentException 	Provided $claims is not an array.
	* @throws RuntimeException 					JWT_EXP is configured incorrectly.
	*
	* @return array
	*/
	public function create($jti, $claims) {

		if($claims != NULL && !is_array($claims))
			throw new InvalidArgumentException("Provided claims need to be an array.");

		$jwt_exp = env("JWT_EXP", 7200);

		if(!is_int($jwt_exp))
			throw new RuntimeException("JWT_EXP is configured incorrectly in .env file.");

		$timestamp = time();

		$exp = $timestamp + $jwt_exp;

		$payload = array(
			"iss" => env('JWT_ISS', 'LumenJWT'),
	    "iat" => $timestamp,
	    "exp" => $exp,
	    "jti" => $jti 
		);

		if($claims != NULL)
			$payload = array_merge($payload, $claims);

		return $payload;
	}

}