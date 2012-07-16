<?php

namespace Versionable\Ration\Command;

class Exists extends Command implements CommandInterface
{
    const COMMAND = 'EXISTS';
    
    /**
     * @param array $args 
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}