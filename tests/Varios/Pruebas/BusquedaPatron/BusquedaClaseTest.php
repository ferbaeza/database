<?php

namespace Tests\Varios\Pruebas\BusquedaPatron;

use Tests\TestCase;
use Baezeta\Psql\Database\Migrator\Finder;

class BusquedaClaseTest extends TestCase
{
    private const CLASE = "Tests\Varios\Pruebas\BusquedaPatron\Herencia\Schema" ;

    /** $@test */
    public function findClass()
    {
        $schemas = Finder::findSchemas();
        dd($schemas);
        $this->assertTrue(is_array($schemas));
        $this->assertCount(5, $schemas);
    }
}