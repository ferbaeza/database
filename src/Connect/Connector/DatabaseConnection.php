<?php

namespace Baezeta\Psql\Connect\Connector;

use PDO;
use Baezeta\Psql\Connect\Interface\DatabaseInterface;

class DatabaseConnection implements DatabaseInterface
{
    /**
     * The PDO instance.
     * @var PDO|null
     */
    protected ?PDO $pdo;

    /**
     * The connections.
     * @var array
     */
    private array $connections = [];
    
    /**
     * The default connection.
     */
    private $default = null;

    /**
     * @inheritDoc
     */
    public function addConnection(ConnectorDTO $dto): self
    {
        if ($this->default === null) {
            $this->default = $dto->database;
        }
        $this->connections[$dto->database] = $dto;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function connect(null|string $name = null): PDO
    {
        $connection = $this->getConnection();
        $dsn = "$connection->driver:host=$connection->host;port=$connection->port;dbname=$connection->database";
        $this->pdo = new PDO($dsn, $connection->username, $connection->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->pdo;
    }

    public function getConnection(string $name = null): ConnectorDTO
    {
        if ($name === null) {
            $name = $this->default;
        }
        return $this->connections[$name];
    }

    /**
     * @inheritDoc
     */
    public function closeConnection(): void
    {
        $this->pdo = null;
    }

    /**
     * @inheritDoc
     */
    public function getDriver(): PDO
    {
        return $this->pdo;
    }

    /**
     * Get the value of pdo driver name
     * @return string
     */
    public function getDriverName(): string
    {
        return $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

    /**
     * Get all connections
     * @return array
     */
    public function getAllConnections(): array
    {
        return $this->connections;
    }
}
