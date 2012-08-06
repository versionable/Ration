<?php

namespace Versionable\Ration\Connection\Stream;

/**
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
interface StreamInterface
{
    public function getAddress();
    
    public function isValid();
}
