<?php

namespace Versionable\Ration\Request;

use Versionable\Ration\Command\CommandInterface;

/**
 * Description of Request
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
class Request
{
    protected $command;
    
    private $crlf;

    public function __construct(CommandInterface $command = null)
    {
        $this->command = $command;
        $this->crlf = chr(13).chr(10);
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function setCommand($command)
    {
        $this->command = $command;
    }

    public function buildRequest()
    {
        $parameters = $this->getCommand()->getParameters();
        $crlf = $this->crlf;

        array_unshift($parameters, strtoupper($this->getCommand()->getCommand()));

        $command = sprintf('*%d%s%s%s', count($parameters), $crlf, implode(array_map(function($parameters) use ($crlf) {
            return sprintf('$%d%s%s', strlen($parameters), $crlf, $parameters);
        }, $parameters), $crlf), $crlf);

        return $command;
    }
}
