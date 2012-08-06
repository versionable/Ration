<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Request\Request;
use Versionable\Ration\Response\Response;

class Client implements ClientInterface
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection = null)
    {
        $this->connection = $connection;
    }

    /**
     * Sets the current connection
     *
     * @param ConnectionInterface $connection
     */
    public function setConnection(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Gets the connection
     *
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Sends a command to the server
     *
     * @param CommandInterface $command
     *
     * @return Response
     */
    public function send(Request $request)
    {
        $response = $this->getConnection()->call($request, new Response());

        return $response;
    }
}
