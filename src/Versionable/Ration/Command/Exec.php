<?php

namespace Versionable\Ration\Command;

class Exec extends Command implements CommandInterface
{
    const COMMAND = 'EXEC';

    /**
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->args = $args;
    }
}