<?php

namespace Cvogit\LumenJWT;

use PHPUnit\Framework\TestCase;


/**
 * @covers Payload
 * @runTestsInSeparateProcesses
 */
final class PayloadTest extends TestCase
{
	private $payload;

	public function setUp() {
		parent::setUp();
		$this->payload = new Payload;
  }

	protected function tearDown()
	{	}

	public function testPayloadCanBeCreate() 
	{
		$this->assertInstanceOf(Payload::class, $this->payload);
	}
  
  /**
  * @covers               Payload::create
  */
  public function testCreateNoArguementIsValid()
  {
    $this->assertInternalType("array", $this->payload->create());
  }

  /**
  * @covers               Payload::create
  */
  public function testCreateJtiWithStringIsValid()
  {
  	$jti = "Signature";

    $this->assertInternalType("array", $this->payload->create($jti));
  }

  /**
  * @covers               Payload::create
  */
  public function testCreateJtiWithIntegerIsValid()
  {
  	$jti = 10101010;

    $this->assertInternalType("array", $this->payload->create($jti));
  }
  /**
  * @covers               Payload::create
  */
  public function testCreateJtiWithArrayIsValid()
  {
		$jti = array("key" => "value");

    $this->assertInternalType("array", $this->payload->create($jti));
  }

  /**
  * @covers               Payload::create
  */
  public function testCreateClaimWithArrayIsValid()
  {
  	$claims = array("key" => "value");

    $this->assertInternalType("array", $this->payload->create(NULL, $claims));
  }

  /**
  * @covers               Payload::create
	* @expectedException    InvalidArgumentException
	*/
  public function testCreateClaimWithNonArraythrowsException()
  {
  	$claims = "Non array type";
  	
    $this->assertInternalType("array", $this->payload->create(NULL, $claims));
  }

  /**
  * @covers               Payload::create
  */
  public function testCreateJtiAndClaimIsValid()
  {
  	$jti = "Signature";
  	$claims = array(
  		"extra" => "claims"
  		);

    $this->assertInternalType("array", $this->payload->create($jti, $claims));
  }
}