<?php


namespace BiiiiiigMonster\LaravelRestfulGrammar;


use BiiiiiigMonster\LaravelRestfulGrammar\PDO\RemoteDriver;
use BiiiiiigMonster\LaravelRestfulGrammar\Query\RemoteProcessor;
use BiiiiiigMonster\LaravelRestfulGrammar\Query\RemoteGrammar as QueryGrammar;
use BiiiiiigMonster\LaravelRestfulGrammar\Schema\RemoteBuilder;
use BiiiiiigMonster\LaravelRestfulGrammar\Schema\RemoteGrammar as SchemaGrammar;
use BiiiiiigMonster\LaravelRestfulGrammar\Schema\RemoteSchemaState;
use Illuminate\Database\Connection;
use Illuminate\Filesystem\Filesystem;

class RemoteConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \BiiiiiigMonster\LaravelRestfulGrammar\Query\RemoteGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \BiiiiiigMonster\LaravelRestfulGrammar\Schema\RemoteBuilder
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
     * @return \BiiiiiigMonster\LaravelRestfulGrammar\Schema\RemoteGrammar
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
     * @return \BiiiiiigMonster\LaravelRestfulGrammar\Schema\RemoteSchemaState
     */
    public function getSchemaState(Filesystem $files = null, callable $processFactory = null)
    {
        return new RemoteSchemaState($this, $files, $processFactory);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \BiiiiiigMonster\LaravelRestfulGrammar\Query\RemoteProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new RemoteProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \BiiiiiigMonster\LaravelRestfulGrammar\PDO\RemoteDriver
     */
    protected function getDoctrineDriver()
    {
        return new RemoteDriver;
    }
}