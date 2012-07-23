<?php

namespace Versionable\Ration\Command;

class Exec implements CommandInterface
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