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

namespace KodeKeep\SecureShell\Tests\Unit\Concerns;

use KodeKeep\SecureShell\SecureShell;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Process\Process;
use KodeKeep\SecureShell\Tests\TestCase;
use KodeKeep\ProcessRunner\ProcessRunners\MockProcessRunner;
use KodeKeep\ProcessRunner\ProcessRunners\SymfonyProcessRunner;

/**
 * @covers \KodeKeep\SecureShell\Concerns\InteractsWithProcess
 */
class InteractsWithProcessTest extends TestCase
{
    use MatchesSnapshots;

    private SecureShell $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new SecureShell('user', '127.0.0.1');
    }

    /** @test */
    public function it_can_configure_the_process_runner(): void
    {
        $this->assertInstanceOf(SymfonyProcessRunner::class, $this->subject->processRunner);

        $this->subject->configureProcessRunner(new MockProcessRunner());

        $this->assertInstanceOf(MockProcessRunner::class, $this->subject->processRunner);
    }

    /** @test */
    public function it_can_configure_the_process(): void
    {
        $command = $this->subject->configureProcess(function (Process $process) {
            $process->setTimeout(0);
        })->getExecuteCommand('whoami');

        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function it_can_configure_the_process_callback(): void
    {
        $callback = fn () => null;

        $this->assertNotSame($callback, $this->subject->outputCallback);

        $command = $this->subject->whenOutput($callback)->getExecuteCommand('whoami');

        $this->assertSame($callback, $this->subject->outputCallback);
    }

    /** @test */
    public function can_use_working_directory(): void
    {
        $this->assertNull($this->subject->workingDirectory);

        $command = $this->subject->useWorkingDirectory('/home/root')->getExecuteCommand('whoami');

        $this->assertSame('/home/root', $this->subject->workingDirectory);
        $this->assertMatchesSnapshot($command);
    }
}
