<?php

namespace Versionable\Ration\Command;

class Delete extends Command implements CommandInterface
{
    const COMMAND = 'DEL';

    /**
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}