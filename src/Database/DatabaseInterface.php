<?php

namespace Baezeta\Psql\Database;

interface DatabaseInterface
{
    public function getDriver(): \PDO;
}
