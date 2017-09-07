<?php

namespace Cvogit\LumenJWT\Provider;

use Illuminate\Support\ServiceProvider;

class JwtServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //Register Our Package routes
    include __DIR__.'/../routes.php';

    // Register Controller
    $this->app->make('Cvogit\LumenJWT\Controller\JwtController');

    //$this->app->routeMiddleware('jwt', Cvogit\LumenJWT\Middleware\Jwt::class);
  }

  /**
   * Boot the authentication services for the application.
   *
   * @return void
   */
  public function boot()
  {

  }
}
