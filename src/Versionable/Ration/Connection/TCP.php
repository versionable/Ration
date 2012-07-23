<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Connection\Exception\ConnectionException;
use Versionable\Ration\Command\Exception\CommandException;
use Versionable\Ration\Request\Request;
use Versionable\Ration\Response\Response;

class TCP extends Connection
{
    protected $handle;

    protected $host;

    protected $port;

    /**
     * @param string  $host
     * @param integer $port
     */
    public function __construct($host = 'localhost', $port = 6379)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @throws ConnectionException
     */
    public function initialize()
    {
        if (null === $this->handle) {
            $this->handle = @fsockopen($this->getHost(), $this->getPort(), $errono, $errstr);

            if (false === $this->handle) {
                throw new ConnectionException($errstr);
            }
        }
    }

    public function call(Request $request)
    {
        $this->initialize();

        $commandString = $request->buildRequest();

        $this->write($commandString);

        $raw = $this->read();

        $response = $this->parseResponse($raw);

        return $response;
    }

    public function disconnect()
    {
        fclose($this->handle);
    }

    public function read()
    {
        return trim(fgets($this->handle), 512);
    }

    public function readLength($length = 1024)
    {
        return fread($this->handle, $length);
    }

    public function write($command)
    {
        $writeStatus = fwrite($this->handle, $command);

        if (null === $writeStatus) {
            throw new CommandException();
        }
    }
}
