<?php

namespace Versionable\Ration\Command;

class EchoCommand implements CommandInterface
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getCommand()
    {
        return 'echo';
    }

    public function getParameters()
    {
        return array($this->getMessage());
    }
}
