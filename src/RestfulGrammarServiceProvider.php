<?php


namespace BiiiiiigMonster\LaravelRestfulGrammar;


use BiiiiiigMonster\LaravelRestfulGrammar\Connectors\RemoteConnector;
use Illuminate\Support\ServiceProvider;

class RestfulGrammarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Connection::resolverFor('remote', fn () => new RemoteConnection(...func_get_args()));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('db.connector.remote', fn () => new RemoteConnector);
    }
}