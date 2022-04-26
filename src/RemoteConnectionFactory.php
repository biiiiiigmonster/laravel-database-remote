<?php


namespace BiiiiiigMonster\LaravelRestfulGrammar;


use BiiiiiigMonster\LaravelRestfulGrammar\Connectors\RemoteConnector;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Connectors\MySqlConnector;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\Connectors\SQLiteConnector;
use Illuminate\Database\Connectors\SqlServerConnector;

class RemoteConnectionFactory extends ConnectionFactory
{
    /**
     * Create a connector instance based on the configuration.
     *
     * @param  array  $config
     * @return \Illuminate\Database\Connectors\ConnectorInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createConnector(array $config)
    {
        if (! isset($config['driver'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }

        if ($this->container->bound($key = "db.connector.{$config['driver']}")) {
            return $this->container->make($key);
        }

        return match ($config['driver']) {
            'mysql' => new MySqlConnector,
            'pgsql' => new PostgresConnector,
            'sqlite' => new SQLiteConnector,
            'sqlsrv' => new SqlServerConnector,
            'remote' => new RemoteConnector,
            default => throw new InvalidArgumentException("Unsupported driver [{$config['driver']}]."),
        };
    }
}