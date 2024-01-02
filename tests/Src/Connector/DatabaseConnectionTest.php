<?php

namespace Tests\Src\Connector;

use Tests\TestCase;
use Baezeta\Psql\Connect\Connector\ConnectorDTO;
use Baezeta\Psql\Connect\Connector\DatabaseConnection;

class DatabaseConnectionTest extends TestCase
{
    public function newConnection()
    {
        $dto = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );
    
        $connection = new DatabaseConnection();
        $connection->addConnection($dto)
            ->connect();
        return $connection;
    }

    /** @test*/
    public function deberia_connectar_con_la_base_datos_por_defecto()
    {
        $connection = $this->newConnection();
        $this->assertTrue($connection->getDriver() instanceof \PDO);
    }

    /** @test*/
    public function deberia_agregar_una_segunda_conexion_y_connectar_con_la_base_datos_por_defecto()
    {
        $test = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'tests',
            username: 'zataca',
            password: 'zataca',
        );

        $dto = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );

        $connection = new DatabaseConnection();
        $connection->addConnection($test)
            ->addConnection($dto)
            ->connect('pgsql');

        $this->assertEquals('pgsql', $connection->getDriverName());
        $this->assertTrue($connection->getDriver() instanceof \PDO);
    }

}
