<?php

namespace Versionable\Ration\Command;

define('CRLF', sprintf('%s%s', chr(13), chr(10)));

abstract class Command
{
    protected $args;
    
    const COMMAND = '';
    
    public function __construct()
    {
        $this->args = array();
    }
    
    protected function setArgs(array $args = array())
    {
        $this->args = $args;
    }
    
    protected function addArg($arg)
    {
        $this->args[] = $arg;
    }
    
    protected function getArgs()
    {
        return $this->args;
    }
    
    public function build()
    {
        $args = $this->getArgs();
        
        array_unshift($args, static::COMMAND);
        
        $command = sprintf('*%d%s%s%s', count($args), CRLF, implode(array_map(function($arg) {
            return sprintf('$%d%s%s', strlen($arg), CRLF, $arg);
        }, $args), CRLF), CRLF);
        
        return $command;
    }
}