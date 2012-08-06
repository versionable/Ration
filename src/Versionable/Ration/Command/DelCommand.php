<?php

namespace Versionable\Ration\Command;

class DelCommand implements CommandInterface
{
    protected $keys;

    public function __construct(array $keys = array())
    {
        $this->keys = $keys;
    }

    public function getKeys()
    {
        return $this->keys;
    }

    public function setKeys(array $keys)
    {
        $this->keys = $keys;
    }

    public function addKey($key)
    {
        $keys = $this->getKeys();

        if (false === array_key_exists($key, $keys)) {
            $keys[] = $key;
        }

        $this->setKeys($keys);
    }

    public function getCommand()
    {
        return 'del';
    }

    public function getParameters()
    {
        return $this->getKeys();
    }
}
