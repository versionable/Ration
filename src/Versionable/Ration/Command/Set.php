<?php

namespace Versionable\Ration\Command;

class Set extends Command implements CommandInterface
{
    const COMMAND = 'SET';
    
    protected $args;
    
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}