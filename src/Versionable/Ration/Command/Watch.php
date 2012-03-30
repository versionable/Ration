<?php

namespace Versionable\Ration\Command;

class Watch extends Command implements CommandInterface
{
    const COMMAND = 'WATCH';

    /**
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}