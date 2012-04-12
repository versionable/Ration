<?php

namespace Versionable\Ration\Command;

class FlushAll extends Command implements CommandInterface
{
    const COMMAND = 'FLUSHALL';

    /**
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}