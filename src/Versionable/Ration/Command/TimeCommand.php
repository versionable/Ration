<?php

namespace Versionable\Ration\Command;

class TimeCommand implements CommandInterface
{
    public function getCommand()
    {
        return 'time';
    }

    public function getParameters()
    {
        return array();
    }
}
