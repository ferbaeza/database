<?php

namespace Baezeta\Psql\Database\Connector\Constants;

use Baezeta\Psql\Database\Connector\ConnectorDTO;

class DeafultConnector
{
    private const DRIVER = 'pgsql';
    private const HOST = 'postgres';
    private const PORT = '5432';
    public const DATABASE = 'development';
    private const USERNAME = 'zataca';
    private const PASSWORD = 'zataca';

    public static function zataca()
    {
        return new ConnectorDTO(
            self::DRIVER,
            self::HOST,
            self::PORT,
            self::DATABASE,
            self::USERNAME,
            self::PASSWORD,
        );
    }
}
