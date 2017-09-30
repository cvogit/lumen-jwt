<?php

namespace Cvogit\LumenJWT;

use PHPUnit\Framework\TestCase;
include "MockEnv.php";
include "MockRequest.php";

/**
 * @covers JWT
 * @runTestsInSeparateProcesses
 */
final class JWTTest extends TestCase
{

	private $jwt;

	private $request;

	public function setUp() {
		parent::setUp();
		$this->jwt= new JWT(new Payload, new Parser);
		$this->request = new MockRequest;
  }
	  
  /**
  * @covers               JWT::class
  */
	public function testJWTCanBeCreate()
	{
		$this->assertTrue(true);
	}

	/**
  * @covers               JWT::create
  */
	public function testCreateJwtWithoutArguementIsValid()
	{
		$this->assertInternalType("string", $this->jwt->create());
	}

	/**
  * @covers               JWT::create
  */
	public function testCreateJwtWithValidJtiIsValid()
	{
		$jti = "Signature";
		$this->assertInternalType("string", $this->jwt->create($jti));
	}

	/**
  * @covers               JWT::create
  */
	public function testCreateJwtWithValidClaimsIsValid()
	{
		$claims = array(
				"key" => "value"
			);
		$this->assertInternalType("string", $this->jwt->create(NULL, $claims));
	}

	/**
  * @covers               JWT::create
  */
	public function testCreateJwtWithValidtiAndClaimIsValid()
	{
		$jti = "Signature";
		$claims = array(
				"key" => "value"
			);
		$this->assertInternalType("string", $this->jwt->create($jti, $claims));
	}

	/**
  * @covers               JWT::create
	* @expectedException    Exception
	*/
  public function testCreateJwtWithInvalidClaimsThrowsException()
  {
  	$claims = "Non array type";
  	
    $this->assertInternalType("array", $this->jwt->create(NULL, $claims));
  }

  /**
  * @covers               JWT::decode
	*/
  public function testDecodeValidJwtIsValid()
  {
  	$token = $this->jwt->create();
  	
    $this->assertInternalType("array", $this->jwt->decode($token));
  }

  /**
  * @covers               JWT::decode
  * @expectedException    Exception
	*/
  public function testDecodeInvalidJwtThrowsException()
  {
		$invalid_token = "Not a token.";

    $this->assertInternalType("array", $this->jwt->decode($invalid_token));
  }

  /**
  * @covers               JWT::extract
	*/
  public function testExtractWithValidRequestIsValid()
  {
  	$token = $this->jwt->create("JWT");
  	$this->request->setHeader("Bearer ".$token);

  	$this->assertEquals("JWT", $this->jwt->extract($this->request)["jti"]);
  }

  /**
  * @covers               JWT::extract
  * @expectedException    Exception
	*/
  public function testExtractWithInvalidRequestThrowsException()
  {

  	$this->request->setHeader("Bearer NotValidJWT");

  	$this->assertNotEquals("JWT", $this->jwt->extract($this->request)["jti"]);
  }
}