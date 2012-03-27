<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Command\CommandInterface;

class Cluster extends \SplObjectStorage implements ConnectionInterface
{
    public function __construct(array $connections = array())
    {
        foreach ($connections as $connection) {
            $this->addConnection($connection);
        }
    }
    
    public function addConnection(ConnectionInterface $connection)
    {
        $this->attach($connection, $connection);
    }
    
    public function getConnection()
    {
        $this->rewind();
        
        for ($i = 0; $i < rand(0, $this->count()-1); $i++) {
            $this->next();
        }
        
        return $this->current();
    }
    
    public function connect()
    {
        
    }
    
    public function disconnect()
    {
        $this->rewind();
        foreach ($this as $connection) {
            $this->detach($connection);
            $connection->disconnect();
        }
    }
    
    public function auth($password)
    {
        
    }
    
    public function send(CommandInterface $command)
    {
        return $this->getConnection()->send($command);
    }
    
    public function __shutdown()
    {
        $this->disconnect();
    }
}