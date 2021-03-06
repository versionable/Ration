<?php

namespace Versionable\Ration\Command;

use Versionable\Ration\Command\TypeCommand;

/**
 * Test class for TypeCommand.
 * Generated by PHPUnit on 2012-07-23 at 17:59:30.
 */
class TypeCommandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TypeCommand
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TypeCommand;
    }

    /**
     * @covers Versionable\Ration\Command\TypeCommand::getKey
     */
    public function testGetKey()
    {
        $this->assertNull($this->object->getKey());
    }

    /**
     * @depends testGetKey
     * @covers Versionable\Ration\Command\TypeCommand::setKey
     * @covers Versionable\Ration\Command\TypeCommand::getKey
     */
    public function testSetKey()
    {
        $key = 'test';
        
        $this->object->setKey($key);
        $this->assertEquals($key, $this->object->getKey());
    }

    /**
     * @covers Versionable\Ration\Command\TypeCommand::getCommand
     */
    public function testGetCommand()
    {
        $this->assertEquals('type', $this->object->getCommand());
    }

    /**
     * @covers Versionable\Ration\Command\TypeCommand::getParameters
     */
    public function testGetParameters()
    {
        $this->assertEquals(array(null), $this->object->getParameters());
    }

}