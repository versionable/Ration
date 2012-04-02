<?php

namespace Versionable\Ration\Command;

class Keys extends Command implements CommandInterface
{
    const COMMAND = 'KEYS';

    /**
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}