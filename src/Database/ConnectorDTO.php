<?php

namespace Baezeta\Psql\Database;

class ConnectorDTO
{
    public function __construct(
        public readonly string $driver,
        public readonly string $host,
        public readonly string $port,
        public readonly string $database,
        public readonly string $username,
        public readonly string $password,
        public readonly string $charset = 'utf8',
        public readonly bool $prefix_indexes = true,
        public readonly string $schema = 'public',
        public readonly string $sslmode = 'prefer'
    ) {
    }
}
