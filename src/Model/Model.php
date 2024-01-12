<?php

namespace Baezeta\Psql\Model;

use Baezeta\Psql\Sql\SqlBuilder;
use Baezeta\Psql\Query\QueryBuilder;


abstract class Model
{
    protected array $row;
    protected array $rows;
    protected ?string $table;
    protected string $primaryKey = 'id';
    protected ?string $connection = null;
    protected ?QueryBuilder $builder= null;
    protected ?SqlBuilder $sql = null;

    public function __construct()
    {
        $this->sql = new SqlBuilder();
        $this->builder = new QueryBuilder();
        $this->builder->setModel($this);
    }

    public function __set(string $name, mixed $value)
    {
        $this->row[$name] = $value;
    }

    public function __get(string $name): mixed
    {
        return $this->row[$name];
    }

    public function save()
    {
        $columns = implode(',',array_keys($this->row));
        $data = array_values($this->row);
        $values = implode(',', array_fill(0, count($this->row), '?'));
        $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $this->builder->prepareStatement($sql, $data);
    }

    public function all()
    {
        return $this->sql->all($this->table);
    }
}
