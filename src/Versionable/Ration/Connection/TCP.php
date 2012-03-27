<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Exception\ConnectionException;
use Versionable\Ration\Exception\CommandException;

class TCP extends Socket
{
    /**
     * @var string
     */
    private $_host;
    
    /**
     * @var integer
     */
    private $_port;
    
    /**
     * @param string $host
     * @param integer $port 
     */
    public function __construct($host = 'localhost', $port = 6379)
    {
        $this->_host = $host;
        $this->_port = $port;
    }
    
    /**
     * @throws ConnectionException 
     */
    public function connect()
    {
        if (null === $this->_socket) {
            $this->_socket = @fsockopen($this->_host, $this->_port, $errono, $errstr);

            if (false === $this->_socket) {
                throw new ConnectionException();
            }
        }
    }
}