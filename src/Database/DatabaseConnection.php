<?php

namespace Baezeta\Psql\Database;

use PDO;

class DatabaseConnection implements DatabaseInterface
{
    protected ?PDO $pdo;
    private static array $connections = [];
    private static $default = null;
    public string $flag = 'default';


    /**
     * Add a new connection to the pool
     * @param  ConnectorDTO $dto
     * @return void
     */
    public static function addConnection(ConnectorDTO $dto): void
    {
        if (self::$default === null) {
            self::$default = $dto->database;
        }
        self::$connections[$dto->database] = $dto;
    }

    /**
     * Connect to the database
     * @param  string|null $name
     * @return self
     */
    public static function connect(string $name= null): self
    {
        $connection = self::getConnection();
        $dsn = "$connection->driver:host=$connection->host;port=$connection->port;dbname=$connection->database";
        $pdo = new PDO($dsn, $connection->username, $connection->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $static = new static();
        $static->pdo = $pdo;
        return $static;
    }

    public static function getConnection(string $name= null): ConnectorDTO
    {
        if ($name === null) {
            $name = self::$default;
        }
        return self::$connections[$name];
    }

    public static function close(): void
    {
        (new static())->closeConnection();
    }

    /**
     * Close the connection
     * @return void
     */
    public function closeConnection(): void
    {
        $this->pdo = null;
    }

    /**
     * Get the value of pdo
     * @return PDO
     */
    public function getDriver(): PDO
    {
        return $this->pdo;
    }

    /**
     * Get all connections
     * @return array
     */
    public static function getAllConnections(): array
    {
        return self::$connections;
    }
}
