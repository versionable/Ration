<?php

namespace Versionable\Ration\Command;

class Multi implements CommandInterface
{
    public function getCommand()
    {
        return 'multi';
    }

    public function getParameters()
    {
        return array();
    }
}
