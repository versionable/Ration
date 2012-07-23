<?php

namespace Versionable\Ration\Command;

class PersistCommand implements CommandInterface
{
    protected $key;

    public function __construct($key)
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
        return 'persist';
    }

    public function getParameters()
    {
        return array($this->getKey());
    }
}
