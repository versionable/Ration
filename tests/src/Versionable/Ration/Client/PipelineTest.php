<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Client\Pipeline;

/**
 * Test class for Pipeline.
 * Generated by PHPUnit on 2012-07-23 at 16:59:05.
 */
class PipelineTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Pipeline
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Pipeline;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers Versionable\Ration\Client\Pipeline::setConnection
     */
    public function testSetConnection()
    {
        $connection = $this->getMock('Versionable\Ration\Connection\ConnectionInterface');
        
        $this->object->setConnection($connection);
        $this->assertEquals($connection, $this->object->getConnection());
    }

    /**
     * @covers Versionable\Ration\Client\Pipeline::getConnection
     */
    public function testGetConnection()
    {
        $this->assertNull($this->object->getConnection());
    }

    /**
     * @covers Versionable\Ration\Client\Pipeline::getStack
     */
    public function testGetStack()
    {
        $this->assertInstanceOf('\\SplStack', $this->object->getStack());
    }
    
    /**
     * @depends testGetStack
     * @covers Versionable\Ration\Client\Pipeline::getStack
     * @covers Versionable\Ration\Client\Pipeline::reset
     */
    public function testReset()
    {
        $this->assertInstanceOf('\\SplStack', $this->object->reset());
    }

    /**
     * @depends testGetStack
     * @covers Versionable\Ration\Client\Pipeline::send
     * @covers Versionable\Ration\Client\Pipeline::getStack
     */
    public function testSend()
    {
        $request = $this->getMock('Versionable\Ration\Request\Request');
        $stack = new \SplStack();
        $stack->push($request);
        
        $this->object->send($request);
        
        $this->assertEquals($stack, $this->object->getStack());
    }

    /**
     * @depends testSetConnection
     * @depends testGetConnection
     * @covers Versionable\Ration\Client\Pipeline::setConnection
     * @covers Versionable\Ration\Client\Pipeline::getConnection
     * @covers Versionable\Ration\Client\Pipeline::flush
     */
    public function testFlush()
    {
        $request = $this->getMock('Versionable\Ration\Request\Request');
        $response = $this->getMock('Versionable\Ration\Response\Response', array(
            'getContent'
        ));
        
        $response->expects($this->any())
                 ->method('getContent')
                 ->will($this->returnValue('QUEUED'));
        
        $connection = $this->getMock('Versionable\Ration\Connection\ConnectionInterface', array(
            'call',
            'connect',
            'disconnect',
            'readLength',
            'read',
            'write',
            'parseResponse'
        ));
        
        $connection->expects($this->any())
                   ->method('call')
                   ->will($this->returnValue($response));
        
        $this->object->send($request);
        $this->object->setConnection($connection);
        $this->assertEquals($response, $this->object->flush());
    }
    
    /**
     * @depends testSetConnection
     * @depends testGetConnection
     * @covers Versionable\Ration\Client\Pipeline::setConnection
     * @covers Versionable\Ration\Client\Pipeline::getConnection
     * @covers Versionable\Ration\Client\Pipeline::flush
     * @covers Versionable\Ration\Command\Exception\PipelineException
     * @expectedException Versionable\Ration\Command\Exception\PipelineException
     */
    public function testFlushException()
    {
        $request = $this->getMock('Versionable\Ration\Request\Request');
        $response = $this->getMock('Versionable\Ration\Response\Response', array(
            'getContent'
        ));
        
        $response->expects($this->any())
                 ->method('getContent')
                 ->will($this->returnValue('FAIL'));
        
        $connection = $this->getMock('Versionable\Ration\Connection\ConnectionInterface', array(
            'call',
            'connect',
            'disconnect',
            'readLength',
            'read',
            'write',
            'parseResponse'
        ));
        
        $connection->expects($this->any())
                   ->method('call')
                   ->will($this->returnValue($response));
        
        $this->object->send($request);
        $this->object->setConnection($connection);
        $this->assertEquals($response, $this->object->flush());
    }
}