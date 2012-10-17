<?php

namespace Versionable\Ration\Command;

use Versionable\Ration\Command\ExecCommand;

/**
 * Test class for ExecCommand.
 * Generated by PHPUnit on 2012-07-23 at 17:59:31.
 */
class WatchCommandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var WatchCommand
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new WatchCommand;
    }

    /**
     * @covers Versionable\Ration\Command\WatchCommand::getCommand
     */
    public function testGetCommand()
    {
        $this->assertEquals('watch', $this->object->getCommand());
    }

    /**
     * @covers Versionable\Ration\Command\WatchCommand::getParameters
     */
    public function testDefaultGetParameters()
    {
        $this->assertEquals(array(), $this->object->getParameters());
    }

    public function testGetKeys()
    {
        $expected = array("test");
        $this->assertEquals(array(), $this->object->getKeys());
        $this->object->setKeys($expected);
        $this->assertEquals($expected, $this->object->getKeys());
        $this->assertEquals($expected, $this->object->getParameters());
    }

}