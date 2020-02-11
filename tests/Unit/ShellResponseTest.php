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

use KodeKeep\SecureShell\ShellResponse;
use KodeKeep\SecureShell\Tests\TestCase;
use Symfony\Component\Process\Process;

/**
 * @covers \KodeKeep\SecureShell\ShellResponse
 */
class ShellResponseTest extends TestCase
{
    /** @test */
    public function creates_a_response(): void
    {
        $response = new ShellResponse(123, 'output', true);

        $this->assertSame(123, $response->exitCode);
        $this->assertSame('output', $response->output);
        $this->assertTrue($response->timedOut);
    }

    /** @test */
    public function can_set_the_process(): void
    {
        $process = Process::fromShellCommandline('whoami');
        $process->run();

        $response = new ShellResponse($process->getExitCode(), $process->getOutput(), false);
        $response->setProcess($process);

        $this->assertSame(0, $response->getExitCode());
    }
}
