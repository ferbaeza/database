<?php

namespace Baezeta\Psql\Query;

use PDO;
use PDOStatement;
use Baezeta\Psql\Connect\Connector\DatabaseConnection;
use Baezeta\Psql\Model\Model;

class QueryBuilder 
{
    protected ?DatabaseConnection $connection;
    protected ?string $connectionName = null;
    protected Model $model;


    public function prepareStatement(string $sql= null, array $params =[]): array
    {
        $pdo = $this->connection->getDriver();
        $pdo = $this->connection->connect($this->connectionName);
        $statement = $pdo->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute($params);
        $response = $statement->fetchAll();
        return $response;
    }

    public function setConnection(DatabaseConnection $pdo): self
    {
        $this->connection = $pdo;
        return $this;
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }
}
