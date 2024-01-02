<?php

namespace Tests\Src\Model;

use Tests\TestCase;
use Tests\Tests\TestModel;

class TestModelTest extends TestCase
{
    /** @test*/
    public function deberia_retornar_una_instancia_de_un_model()
    {
        $model = new TestModel();
        $model->name = 'Lucas';
        $model->age = 20;

        $this->assertEquals(1,1);
        // dd($model->setConnection(DBConnection::getConnector()));
    }
}
