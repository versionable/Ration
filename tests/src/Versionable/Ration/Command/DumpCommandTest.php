<?php

namespace Versionable\Ration\Command;

use Versionable\Ration\Command\DumpCommand;

/**
 * Test class for DumpCommand.
 * Generated by PHPUnit on 2012-07-23 at 17:59:29.
 */
class DumpCommandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DumpCommand
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DumpCommand;
    }

    /**
     * @covers Versionable\Ration\Command\DumpCommand::getKey
     */
    public function testGetKey()
    {
        $this->assertNull($this->object->getKey());
    }

    /**
     * @depends testGetKey
     * @covers Versionable\Ration\Command\DumpCommand::setKey
     * @covers Versionable\Ration\Command\DumpCommand::getKey
     */
    public function testSetKey()
    {
        $key = 'test';
        
        $this->object->setKey($key);
        $this->assertEquals($key, $this->object->getKey());
    }

    /**
     * @covers Versionable\Ration\Command\DumpCommand::getCommand
     */
    public function testGetCommand()
    {
        $this->assertEquals('dump', $this->object->getCommand());
    }

    /**
     * @covers Versionable\Ration\Command\DumpCommand::getParameters
     */
    public function testGetParameters()
    {
        $this->assertEquals(array(null), $this->object->getParameters());
    }

}