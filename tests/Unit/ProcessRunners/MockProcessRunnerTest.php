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

use Exception;
use KodeKeep\SecureShell\ProcessRunners\MockProcessRunner;
use KodeKeep\SecureShell\Tests\TestCase;
use Symfony\Component\Process\Process;

/**
 * @covers \KodeKeep\SecureShell\ProcessRunners\MockProcessRunner
 */
class MockProcessRunnerTest extends TestCase
{
    private MockProcessRunner $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new MockProcessRunner();
    }

    /** @test */
    public function mocks_the_response(): void
    {
        $this->subject->mock(0, '', false);

        $result = $this->subject->run(Process::fromShellCommandline('sleep 1'));

        $this->assertSame(0, $result->exitCode);
        $this->assertSame('', $result->output);
        $this->assertFalse($result->timedOut);
    }

    /** @test */
    public function mocks_the_exception(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('I am a mock!');

        $this->subject->mockException(new Exception('I am a mock!'));

        $this->subject->run(Process::fromShellCommandline('sleep 1'));
    }

    /** @test */
    public function can_access_the_process(): void
    {
        $this->subject->mock(0, '', false);

        $this->assertNull($this->subject->getProcess());

        $this->subject->run(Process::fromShellCommandline('sleep 1'));

        $this->assertInstanceOf(Process::class, $this->subject->getProcess());
    }
}
