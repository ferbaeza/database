<?php

namespace Tests\Varios\Pruebas;

use Tests\TestCase;

class InvokeTest extends TestCase
{
    /** $@test */
    public function invoke()
    {
        $test = new TestInvoke;
        $expected = 'Hola';
        $this->assertTrue(is_string($test()));
        $this->assertEquals($expected, $test());
    }

}

class TestInvoke
{
    private string $saludo = 'Hola';
    public function __invoke()
    {
        return $this->saludo;
    }
}
