<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Response\Exception\InvalidResponseException;
use Versionable\Ration\Response\Exception\ResponseException;
use Versionable\Ration\Response\Response;

abstract class Connection implements ConnectionInterface
{
    /**
     * @param string $raw
     *
     * @return mixed
     *
     * @throws ResponseException
     * @throws InvalidResponseException
     */
    public function parseResponse($raw)
    {
        $raw = trim($raw);

        $response = null;
        switch (substr($raw, 0, 1)) {
            case '-':
                throw new ResponseException(substr($raw, 4));
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
            default:
                $response = new Response();
                $response->parse($raw);
        }

        return $response;
    }
}
