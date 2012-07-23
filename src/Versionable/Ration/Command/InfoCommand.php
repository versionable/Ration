<?php

namespace Versionable\Ration\Command;

class InfoCommand implements CommandInterface
{
    public function getCommand()
    {
        return 'info';
    }

    public function getParameters()
    {
        return array();
    }
}
