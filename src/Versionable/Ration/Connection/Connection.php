<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Exception\InvalidResponseException;
use Versionable\Ration\Exception\ResponseException;

use Versionable\Ration\Command\CommandInterface;

abstract class Connection implements ConnectionInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function send(CommandInterface $command)
    {
        $this->connect();
        
        $this->write($command->build());
        
        $response = $this->read();
        
        return $this->parseResponse($response);
    }
    
    /**
     * @param string $raw
     * @return mixed
     * @throws ResponseException
     * @throws InvalidResponseException 
     */
    protected function parseResponse($raw)
    {
        $raw = trim($raw);
        
        $response = null;
        switch (substr($raw, 0, 1)) {
            case '-':
                throw new ResponseException(substr($raw, 4));
                break;
            case '+':
                $response = substr($raw, 1);
                
                if ($response === 'OK') {
                    $response = true;
                }
                
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
            case ':':
                $response = intval(substr($raw, 1));
                break;
            default:
                throw new InvalidResponseException($raw);
        }
        
        return $response;
    }
}