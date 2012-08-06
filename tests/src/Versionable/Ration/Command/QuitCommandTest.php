<?php

namespace Versionable\Ration\Command;

use Versionable\Ration\Command\QuitCommand;

/**
 * Test class for QuitCommand.
 * Generated by PHPUnit on 2012-07-23 at 17:59:29.
 */
class QuitCommandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var QuitCommand
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new QuitCommand;
    }

    /**
     * @covers Versionable\Ration\Command\QuitCommand::getCommand
     */
    public function testGetCommand()
    {
        $this->assertEquals('quit', $this->object->getCommand());
    }

    /**
     * @covers Versionable\Ration\Command\QuitCommand::getParameters
     */
    public function testGetParameters()
    {
        $this->assertEquals(array(), $this->object->getParameters());
    }

}
