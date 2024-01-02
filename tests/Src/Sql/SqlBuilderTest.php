<?php

namespace Tests\Src\Sql;

use Tests\Tests\DBConnection;
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
        $sql = new SqlBuilder($this->connection);
        $response = $sql->table('test')
                    ->select('nombre', 'Lucas');

        $this->assertEquals(count($response), 2);
    }
}
