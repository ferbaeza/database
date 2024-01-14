<?php

namespace Baezeta\Psql\Database;

use PDO;
use Baezeta\Psql\Database\Connector\ConnectorDTO;
use Baezeta\Psql\Exceptions\DatabaseConnectionException;

class ConnectorManager
{
    /**
     * The PDO instance.
     * @var PDO|null
     */
    protected static ?PDO $pdo;

    /**
     * The connections.
     * @var array
     */
    private static array $connections = [];

    /**
     * The default connection.
     */
    private static ?string $default = null;

    /**
     * @inheritDoc
     */


    // private function start()
    // {
    //     $default = DeafultConnector::zataca();
    //     $this->addConnection($default)
    //         ->connect($default->database);
    // }

    public static function addConnection(ConnectorDTO $dto): self
    {
        if (self::$default === null) {
            self::$default = $dto->database;
        }
        self::$connections[$dto->database] = $dto;
        return new self;
    }

    /**
     * @inheritDoc
     */
    public static function connect(null|string $name = null): PDO
    {
        $connection = self::getConnection($name);
        $dsn = "$connection->driver:host=$connection->host;port=$connection->port;dbname=$connection->database";
        $pdo = new PDO($dsn, $connection->username, $connection->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(0, $connection->database);
        self::$pdo = $pdo;
        return $pdo;
    }

    public static function getConnection(string $name = null): ConnectorDTO
    {
        if ($name === null) {
            $name = self::$default;
        }

        if (!self::$connections[$name]) {
            throw DatabaseConnectionException::create("$name");
        }
        self::$default = $name;
        return self::$connections[$name];
    }

    /**
     * @inheritDoc
     */
    public static function closeConnection(): void
    {
        self::$pdo = null;
    }

    /**
     * @inheritDoc
     */
    public static function getDriver(): PDO
    {
        return self::$pdo;
    }


    /**
     * Get all connections
     * @return array
     */
    public static function getAllConnections(): array
    {
        return self::$connections;
    }

    /**
     * Get all connections
     * @param string  $name
     * @return self
     */
    public static function setDefault(string $name): self
    {
        self::$default = $name;
        return new self;
    }

    /**
     * Get all connections
     * @return array
     */
    public static function getCurrentConnection(): mixed
    {
        return self::$default;
    }
}
