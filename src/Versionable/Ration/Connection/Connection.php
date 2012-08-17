<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Response\Exception\InvalidResponseException;
use Versionable\Ration\Response\Exception\ResponseException;
use Versionable\Ration\Response\Response;
use Versionable\Ration\Request\Request;
use Versionable\Ration\Connection\Stream\StreamInterface;
use Versionable\Ration\Command\Exception\CommandException;

class Connection implements ConnectionInterface
{
    protected $handle;
    
    protected $streamAddress;

    public function __construct(StreamInterface $streamAddress = null)
    {
        $this->streamAddress = $streamAddress;
        $this->handle = null;
    }
    
    /**Gets the current stream resource
     * 
     * 
     * @return Resource
     */
    public function getHandle()
    {
        return $this->handle;
    }
    
    /**
     * Get the stream address instance
     * 
     * @return Versionable\Ration\Connection\Stream\StreamInterface
     */
    public function getStreamAddress()
    {
        return $this->streamAddress;
    }

    /**
     * Set the stream address
     * 
     * @param Versionable\Ration\Connection\Stream\StreamInterface $streamAddress
     */
    public function setStreamAddress(StreamInterface $streamAddress)
    {
        $this->streamAddress = $streamAddress;
    }
    
    /**
     * Try to connect to the supplied stream address
     * 
     * @throws Exception\ConnectionException
     */
    public function connect()
    {
        if (null === $this->getHandle()) {
            $address = $this->getStreamAddress()->getAddress();
            $this->handle = @stream_socket_client($address);
            
            if (false === $this->getHandle()) {
                throw new Exception\ConnectionException();
            }
        }
    }
    
    public function call(Request $request)
    {
        $this->connect();
        
        $commandString = $request->buildRequest();
        
        $this->write($commandString);
        
        $raw = $this->read();
        
        $response = $this->parseResponse($raw);
        
        return $response;
    }
    
    /**
     * Read 512 bytes from the stream
     * 
     * @return string
     */
    public function read()
    {
        return trim(fgets($this->getHandle()), 512);
    }

    /**
     * Read a specified length of bytes from the stream
     * 
     * @param integer $length
     * @return string
     */
    public function readLength($length = 1024)
    {
        return fread($this->getHandle(), $length);
    }
    
    /**
     * write the command to the stream
     * 
     * @param string $command
     * @throws CommandException
     */
    public function write($command)
    {
        $writeStatus = @fwrite($this->getHandle(), $command);

        if (false === $writeStatus) {
            throw new CommandException();
        }
    }
    
    /**
     * Close the connection
     */
    public function disconnect()
    {
        @fclose($this->getHandle());
    }
    
    /**
     * @param string $raw
     *
     * @return mixed
     *
     * @throws ResponseException
     * @throws InvalidResponseException
     */
    public function parseResponse($raw)
    {
        $raw = trim($raw);

        $response = null;
        switch (substr($raw, 0, 1)) {
            case '-':
                throw new ResponseException(substr($raw, 4));
                break;
            case '$':
                $raw = substr($raw, 1);

                if ($raw == '-1') {
                    break;
                }

                $read = 0;
                $size = intval($raw);

                if ($size > 0) {
                    do {
                        $blockSize = ($size - $read) > 1024 ? 1024 : ($size - $read);
                        $r = $this->readLength($blockSize);

                        if (false === $r) {
                            throw new ResponseException('Failed to read response');
                        } else {
                            $read += strlen($r);
                            $response .= $r;
                        }

                    } while ($read < $size);
                }

                $this->readLength(2);
                break;
            case '*':
                $count = intval(substr($raw, 1));

                if ($count == '-1') {
                    break;
                }

                $response = array();

                for ($i = 0; $i < $count; $i++) {
                    $response[] = $this->parseResponse($this->read());
                }
                break;
            default:
                $response = new Response();
                $response->parse($raw);
        }

        return $response;
    }
    
    /**
     * Caled on class shutdown, disconnects
     */
    public function __shutdown()
    {
        $this->disconnect();
    }
}
