<?php

namespace Cvogit\LumenJWT;

// Mocking Lumen Request object

final class MockRequest 
{
  public $header;

  public $input;

  public function __construct() 
  {

  }

  public function header($var)
  {
    if ($var === 'Authorization')
      return $this->header;
  }

  public function input($var)
  {
    if ($var === 'token')
      return $this->input;
  }

  public function setHeader($var)
  {
    $this->header = $var;
  }

  public function setInput($var)
  {
    $this->input = $var;
  }

}