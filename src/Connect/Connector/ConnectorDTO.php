<?php

namespace Baezeta\Psql\Connect\Connector;

class ConnectorDTO
{
    public function __construct(
        public readonly string $driver,
        public readonly string $host,
        public readonly string $port,
        public readonly string $database,
        public readonly string $username,
        public readonly string $password,
    ) {
    }
}
