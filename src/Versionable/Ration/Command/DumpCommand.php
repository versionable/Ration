<?php

namespace Versionable\Ration\Command;

class DumpCommand implements CommandInterface
{
    protected $key;

    public function __construct($key = null)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getCommand()
    {
        return 'dump';
    }

    public function getParameters()
    {
        return array($this->getKey());
    }
}
