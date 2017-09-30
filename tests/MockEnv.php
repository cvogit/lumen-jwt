<?php

namespace Cvogit\LumenJWT;

// Mocking Lumen .env file function

function env($env, $custom = NULL)
{
  if($env === "JWT_EXP")
    return 60;
  else if($env === "JWT_ISS")
    return "Phpunit test";
  else if($env === "JWT_KEY")
    return "key";
  else if($env === "JWT_ALG")
    return "HS256";
}