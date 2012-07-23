<?php

namespace Versionable\Ration\Command;

class RenameCommand implements CommandInterface
{
    protected $key;
    
    protected $newKey;

    public function __construct($key, $newKey)
    {
        $this->key = $key;
        $this->newKey = $newKey;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }
    
    public function getNewKey()
    {
        return $this->newKey;
    }

    public function setNewKey($newKey)
    {
        $this->newKey = $newKey;
    }

    public function getCommand()
    {
        return 'rename';
    }

    public function getParameters()
    {
        return array(
            $this->getKey(),
            $this->getNewKey()
        );
    }
}
