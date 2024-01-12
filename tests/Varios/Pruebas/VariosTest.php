<?php

namespace Tests\Varios\Pruebas;

use Tests\TestCase;

class VariosTest extends TestCase
{
    /** @test */
    public function varios()
    {
        $width = getenv('COLUMNS');
        if (false !== $width) {
            return (int) trim($width);
        }
        $ansicon = getenv('ANSICON');


        $infoOne = self::readFromProcess($command = ['stty', '-a']);
        $infoDos = self::getConsoleMode();

        dd(self::input());
        $this->assertEquals(1, 1);
    }

    public static function input()
    {
        $argv ??= $_SERVER['argv'] ?? [];
        dd($argv);
        // strip the application name
        array_shift($argv);

        $tokens = $argv;
        return [$tokens, $argv];

    }

    private static function readFromProcess(string|array $command): ?string
    {
        $descriptorspec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $process = proc_open($command, $descriptorspec, $pipes, null, null, ['suppress_errors' => true]);

        if (!\is_resource($process)) {
            return null;
        }

        $info = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);

        return $info;
    }

    private static function getConsoleMode(): ?array
    {
        $info = self::readFromProcess('mode CON');

        if (null === $info || !preg_match('/--------+\r?\n.+?(\d+)\r?\n.+?(\d+)\r?\n/', $info, $matches)) {
            return null;
        }

        return [(int) $matches[2], (int) $matches[1]];
    }

}
