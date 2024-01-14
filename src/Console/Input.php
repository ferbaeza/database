<?php

namespace Baezeta\Psql\Console;

class Input
{
    private array $tokens;

    public function __construct(
    ) {
        $this->run();
    }

    public function run()
    {
        $this->tokens ??= $_SERVER['argv'] ?? [];
        if (count($this->tokens) < 2) {
            $this->tokens[] = '--help';
        }
        // strip the application name
        array_shift($this->tokens);
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
