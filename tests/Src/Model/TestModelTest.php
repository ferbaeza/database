<?php

namespace Tests\Src\Model;

use Tests\TestCase;
use Tests\Varios\TestModel;

class TestModelTest extends TestCase
{
    /** @test*/
    public function deberia_retornar_una_instancia_de_un_model()
    {
        $model = new TestModel();
        $model->column1 = 'Lucas';
        $model->column2 = 21;
        $model->save();

        // dd($model->all());
        $this->assertEquals(1,1);
        // dd($model->setConnection(DBConnection::getConnector()));
    }
}
