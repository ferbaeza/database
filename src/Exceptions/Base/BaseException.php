<?php

namespace Baezeta\Psql\Exceptions\Base;

use Exception;

class BaseException extends Exception
{
    protected static array $messages = [];

    public static function create($str = '')
    {
        $message = static::$messages[static::class];
        $finalMessage = str_replace('%s', $str, $message);
        return new static($finalMessage);
    }
}
