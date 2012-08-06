<?php

namespace Versionable\Ration\Command;

interface CommandInterface
{
    /**
     * Get the command as a string
     *
     * @return string
     */
    public function getCommand();

    /**
     * Get the command parameters
     *
     * @return array
     */
    public function getParameters();
}
