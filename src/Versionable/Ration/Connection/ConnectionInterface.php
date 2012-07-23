<?php

namespace Versionable\Ration\Connection;

use Versionable\Ration\Request\Request;

interface ConnectionInterface
{
    public function initialize();

    public function disconnect();

    public function readLength($length = 1024);

    public function read();

    public function write($command);

    public function call(Request $request);

    public function parseResponse($raw);
}
