<?php

namespace Tests\Src\Sql;

use Tests\Varios\DBConnection;
use PHPUnit\Framework\TestCase;
use Baezeta\Psql\Sql\SqlBuilder;

class SqlBuilderTest extends TestCase
{
    private $connection;

    protected function setUp(): void
    {
        $this->connection = DBConnection::newConnection();
    }

    /** @test*/
    public function deberia_retornar_una_sentencia_select()
    {

        $sql = new SqlBuilder();
        $response = $sql->table('test')
            ->select('column2', '2');

        $this->assertEquals(count($response), 1);
    }
}
