<?php

namespace Versionable\Ration\Response;

use Versionable\Ration\Response\Response;

/**
 * Test class for Response.
 * Generated by PHPUnit on 2012-07-23 at 16:54:10.
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Response
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Response;
    }
    
    /**
     * @covers Versionable\Ration\Response\Response::getContent
     */
    public function testGetContent()
    {
        $this->assertNull($this->object->getContent());
    }

    /**
     * @depends testGetContent
     * @covers Versionable\Ration\Response\Response::setContent
     * @covers Versionable\Ration\Response\Response::getContent
     */
    public function testSetContent()
    {
        $content = 'test';
        
        $this->object->setContent($content);
        $this->assertEquals($content, $this->object->getContent());
    }

    /**
     * @covers Versionable\Ration\Response\Response::parse
     * @expectedException Versionable\Ration\Response\Exception\ResponseException
     */
    public function testParseException()
    {
        $raw = '-';
        
        $this->setExpectedExceptionFromAnnotation();
        $this->object->parse($raw);
    }
    
    /**
     * @depends testGetContent
     * @depends testSetContent
     * @covers Versionable\Ration\Response\Response::setContent
     * @covers Versionable\Ration\Response\Response::getContent
     * @covers Versionable\Ration\Response\Response::parse
     */
    public function testParseOk()
    {
        $raw = '+OK';
        
        $this->object->parse($raw);
        $this->assertTrue($this->object->getContent());
    }
    
    /**
     * @depends testGetContent
     * @depends testSetContent
     * @covers Versionable\Ration\Response\Response::setContent
     * @covers Versionable\Ration\Response\Response::getContent
     * @covers Versionable\Ration\Response\Response::parse
     */
    public function testParseInteger()
    {
        $raw = ':2';
        
        $this->object->parse($raw);
        $this->assertEquals(2, $this->object->getContent());
    }
    
    /**
     * @depends testGetContent
     * @depends testSetContent
     * @covers Versionable\Ration\Response\Response::setContent
     * @covers Versionable\Ration\Response\Response::getContent
     * @covers Versionable\Ration\Response\Response::parse
     */
    public function testParse()
    {
        $raw = 'test';
     
        $this->object->parse($raw);
        $this->assertEquals($raw, $this->object->getContent());
    }
}