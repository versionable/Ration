<?php

namespace Versionable\Ration\Connection\Stream;

use Versionable\Ration\Connection\Exception\InvalidStreamException;

/**
 * Description of File
 *
 * @author Harry Walter <harry.walter@lqdinternet.com>
 */
class UnixSocket implements StreamInterface
{
    protected $path;
    
    public function __construct($path = null)
    {
        $this->path = $path;
    }
    
    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getAddress()
    {
        if (true === $this->isValid()) {
            return 'file://'.$this->getPath();
        }
        
        return false;
    }

    public function isValid()
    {
        if (false === \is_writable($this->getPath())) {
            throw new InvalidStreamException();
        }
        
        return true;
    }
}
