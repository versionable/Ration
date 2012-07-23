<?php

namespace Versionable\Ration\Command;

class PingCommand implements CommandInterface
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
