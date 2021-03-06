<?php

namespace Versionable\Ration\Command;

use Versionable\Ration\Command\ExecCommand;

/**
 * Test class for ExecCommand.
 * Generated by PHPUnit on 2012-07-23 at 17:59:31.
 */
class ExecCommandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ExecCommand
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ExecCommand;
    }

    /**
     * @covers Versionable\Ration\Command\ExecCommand::getCommand
     */
    public function testGetCommand()
    {
        $this->assertEquals('exec', $this->object->getCommand());
    }

    /**
     * @covers Versionable\Ration\Command\ExecCommand::getParameters
     */
    public function testGetParameters()
    {
        $this->assertEquals(array(), $this->object->getParameters());
    }

}