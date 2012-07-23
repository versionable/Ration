<?php

namespace Versionable\Ration\Command;

class DelCommand implements CommandInterface
{
    protected $keys;

    public function __construct(array $key = null)
    {
        $this->keys = $keys;
    }

    public function getKeys()
    {
        return $this->keys;
    }

    public function setKeys(array $key)
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
        return 'ttl';
    }

    public function getParameters()
    {
        return $this->getKeys();
    }
}
