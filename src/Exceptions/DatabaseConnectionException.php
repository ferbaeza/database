<?php

namespace Baezeta\Psql\Exceptions;

use Baezeta\Psql\Exceptions\Base\BaseException;

class DatabaseConnectionException extends BaseException
{
    public const BODY = "
    \n\033[31m----------Database Connection Exception-------\033[0m\n
    El nombre de la BBDD \033[1m\033[31m\"%s\"\033[0m  no ha sido encontrado en las conexiones 
    \n\033[31m----------Database Connection Exception-------\033[0m \n\n";

    protected static array $messages = [
        self::class => self::BODY
    ];
}
