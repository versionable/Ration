<?php

namespace Versionable\Ration\Response;

use Versionable\Ration\Response\Exception\ResponseException;

/**
 * Description of Response
 *
 * @author Harry Walter <harry.walter@lqdinternet.com>
 */
class Response
{
    protected $content;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function parse($raw)
    {
        $raw = trim($raw);

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
            case ':':
                $response = intval(substr($raw, 1));
                break;
            default:
                $response = (string) $raw;
        }

        $this->setContent($response);
    }
}
