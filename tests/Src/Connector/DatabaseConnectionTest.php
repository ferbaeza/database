<?php

namespace Tests\Src\Connector;

use Tests\TestCase;
use Baezeta\Psql\Database\DatabasePSQLConnection;
use Baezeta\Psql\Database\Connector\ConnectorDTO;
use Baezeta\Psql\Database\Connector\Constants\DeafultConnector;

class DatabaseConnectionTest extends TestCase
{
    /** @test */
    public function newConnection()
    {
        $connection = new DatabasePSQLConnection();
        $this->assertEquals(DeafultConnector::DATABASE, $connection->getCurrentConnection());
        $this->assertTrue($connection->getDriver() instanceof \PDO);
        $connection->setDefault('miconexion');
        $this->assertEquals('miconexion', $connection->getCurrentConnection());
    }

    /** @test*/
    public function deberia_connectar_con_la_base_datos_por_defecto()
    {
        $fastphp = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );

        $connection = new DatabasePSQLConnection();
        $connection->addConnection($fastphp)
            ->connect();
        $this->assertTrue($connection->getDriver() instanceof \PDO);
    }

    /** @test*/
    public function deberia_agregar_una_segunda_conexion_y_connectar_con_la_base_datos_por_defecto()
    {
        $tests = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'tests',
            username: 'zataca',
            password: 'zataca',
        );

        $fastphp = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );

        $connection = new DatabasePSQLConnection();
        $connection->addConnection($tests)
            ->addConnection($fastphp)
            ->connect($fastphp->database);


        $connection->connect($tests->database);

        $this->assertEquals($tests->database, $connection->getCurrentConnection());
        $this->assertTrue($connection->getDriver() instanceof \PDO);
    }

}
