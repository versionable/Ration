<?php

namespace Versionable\Ration\Connection;
use Versionable\Ration\Exception\ConnectionException;
use Versionable\Ration\Exception\CommandException;
use Versionable\Ration\Request\Request;

class Socket extends Connection implements ConnectionInterface
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var resource
     */
    protected $handle;

    /**
     * @param string $path
     */
    public function __construct($path = '')
    {
        $this->path = $path;
    }

    /**
     * @throws ConnectionException
     */
    public function initialize()
    {
        if (null === $this->handle) {
            $this->handle = @fsockopen($this->path, -1, $errono, $errstr);

            if (false === $this->handle) {
                throw new ConnectionException();
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

    /**
     * @param  integer $length
     * @return string
     */
    public function readLength($length = 1024)
    {
        return fread($this->handle, $length);
    }

    /**
     * @return string
     */
    public function read()
    {
        return trim(fgets($this->handle), 512);
    }

    /**
     * @param  string           $command
     * @throws CommandException
     */
    public function write($command)
    {
        $writeStatus = fwrite($this->handle, $command);

        if (null === $writeStatus) {
            throw new CommandException();
        }
    }
}
