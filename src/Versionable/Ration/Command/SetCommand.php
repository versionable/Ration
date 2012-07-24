<?php

namespace Versionable\Ration\Command;

class SetCommand implements CommandInterface
{
    protected $key;

    protected $value;

    public function __construct($key = null, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCommand()
    {
        return 'set';
    }

    public function getParameters()
    {
        return array($this->getKey(), $this->getValue());
    }
}
