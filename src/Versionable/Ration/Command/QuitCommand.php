<?php

namespace Versionable\Ration\Command;

class QuitCommand implements CommandInterface
{
    public function getCommand()
    {
        return 'quit';
    }

    public function getParameters()
    {
        return array();
    }
}
