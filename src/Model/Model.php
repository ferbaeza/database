<?php

namespace Baezeta\Psql\Model;

use Baezeta\Psql\Query\QueryBuilder;


abstract class Model
{
    protected ?string $table;
    protected string $primaryKey = 'id';
    protected ?string $connection = null;
    protected array $row;
    protected array $rows;

    public function __construct()
    {
        $builder = new QueryBuilder();
        $builder->setModel($this);
    }

    public function __set(string $name, mixed $value)
    {
        $this->row[$name] = $value;
    }



}
