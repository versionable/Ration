<?php

namespace Versionable\Ration\Command;

class Multi extends Command implements CommandInterface
{
    const COMMAND = 'MULTI';

    /**
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}