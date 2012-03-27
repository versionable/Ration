<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Command\CommandInterface;

interface ConnectionInterface
{
    public function connect();
    
    public function disconnect();
    
    public function readLength($length = 1024);
    
    public function read();
    
    public function write($command);
    
    public function send(CommandInterface $command);
}