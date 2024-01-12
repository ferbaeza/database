<?php

namespace Baezeta\Psql\Database\Interface;

use PDO;
use Baezeta\Psql\Database\Connector\ConnectorDTO;

interface DatabaseInterface
{
    /**
     * Add a new connection to the pool
     * @param  ConnectorDTO $dto
     * @return self
     */
    public function addConnection(ConnectorDTO $dto): self;

    /**
     * Connect to the database
     * @param  null|string $name of the database
     * @return PDO
     */
    public function connect(null|string $name): PDO;


    /**
     * Close Connection to the database
     * @return void
     */
    public function closeConnection(): void;

    /**
     * Get the value of pdo
     * @return \PDO
     */
    public function getDriver(): \PDO;
}
