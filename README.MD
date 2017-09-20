# LumenJWT

LumenJWT is an Http guard for Lumen, a Laravel micro framework.

  - Create JWT using firebase/php-jwt
  - Guard Http requests

### Dependencies


* [firebase/php-jwt] - A simple library to encode and decode JSON Web Tokens (JWT) in PHP, conforming to RFC 7519.
* [php] - v5.6 +


### Installation


Use Composer to install LumenJWT and its the dependencies.

```sh
$ composer require cvogit/LumenJWT
$ composer install
```

### Configuration

In bootstrap/app.php enable the middleware:

```
$app->routeMiddleware([
    'jwt' => Cvogit\LumenJWT\Http\Middleware\JwtGuard::class,
]);
```

In `.env` 
 - Create `JWT_KEY` and give it a random string.
 - Create `JWT_EXP`, set the time until the token expire in seconds, if not set the default is 7200 seconds.

## Usage

Please visit the [Wiki](https://github.com/cvogit/lumen-jwt/wiki).

### Todos

 - Write JWT_KEY create command
 - Write phpunit tests
 - Add blacklist option

License
----

MIT
