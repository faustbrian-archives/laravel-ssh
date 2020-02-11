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

use Facades\KodeKeep\SecureShell\ShellProcessRunner;
use KodeKeep\SecureShell\SecureShell;
use KodeKeep\SecureShell\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * @covers \KodeKeep\SecureShell\SecureShell
 */
class SecureShellTest extends TestCase
{
    use MatchesSnapshots;

    private SecureShell $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new SecureShell('user', 'example.com');
    }

    /** @test */
    public function can_set_the_port_via_the_constructor(): void
    {
        $command = (new SecureShell('user', 'example.com', 123))->getCommand('whoami');

        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_execute_a_command(): void
    {
        ShellProcessRunner::mock(0, 'root', false);

        $command = $this->subject->execute('whoami');

        $this->assertSame(0, $command->exitCode);
        $this->assertSame('root', $command->output);
        $this->assertFalse($command->timedOut);
    }

    /** @test */
    public function can_generate_a_command(): void
    {
        $command = $this->subject->getCommand('whoami');

        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_generate_multiple_commands(): void
    {
        $command = $this->subject->getCommand(['whoami', 'cd /var/log']);

        $this->assertMatchesSnapshot($command);
    }
}
