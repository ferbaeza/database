<?php

namespace Baezeta\Psql\Sql;

use Baezeta\Psql\Query\QueryBuilder;
use Baezeta\Psql\Connect\Connector\DatabaseConnection;


class SqlBuilder
{
    protected string $sql;
    protected string $table;
    protected array $params = [];

    protected ?QueryBuilder $fetch = null;

    public function __construct(
        protected DatabaseConnection $pdo
    )
    {
        $this->fetch = new QueryBuilder();
        $this->fetch->setConnection($this->pdo);
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

}
