<?php


namespace BiiiiiigMonster\LaravelDatabaseRemote\Connectors;


use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;


class RemoteConnector extends Connector implements ConnectorInterface
{
    public function connect(array $config)
    {
        return null;
    }
}