<?php


namespace BiiiiiigMonster\LaravelRestfulGrammar\PDO;

use Doctrine\DBAL\Driver\AbstractMySQLDriver;
use Illuminate\Database\PDO\Concerns\ConnectsToDatabase;

class RemoteDriver extends AbstractMySQLDriver
{
    use ConnectsToDatabase;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pdo_mysql';
    }
}