<?php

namespace Tests\Src\Connector;

use Tests\TestCase;
use Baezeta\Psql\Database\ConnectorManager;
use Baezeta\Psql\Database\Connector\ConnectorDTO;

class ConnectorManagerTest extends TestCase
{
    /** @test */
    public function connector_manager_test()
    {
        $fastphp = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'fastphp',
            username: 'zataca',
            password: 'zataca',
        );

        $dev = new ConnectorDTO(
            driver: 'pgsql',
            host: 'postgres',
            port: '5432',
            database: 'development',
            username: 'zataca',
            password: 'zataca',
        );

        ConnectorManager::addConnection($dev);
        ConnectorManager::addConnection($fastphp);
        ConnectorManager::setDefault('fastphp');
        ConnectorManager::connect();
        dd(ConnectorManager::getConnection());
        $this->assertTrue(ConnectorManager::getDriver() instanceof \PDO);
        $this->assertEquals(1, 1);
    }

}
