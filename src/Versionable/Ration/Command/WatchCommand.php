<?php

namespace Versionable\Ration\Command;

class WatchCommand implements CommandInterface
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

    public function getCommand()
    {
        return 'watch';
    }

    public function getParameters()
    {
        return $this->keys;
    }
}
