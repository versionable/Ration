<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Exception\ConnectionException;
use Versionable\Ration\Exception\CommandException;

use Versionable\Ration\Command\CommandInterface;

class TCP extends Connection implements ConnectionInterface
{
    private $_host;
    private $_port;
    private $_password;
    private $_socket;
    
    public function __construct($host = 'localhost', $port = 6379, $password = null)
    {
        $this->_host = $host;
        $this->_port = $port;
        $this->_password = $password;
    }
    
    public function connect()
    {
        if (null === $this->_socket) {
            $this->_socket = @fsockopen($this->_host, $this->_port, $errono, $errstr);

            if (false === $this->_socket) {
                throw new ConnectionException();
            }

            if (null !== $this->_password) {
                $this->auth($this->_password);
            }
        }
    }
    
    public function disconnect()
    {
        fclose($this->_socket);
    }
    
    public function auth($password)
    {
        $this->execute('AUTH');
    }
    
    public function discard($length = 1024)
    {
        fread($this->_socket, $length);
    }
    
    public function readLength($length = 1024)
    {
        return fread($this->_socket, $length);
    }
    
    public function read()
    {
        return trim(fgets($this->_socket), 512);
    }
    
    public function write($command)
    {
        $writeStatus = fwrite($this->_socket, $command);
        
        if (null === $writeStatus) {
            throw new CommandException();
        }
    }
    
    public function send(CommandInterface $command)
    {
        $this->connect();
        
        $this->write($command->build());
        
        $response = $this->read();
        
        return $this->parseResponse($response);
    }
}