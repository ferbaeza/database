<?php

namespace Baezeta\Psql\Console;

use Baezeta\Psql\Console\Input;

class Console
{
    private const FLUSH = 'text.txt' ;
    private const PERMANENT = 'permanent.txt';

    private float $end;
    public function __construct(
        private float $start
    ) {
    }

    public static function bootsrap(?float $start = null)
    {
        $start ??= microtime(true);
        return new Console($start);
    }

    public function run(Input $argv)
    {
        $this->doWrite($argv->getOption());
        $this->end = microtime(true);
        dd($this->end, $this->start, $this->end - $this->start, $argv, 23);
    }


    public function doWrite(string $message, bool $newline = true)
    {
        $file = fopen(self::FLUSH, 'w');
        $log = fopen(self::PERMANENT, 'a+');
        if ($file) {
            if ($newline) {
                $message .= \PHP_EOL;
            }
            @fwrite($file, $message);
            @fwrite($log, $message);
            fflush($file);
            fflush($log);
        }
        fclose($file);
        fclose($log);
    }
}
