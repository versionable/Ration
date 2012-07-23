<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Request\Request;
use Versionable\Ration\Response\Response;

/**
 * Description of Queue
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
class Queue extends Client implements ClientInterface
{
    protected $queue;
    
    public function __construct(ConnectionInterface $connection = null)
    {
        parent::__construct($connection);
        
        $this->queue = new \SplQueue();
    }
    
    public function send(Request $request)
    {
        $this->queue($request);
    }
    
    public function queue(Request $request)
    {
        $this->getQueue()->enqueue($request);
    }
    
    public function getQueue()
    {
        return $this->queue;
    }
    
    public function reset()
    {
        $this->queue = new \SplQueue();
    }
    
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
