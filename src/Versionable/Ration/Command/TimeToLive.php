<?php

namespace Versionable\Ration\Command;

class TimeToLive extends Command implements CommandInterface
{
    const COMMAND = 'TTL';
    
    /**
     * @param array $args 
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}