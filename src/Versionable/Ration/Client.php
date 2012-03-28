<?php

namespace Versionable\Ration;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Command;

use Versionable\Ration\Exception\CommandException;

/**
 * @method void set(string $key, string $value) Sets a value in redis
 * @method string get(string $key) Gets a value from redis
 * @method bool delete(string $key) Deletes a value from redis
 * @method bool exists(string $key) Checks if a key exists in redis
 * @method bool timeToLive(string $key) Returns the time to live of a key
 * @method void clean() Deletes all keys from all databases
 * @method string ping() Pings the redis server
 */
class Client
{
    /**
     * @var ConnectionInterface 
     */
    private $_connection;
    
    /**
     * @var array
     */
    protected $queue;
    
    /**
     * @var array
     */
    protected $pipeline;
    
    /**
     * @param ConnectionInterface $connection 
     */
    public function __construct(ConnectionInterface $connection = null)
    {
        if (null !== $connection) {
            $this->setConnection($connection);
        }
        
        $this->queue = array();
        $this->pipeline = array();
    }
    
    /**
     * @param ConnectionInterface $connection 
     */
    public function setConnection(ConnectionInterface $connection)
    {
        $this->_connection = $connection;
    }
  
    /**
     * @param string $name
     * @param array $args
     * @return mixed
     * @throws CommandException 
     */
    public function __call($name, $args)
    {
        $className = sprintf('Versionable\Ration\Command\%s', ucwords(strtolower($name)));
        
        if (false === class_exists($className)) {
            throw new CommandException(sprintf('Unknown command "%s"', $name));
        }
        
        $command = new $className($args);
        
        return $this->_connection->send($command);
    }
    
    /**
     * @param Command\CommandInterface $command
     * @return \Versionable\Ration\Client 
     */
    public function queue(Command\CommandInterface $command)
    {
        $this->queue[] = $command;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function flush()
    {
        foreach ($this->queue as $command) {
            $this->_connect->write($command);
        }
        
        $response = array();
        for ($i = 0; $i < count($this->queue); $i++) {
            $response[] = $this->_connection()->read();
        }
        
        if (count($this->queue) == 1) {
            $response = $response[0];
        }
        
        $this->queue = array();
        
        return $response;
    }
}