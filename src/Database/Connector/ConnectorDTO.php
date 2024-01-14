<?php

namespace Baezeta\Psql\Database\Connector;

class ConnectorDTO
{
    public function __construct(
        public readonly string $driver,
        public readonly string $host,
        public readonly string $port,
        public readonly string $database,
        public readonly string $username,
        public ?string $password,
    ) {
    }

    public function __toString(): string
    {
        return "driver=$this->driver;host=$this->host;port=$this->port;dbname=$this->database";
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}
