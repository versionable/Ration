<?php

namespace Versionable\Ration\Command;

use Versionable\Ration\Command\TTLCommand;

/**
 * Test class for TTLCommand.
 * Generated by PHPUnit on 2012-07-23 at 17:59:29.
 */
class TTLCommandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TTLCommand
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TTLCommand;
    }

    /**
     * @covers Versionable\Ration\Command\TTLCommand::getKey
     */
    public function testGetKey()
    {
        $this->assertNull($this->object->getKey());
    }

    /**
     * @depends testGetKey
     * @covers Versionable\Ration\Command\TTLCommand::setKey
     * @covers Versionable\Ration\Command\TTLCommand::getKey
     */
    public function testSetKey()
    {
        $key = 'test';
        
        $this->object->setKey($key);
        $this->assertEquals($key, $this->object->getKey());
    }

    /**
     * @covers Versionable\Ration\Command\TTLCommand::getCommand
     */
    public function testGetCommand()
    {
        $this->assertEquals('ttl', $this->object->getCommand());
    }

    /**
     * @covers Versionable\Ration\Command\TTLCommand::getParameters
     */
    public function testGetParameters()
    {
        $this->assertEquals(array(null), $this->object->getParameters());
    }

}