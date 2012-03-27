<?php

namespace Versionable\Ration\Command;

class Get extends Command implements CommandInterface
{
    const COMMAND = 'GET';
    
    protected $args;
    
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}