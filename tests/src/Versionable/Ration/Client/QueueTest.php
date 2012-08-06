<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Client\Queue;

/**
 * Test class for Queue.
 * Generated by PHPUnit on 2012-07-23 at 16:59:05.
 */
class QueueTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Queue
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Queue;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }
    
    /**
     * @covers Versionable\Ration\Client\Queue::getConnection
     */
    public function testGetConnection()
    {
        $this->assertNull($this->object->getConnection());
    }
    
    /**
     * @depends testGetConnection
     * @covers Versionable\Ration\Client\Queue::setConnection
     * @covers Versionable\Ration\Client\Queue::getConnection
     */
    public function testSetConnection()
    {
        $connection = $this->getMock('Versionable\Ration\Connection\ConnectionInterface');
        
        $this->object->setConnection($connection);
        $this->assertEquals($connection, $this->object->getConnection());
    }
    
    /**
     * @covers Versionable\Ration\Client\Queue::getQueue
     */
    public function testGetQueue()
    {
        $this->assertInstanceOf('\\SplQueue', $this->object->getQueue());
    }
    
    /**
     * @depends testGetQueue
     * @covers Versionable\Ration\Client\Queue::reset
     * @covers Versionable\Ration\Client\Queue::getQueue
     */
    public function testReset()
    {
        $this->assertInstanceOf('\\SplQueue', $this->object->reset());
    }
    
    /**
     * @depends testGetQueue
     * @covers Versionable\Ration\Client\Queue::queue
     * @covers Versionable\Ration\Client\Queue::getQueue
     */
    public function testQueue()
    {
        $request = $this->getMock('Versionable\Ration\Request\Request');
        $queue = new \SplQueue();
        $queue->push($request);
        
        $this->object->send($request);
        
        $this->assertEquals($queue, $this->object->getQueue());
    }

    /**
     * @depends testGetQueue
     * @covers Versionable\Ration\Client\Queue::send
     * @covers Versionable\Ration\Client\Queue::getQueue
     */
    public function testSend()
    {
        $request = $this->getMock('Versionable\Ration\Request\Request');
        $queue = new \SplQueue();
        $queue->push($request);
        
        $this->object->send($request);
        
        $this->assertEquals($queue, $this->object->getQueue());
    }

    /**
     * @depends testSetConnection
     * @depends testGetConnection
     * @depends testQueue
     * @depends testGetQueue
     * @covers Versionable\Ration\Client\Queue::flush
     * @covers Versionable\Ration\Client\Queue::setConnection
     * @covers Versionable\Ration\Client\Queue::getConnection
     * @covers Versionable\Ration\Client\Queue::getQueue
     * @covers Versionable\Ration\Client\Queue::queue
     */
    public function testFlush()
    {
        $request = $this->getMock('Versionable\Ration\Request\Request');
        $response = $this->getMock('Versionable\Ration\Response\Response');
        $responseCollection = new \SplObjectStorage();
        
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
        
        $this->object->setConnection($connection);
        $this->object->queue($request);
        
        $responseCollection->attach($request, $response);
        
        $this->assertEquals($responseCollection, $this->object->flush());
    }
}