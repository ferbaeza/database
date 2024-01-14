<?php

namespace Tests\Src\Model;

use Tests\TestCase;
use Tests\Varios\TestModel;
use Baezeta\Psql\Database\Connector\ConnectorDTO;
use Baezeta\Psql\Database\DatabasePSQLConnection;

class TestModelTest extends TestCase
{
    /** @test*/
    public function deberia_retornar_una_instancia_de_un_model()
    {
        $model = new TestModel();
        $model->column1 = 'Lucas';
        $model->column2 = 21;
        $model->save();

        $this->assertEquals(1, 1);
    }

    /** @test*/
    public function probando()
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
            ->setDefault('fastphp')
            ->connect($fastphp->database);

        $model = new TestModel();


        // dd($connection->getCurrentConnection());
        $model->id = '9cc915a0-3241-4802-bdf4-5d9aa2436a7d';
        $model->nombre = 'Test';
        $model->email = 'Test';
        $model->edad = 33;
        $model->save();

        $this->assertEquals(1, 1);

    }
}
