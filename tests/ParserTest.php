<?php

namespace Cvogit\LumenJWT;

use PHPUnit\Framework\TestCase;

/**
 * @covers Parser
 */
final class ParserTest extends TestCase
{

	private $parser;

  private $request;

	public function setUp() {
		parent::setUp();
		$this->parser = new Parser;
    $this->request = new MockRequest;

  }

	protected function tearDown()
	{

	}
  
  public function testParserCanBeCreate()
  {
    $this->assertInstanceOf(Parser::class, $this->parser);
  }

  public function testCanParseValidHeaderJwt()
  {
    $this->request->setHeader("Bearer JWT");

    $this->assertEquals("JWT", $this->parser->parse($this->request));
  }

  public function testCanParseValidInputJwt()
  {
    $this->request->setInput("JWT");

    $this->assertEquals("JWT", $this->parser->parse($this->request));
  }

  /**
    * @expectedException     RuntimeException
    * 
    */
  public function testNoJwtIsInvalid()
  {
    $this->parser->parse($this->request);
  }
}