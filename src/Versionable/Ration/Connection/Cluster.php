<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Request\Request;

class Cluster extends \SplObjectStorage implements ConnectionInterface
{
    /**
     * @var ConnectionInterface
     */
    private $_lastConnection;

    /**
     * @param array $connections
     */
    public function __construct(array $connections = array())
    {
        foreach ($connections as $connection) {
            $this->addConnection($connection);
        }
    }

    /**
     * @param ConnectionInterface $connection
     */
    public function addConnection(ConnectionInterface $connection)
    {
        $this->attach($connection, $connection);
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        $this->rewind();

        for ($i = 0; $i < rand(0, $this->count()-1); $i++) {
            $this->next();
        }
        
        $connection = $this->current();
        $connection->connect();

        return $connection;
    }

    public function connect()
    {
        $this->rewind();
    }

    public function call(Request $request)
    {
        $this->connect();

        $this->_lastConnection = $this->getConnection();

        return $this->_lastConnection->call($request);
    }

    public function disconnect()
    {
        $this->_lastConnection = null;
        
        $this->rewind();
        foreach ($this as $connection) {
            $this->detach($connection);
            $connection->disconnect();
        }
    }

    /**
     * @param  integer $length
     * @return string
     */
    public function readLength($length = 1024)
    {
        return $this->_lastConnection->readLength($length);
    }

    /**
     * @return string
     */
    public function read()
    {
        return $this->_lastConnection->read();
    }

    /**
     * @param string $command
     */
    public function write($command)
    {
        $this->_lastConnection = $this->getConnection();

        $this->_lastConnection->write($command);
    }

    public function parseResponse($raw)
    {
        return $this->_lastConnection->parseResponse($raw);
    }

    public function __shutdown()
    {
        $this->disconnect();
    }
}
