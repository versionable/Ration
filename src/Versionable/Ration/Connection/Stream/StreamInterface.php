<?php

namespace Versionable\Ration\Connection\Stream;

/**
 *
 * @author Harry Walter <harry.walter@lqdinternet.com>
 */
interface StreamInterface
{
    public function getAddress();
    
    public function isValid();
}
