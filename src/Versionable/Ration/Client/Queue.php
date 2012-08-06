<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Request\Request;
use Versionable\Ration\Response\Response;

/**
 * Description of Queue
 *
 * @author Harry Walter <harry.walter@lqdinternet.com>
 */
class Queue implements ClientInterface
{
    protected $queue;

    public function __construct(ConnectionInterface $connection = null)
    {
        $this->connection = $connection;
        $this->queue = new \SplQueue();
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
     * Alias of Queue::queue
     * 
     * @param \Versionable\Ration\Request\Request $request
     */
    public function send(Request $request)
    {
        $this->queue($request);
    }

    /**
     * Add a request to the queue
     * 
     * @param \Versionable\Ration\Request\Request $request
     */
    public function queue(Request $request)
    {
        $this->getQueue()->enqueue($request);
    }

    /**
     * Get the queue
     * 
     * @return \SplQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Create a new queue and return for chaining
     * 
     * @return \SqlQueue
     */
    public function reset()
    {
        $this->queue = new \SplQueue();
        
        return $this->getQueue();
    }

    /**
     * Send all commands in the queue to the server
     * 
     * @return \SplObjectStorage
     */
    public function flush()
    {
        $responseCollection = new \SplObjectStorage();
        $connection = $this->getConnection();

        $queue = $this->getQueue();
        $queue->setIteratorMode(\SplDoublyLinkedList::IT_MODE_DELETE);

        foreach ($queue as $request) {
            $response = $connection->call($request);
            $responseCollection->attach($request, $response);
        }

        return $responseCollection;
    }
}
