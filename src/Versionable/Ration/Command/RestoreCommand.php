<?php

namespace Versionable\Ration\Command;

class RestoreCommand implements CommandInterface
{
    protected $key;

    protected $timeToLive;

    protected $value;

    public function __construct($key = null, $value = null, $timeToLive = 0)
    {
        $this->key = $key;
        $this->value = $value;
        $this->timeToLive = $timeToLive;
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

    public function getTimeToLive()
    {
        return $this->timeToLive;
    }

    public function setTimeToLive($timeToLive)
    {
        $this->timeToLive = $timeToLive;
    }

    public function getCommand()
    {
        return 'restore';
    }

    public function getParameters()
    {
        return array(
            $this->getKey(),
            $this->getTimeToLive(),
            $this->getValue()
        );
    }
}
