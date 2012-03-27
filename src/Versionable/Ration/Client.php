<?php

namespace Versionable\Ration;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Command;

use Versionable\Ration\Exception\CommandException;

class Client
{
    private $_connection;
    
    protected $queue;
    
    public function __construct(ConnectionInterface $connection = null)
    {
        if (null !== $connection) {
            $this->setConnection($_connection);
        }
        
        $this->queue = array();
    }
    
    public function setConnection(ConnectionInterface $connection)
    {
        $this->_connection = $connection;
    }
    
    public function ping()
    {
        return $this->_connection->send(new Command\Ping());
    }
    
    public function __call($name, $args)
    {
        $className = sprintf('Versionable\Ration\Command\%s', ucwords(strtolower($name)));
        
        if (false === class_exists($className)) {
            throw new CommandException(sprintf('Unknown command "%s"', $name));
        }
        
        $command = new $className($args);
        
        return $this->_connection->send($command);
    }
    
    public function queue(Command\CommandInterface $command)
    {
        $this->queue[] = $command;
    }
    
    public function flush()
    {
        foreach ($this->queue as $command) {
            $this->_connect->write($command);
        }
        
        $response = array();
        for ($i = 0; $i < count($this->queue); $i++) {
            $response[] = $this->_connection()->read();
        }
        
        return $response;
    }
}