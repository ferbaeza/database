<?php

namespace Tests\Varios\Pruebas\Clases;

class Hijo extends Padre
{
    public function run()
    {
        $this->show();
    }

    public function show()
    {
        $padre = $this->test();
        dd($padre, 'show');
    }

}
