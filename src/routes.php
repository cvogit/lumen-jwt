<?php

// $this->app->group(['middleware' => 'jwt'], function () use ($app) {
//   $this->app->get('jwt', 'Cvogit\LumenJWT\Controller\JwtController@jwt');
// });

$this->app->get('jwt', ['middleware' => 'jwt', 'uses' => 'Cvogit\LumenJWT\Controller\JwtController@jwt']);