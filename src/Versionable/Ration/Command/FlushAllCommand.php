<?php


namespace Versionable\Ration\Command;

class FlushAllCommand implements CommandInterface
{

    /**
     * Get the command as a string
     *
     * @return string
     */
    public function getCommand()
    {
        return "flushall";
    }

    /**
     * Get the command parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return array();
    }
}
