<?php


namespace BiiiiiigMonster\LaravelDbRemote;


use BiiiiiigMonster\LaravelDbRemote\PDO\RemoteDriver;
use BiiiiiigMonster\LaravelDbRemote\Query\RemoteProcessor;
use BiiiiiigMonster\LaravelDbRemote\Query\RemoteGrammar as QueryGrammar;
use BiiiiiigMonster\LaravelDbRemote\Schema\RemoteBuilder;
use BiiiiiigMonster\LaravelDbRemote\Schema\RemoteGrammar as SchemaGrammar;
use BiiiiiigMonster\LaravelDbRemote\Schema\RemoteSchemaState;
use Illuminate\Database\Connection;
use Illuminate\Filesystem\Filesystem;

class RemoteConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \BiiiiiigMonster\LaravelDbRemote\Query\RemoteGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \BiiiiiigMonster\LaravelDbRemote\Schema\RemoteBuilder
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
     * @return \BiiiiiigMonster\LaravelDbRemote\Schema\RemoteGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the schema state for the connection.
     *
     * @param  \Illuminate\Filesystem\Filesystem|null  $files
     * @param  callable|null  $processFactory
     * @return \BiiiiiigMonster\LaravelDbRemote\Schema\RemoteSchemaState
     */
    public function getSchemaState(Filesystem $files = null, callable $processFactory = null)
    {
        return new RemoteSchemaState($this, $files, $processFactory);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \BiiiiiigMonster\LaravelDbRemote\Query\RemoteProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new RemoteProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \BiiiiiigMonster\LaravelDbRemote\PDO\RemoteDriver
     */
    protected function getDoctrineDriver()
    {
        return new RemoteDriver;
    }
}