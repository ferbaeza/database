<?php

namespace Tests\Varios;

use Baezeta\Psql\Database\DatabasePSQLConnection;
use Baezeta\Psql\Database\Connector\ConnectorDTO;


class DBConnection
{
    public static function newConnection()
    {
        $connection = new DatabasePSQLConnection();
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
