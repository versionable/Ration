<?php

namespace Versionable\Ration\Request;

use Versionable\Ration\Command\CommandInterface;

define('RATION_CRLF', sprintf('%s%s', chr(13), chr(10)));

/**
 * Description of Request
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
class Request
{
    protected $command;

    public function __construct(CommandInterface $command = null)
    {
        $this->command = $command;
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

        array_unshift($parameters, strtoupper($this->getCommand()->getCommand()));

        $command = sprintf('*%d%s%s%s', count($parameters), RATION_CRLF, implode(array_map(function($parameters) {
            return sprintf('$%d%s%s', strlen($parameters), RATION_CRLF, $parameters);
        }, $parameters), RATION_CRLF), RATION_CRLF);

        return $command;
    }
}
