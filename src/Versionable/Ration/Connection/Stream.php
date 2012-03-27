<?php

namespace Versionable\Ration\Connection;

class Stream extends Connection implements ConnectionInterface
{
    public function __construct()
    {
        throw new \Exception('Stream connection not implemented');
    }
    
    public function connect()
    {
        
    }
    
    public function disconnect()
    {
        
    }

    public function readLength($length = 1024)
    {
        
    }
    
    public function read()
    {
        
    }
    
    public function write($command)
    {
        
    }
}