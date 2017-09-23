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

use Illuminate\Http\Request;

class Parser 
{

	public function __construct() 
	{

	}

	/**
	 * Parse the JWT from teh request
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * 
	 * @return mixed
	 */
	public function parse($request) {
		
		// Parse the token if it's send though the header
		if ($request->header('Authorization')) {
      list($type, $data) = explode(" ", $request->header('Authorization'), 2);
      return $data;
    }

    // Parse the token if it's passed as an input
    else if($request->input('token'))
      return $request->input('token');

    else
    	abort(404, "Request Denied, JWT token not found.");

	}

}