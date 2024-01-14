<?php

namespace Baezeta\Psql\Database;

use PDO;
use Baezeta\Psql\Database\Connector\ConnectorDTO;
use Baezeta\Psql\Database\Interface\DatabaseInterface;
use Baezeta\Psql\Exceptions\DatabaseConnectionException;
use Baezeta\Psql\Database\Connector\Constants\DeafultConnector;

class DatabasePSQLConnection implements DatabaseInterface
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


    public function __construct()
    {
        $this->start();
    }

    private function start()
    {
        $default = DeafultConnector::zataca();
        $this->addConnection($default)
            ->connect($default->database);
    }

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
        $connection = $this->getConnection($name);
        $dsn = "$connection->driver:host=$connection->host;port=$connection->port;dbname=$connection->database";
        $this->pdo = new PDO($dsn, $connection->username, $connection->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(0, $connection->database);
        return $this->pdo;
    }

    public function getConnection(string $name = null): ConnectorDTO
    {
        if ($name === null) {
            $name = $this->default;
        }

        if (!$this->connections[$name]) {
            throw DatabaseConnectionException::create("$name");
        }
        $this->default = $name;
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

    /**
     * Get all connections
     * @param string  $name
     * @return self
     */
    public function setDefault(string $name): self
    {
        $this->default = $name;
        return $this;
    }

    /**
     * Get all connections
     * @return array
     */
    public function getCurrentConnection(): mixed
    {
        return $this->default;
    }
}
