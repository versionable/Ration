<?php

namespace Versionable\Ration\Command;

class MultiCommand implements CommandInterface
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
