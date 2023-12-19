<?php

namespace Tests\Src;

use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test*/
    public function app_instance_test(): void
    {
        $this->assertTrue(true);
    }

}
