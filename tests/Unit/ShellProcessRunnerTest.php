<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Secure Shell.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\SecureShell\Tests\Unit;

use KodeKeep\SecureShell\ShellProcessRunner;
use KodeKeep\SecureShell\Tests\TestCase;
use Symfony\Component\Process\Process;

/**
 * @covers \KodeKeep\SecureShell\ShellProcessRunner
 */
class ShellProcessRunnerTest extends TestCase
{
    /** @test */
    public function process_runner_runs_process()
    {
        $process = (new Process('sleep 1'))->setTimeout(2);

        $response = (new ShellProcessRunner())->run($process);

        $this->assertSame(0, $response->exitCode);
        $this->assertSame('', $response->output);
        $this->assertFalse($response->timedOut);
    }

    /** @test */
    public function process_runner_handles_timeouts()
    {
        $process = (new Process('sleep 2'))->setTimeout(2);

        $response = (new ShellProcessRunner())->run($process);

        $this->assertSame(0, $response->exitCode);
        $this->assertSame('', $response->output);
        $this->assertTrue($response->timedOut);
    }
}
