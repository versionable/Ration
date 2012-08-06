<?php

namespace Versionable\Ration\Command;

class ExecCommand implements CommandInterface
{
    public function getCommand()
    {
        return 'exec';
    }

    public function getParameters()
    {
        return array();
    }
}
