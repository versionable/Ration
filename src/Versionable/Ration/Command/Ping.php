<?php

namespace Versionable\Ration\Command;

class Ping implements CommandInterface
{
    public function getCommand()
    {
        return 'ping';
    }

    public function getParameters()
    {
        return array();
    }
}
