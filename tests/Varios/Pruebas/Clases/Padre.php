<?php

namespace Tests\Varios\Pruebas\Clases;

abstract class Padre
{
    public function test()
    {
        return 'test';
    }
    abstract public function run();
    abstract public function show();

}
