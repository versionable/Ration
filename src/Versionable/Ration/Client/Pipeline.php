<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Request\Request;
use Versionable\Ration\Command\Multi;
use Versionable\Ration\Command\Exec;
use Versionable\Ration\Command\Exception\PipelineException;

/**
 * Description of Pipeline
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
class Pipeline implements ClientInterface
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    protected $stack;

    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection = null)
    {
        $this->connection = $connection;
        $this->stack = new \SplStack();
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

    public function getStack()
    {
        return $this->stack;
    }

    public function setStack($stack)
    {
        $this->stack = $stack;
    }

    public function send(Request $request)
    {
        $this->getStack()->push($request);
    }

    public function flush()
    {
        $connection = $this->getConnection();

        // first add the multi command and queue each one
        $request = new Request(new Multi());
        $connection->call($request);

        $stack = $this->getStack();

        // now we started a "transaction" we can queue our requests
        foreach ($stack as $request) {
            $status = $connection->call($request);

            if ($status->getContent() != "QUEUED") {
                throw new PipelineException();
            }
        }

        $exec = new Request(new Exec());

        return $connection->call($exec);
    }
}
