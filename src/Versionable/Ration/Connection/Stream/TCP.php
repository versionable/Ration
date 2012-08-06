<?php

namespace Versionable\Ration\Connection\Stream;

/**
 * Description of TCP
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
class TCP implements StreamInterface
{
    protected $host;
    
    protected $port;
    
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

    public function getAddress()
    {
        if (true === $this->isValid()) {
            return sprintf('tcp://%s:%d', $this->getHost(), $this->getPort());
        }
        
        return false;
    }

    public function isValid()
    {
        return true;
    }
}
