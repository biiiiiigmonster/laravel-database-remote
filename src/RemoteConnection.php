<?php


namespace BiiiiiigMonster\LaravelDatabaseRemote;


use BiiiiiigMonster\LaravelDatabaseRemote\PDO\RemoteDriver;
use BiiiiiigMonster\LaravelDatabaseRemote\Query\RemoteProcessor;
use BiiiiiigMonster\LaravelDatabaseRemote\Query\RemoteGrammar as QueryGrammar;
use BiiiiiigMonster\LaravelDatabaseRemote\Schema\RemoteBuilder;
use BiiiiiigMonster\LaravelDatabaseRemote\Schema\RemoteGrammar as SchemaGrammar;
use BiiiiiigMonster\LaravelDatabaseRemote\Schema\RemoteSchemaState;
use Illuminate\Database\Connection;
use Illuminate\Filesystem\Filesystem;

class RemoteConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \BiiiiiigMonster\LaravelDatabaseRemote\Query\RemoteGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \BiiiiiigMonster\LaravelDatabaseRemote\Schema\RemoteBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new RemoteBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \BiiiiiigMonster\LaravelDatabaseRemote\Schema\RemoteGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the schema state for the connection.
     *
     * @param \Illuminate\Filesystem\Filesystem|null $files
     * @param callable|null $processFactory
     * @return \BiiiiiigMonster\LaravelDatabaseRemote\Schema\RemoteSchemaState
     */
    public function getSchemaState(Filesystem $files = null, callable $processFactory = null)
    {
        return new RemoteSchemaState($this, $files, $processFactory);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \BiiiiiigMonster\LaravelDatabaseRemote\Query\RemoteProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new RemoteProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \BiiiiiigMonster\LaravelDatabaseRemote\PDO\RemoteDriver
     */
    protected function getDoctrineDriver()
    {
        return new RemoteDriver;
    }
}