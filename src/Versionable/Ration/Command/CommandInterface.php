<?php

namespace Versionable\Ration\Command;

interface CommandInterface
{
    /**
     * This function builds the command and returns it as a string
     *
     * @abstract
     * @return string
     */
    public function build();
}