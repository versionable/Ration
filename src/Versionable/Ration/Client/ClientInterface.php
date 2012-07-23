<?php

namespace Versionable\Ration\Client;

use Versionable\Ration\Connection\ConnectionInterface;
use Versionable\Ration\Request\Request;

/**
 *
 * @author Harry Walter <harry@ukwebmedia.com>
 */
interface ClientInterface
{
    public function __construct(ConnectionInterface $connection = null);
    
    public function setConnection(ConnectionInterface $connection);
    
    public function getConnection();
    
    public function send(Request $request);
}
