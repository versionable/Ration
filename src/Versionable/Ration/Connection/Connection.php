<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Exception\InvalidResponseException;
use Versionable\Ration\Exception\ResponseException;

abstract class Connection
{    
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
                if ($raw == '-1') {
                    break;
                }
                
                $read = 0;
                $size = intval(substr($raw, 1));
                
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
                
                $this->discard(2);
                break;
            case '*':
                $count = intval(substr($raw, 1));
                
                if ($count == '-1') {
                    break;
                }
                
                $response = array();
                
                for ($i = 0; $i < $count; $i++) {
                    $response[] = $this->read();
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