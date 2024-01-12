<?php

namespace Baezeta\Psql\Console;

class Input
{
    private array $argv;

    public function __construct(
        ?array $argv = null,
    )
    {
        $this->run();
    }

    public function run()
    {
        $argv ??= $_SERVER['argv'] ?? [];
        if (count($argv) < 2) {
            $argv[] = '--help';
        }
        // strip the application name
        array_shift($argv);
        $this->argv = $argv;
        return $this;
    }
}

