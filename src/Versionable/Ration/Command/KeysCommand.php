<?php

namespace Versionable\Ration\Command;

/**
 * Returns all keys matching pattern
 *
 * Support pattern styles:
 *
 *   h?llo matches hello, hallo and hxllo
 *   h*llo matches hllo and heeeello
 *   h[ae]llo matches hello and hallo, but not hillo
 */
class KeysCommand implements CommandInterface
{
    protected $pattern;

    public function __construct($pattern = null)
    {
        $this->pattern = $pattern;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function getCommand()
    {
        return 'keys';
    }

    public function getParameters()
    {
        return array($this->getPatterm());
    }
}
