<?php

namespace Tests\Src\Database;

use Tests\TestCase;
use Baezeta\Psql\Database\ConnectorDTO;
use Baezeta\Psql\Database\DatabaseConnection;

class DatabaseConnectionTest extends TestCase
{
    /** @test*/
    public function deberia_connectar_con_la_base_datos_por_defecto()
    {
        $dto = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );

        $connection = DatabaseConnection::addConnection($dto);
        $connection = DatabaseConnection::connect();
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

        $connection = DatabaseConnection::addConnection($test);
        $connection = DatabaseConnection::addConnection($dto);
        $connection = DatabaseConnection::connect('pgsql');
        $this->assertEquals('pgsql', $connection->getDriverName());
        $this->assertTrue($connection->getDriver() instanceof \PDO);

    }

}
