<?php

namespace Baezeta\Psql\Console;

class Input
{
    private array $tokens;

    public function __construct(
        ?array $tokens = null,
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
        $this->tokens = $argv;
        return $this;
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }

    public function getOption()
    {
        $all = implode('-', $this->tokens);
        return $all;
    }
}

