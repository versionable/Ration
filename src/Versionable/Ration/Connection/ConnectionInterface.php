<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Command\CommandInterface;

interface ConnectionInterface
{
    public function connect();
    
    public function disconnect();
    
    public function auth($password);
    
    public function send(CommandInterface $command);
}