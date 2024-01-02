<?php

namespace Tests\Tests;

use Baezeta\Psql\Connect\Connector\ConnectorDTO;
use Baezeta\Psql\Connect\Connector\DatabaseConnection;

class DBConnection
{
    public static function newConnection()
    {
        $dto = self::getConnector();
        $connection = new DatabaseConnection();
        $connection->addConnection($dto)
        ->connect();
        return $connection;
    }
    
    public static function getConnector()
    {
        $dto = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );
        return $dto;
    }

}
