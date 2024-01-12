<?php

namespace Baezeta\Psql\Sql;

use Baezeta\Psql\Query\QueryBuilder;
use Baezeta\Psql\Database\DatabasePSQLConnection;


class SqlBuilder
{
    protected string $sql;
    protected string $table;
    protected array $params = [];

    protected ?QueryBuilder $fetch = null;

    public function __construct(
    )
    {
        $this->fetch = new QueryBuilder();
    }

    public function table($table=null): SqlBuilder
    {
        $this->table = $table;
        return $this;
    }

    public function select(string $column, string|int $value): array
    {
        $sql =  "SELECT * FROM $this->table where $column = ?";
        $response = $this->fetch->prepareStatement($sql, [$value]);
        return $response;
    }

    public function all(?string $table = null)
    {
        $table = $table ?? $this->table;
        $sql = "SELECT * FROM $table";
        return $this->fetch->prepareStatement($sql, []);
    }

}
