<?php

namespace Versionable\Ration\Command;

class Expire extends Command implements CommandInterface
{
    const COMMAND = 'EXPIRE';
    
    /**
     * @param array $args 
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}