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
class Payload
{

	public function __construct() {
	}

	/**
	* 
	*	Generate payload with registered claims [iss, iat, exp]
	*
	* @param var
	* @return array
	*/
	public function create($jti, $claims) {

		$timestamp = time();
		$payload = array(
			"iss" => env('JWT_ISS', 'LumenJWT'),
	    "iat" => $timestamp,
	    "exp" => $timestamp + env('JWT_EXP', 7200),
	    "jti" => $jti 
		);

		if($claims != NULL)
			$payload = array_merge($payload, $claims);

		return $payload;
	}

}