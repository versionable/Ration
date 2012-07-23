<?php

namespace Versionable\Ration\Command;

class SelectCommand implements CommandInterface
{
    protected $index;

    public function __construct($index)
    {
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getCommand()
    {
        return 'select';
    }

    public function getParameters()
    {
        return array($this->getIndex());
    }
}
