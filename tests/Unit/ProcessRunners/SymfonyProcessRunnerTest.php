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

namespace KodeKeep\SecureShell\Tests\Unit\ProcessRunners;

use KodeKeep\SecureShell\ProcessRunners\SymfonyProcessRunner;
use KodeKeep\SecureShell\Tests\TestCase;
use Symfony\Component\Process\Process;

/**
 * @covers \KodeKeep\SecureShell\ProcessRunners\SymfonyProcessRunner
 */
class SymfonyProcessRunnerTest extends TestCase
{
    private SymfonyProcessRunner $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new SymfonyProcessRunner();
    }

    /** @test */
    public function runs_process(): void
    {
        $process = Process::fromShellCommandline('sleep 1')->setTimeout(2);

        $result = $this->subject->run($process);

        $this->assertSame(0, $result->exitCode);
        $this->assertSame('', $result->output);
        $this->assertFalse($result->timedOut);
    }

    /** @test */
    public function handles_timeouts(): void
    {
        $process = Process::fromShellCommandline('sleep 2')->setTimeout(2);

        $result = $this->subject->run($process);

        $this->assertSame(0, $result->exitCode);
        $this->assertSame('', $result->output);
        $this->assertTrue($result->timedOut);
    }
}
