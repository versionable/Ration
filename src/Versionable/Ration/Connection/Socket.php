<?php

namespace Versionable\Ration\Connection;
use Versionable\Ration\Exception\ConnectionException;
use Versionable\Ration\Exception\CommandException;

class Socket extends Connection implements ConnectionInterface
{
    /**
     * @var string
     */
    private $_path;
    
    /**
     * @var resource
     */
    protected $_socket;
    
    /**
     * @param string $path 
     */
    public function __construct($path = '')
    {
        $this->_path = $path;
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
    
    public function disconnect()
    {
        fclose($this->_socket);
    }

    /**
     * @param integer $length
     * @return string 
     */
    public function readLength($length = 1024)
    {
        return fread($this->_socket, $length);
    }
    
    /**
     * @return string
     */
    public function read()
    {
        return trim(fgets($this->_socket), 512);
    }
    
    /**
     * @param string $command
     * @throws CommandException 
     */
    public function write($command)
    {
        $writeStatus = fwrite($this->_socket, $command);
        
        if (null === $writeStatus) {
            throw new CommandException();
        }
    }
}