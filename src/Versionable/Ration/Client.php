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
 * @method void multi() declares following statements as atomic
 * @method string exec returns a string reply as to whether a cas succeeded or not
 * @method void watch(string $key) declares that the value of a key should be watched (cas transaction)
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
     * This function gets the connection
     *
     * @return Connection\ConnectionInterface
     */
    protected function getConnection()
    {
        return $this->_connection;
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
        
        return $this->getConnection()->send($command);
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
        $conn = $this->getConnection();
        foreach ($this->queue as $command) {
            $conn->write($command);
        }
        
        $response = array();
        for ($i = 0; $i < count($this->queue); $i++) {
            $response[] = $conn->read();
        }
        
        if (count($this->queue) == 1) {
            $response = $response[0];
        }
        
        $this->queue = array();
        
        return $response;
    }
}