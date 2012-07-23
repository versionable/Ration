<?php

namespace Versionable\Ration\Command;

class AuthCommand implements CommandInterface
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCommand()
    {
        return 'auth';
    }

    public function getParameters()
    {
        return array($this->getPassword());
    }
}
