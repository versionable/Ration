<?php

namespace Versionable\Ration\Command;

class ExpireCommand implements CommandInterface
{
    protected $key;

    protected $seconds;

    public function __construct($key = null, $seconds = 0)
    {
        $this->key = $key;
        $this->seconds = $seconds;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getSeconds()
    {
        return $this->seconds;
    }

    public function setSeconds($seconds)
    {
        $this->seconds = $seconds;
    }

    public function getCommand()
    {
        return 'expire';
    }

    public function getParameters()
    {
        return array(
            $this->getKey(),
            $this->getSeconds()
        );
    }
}
