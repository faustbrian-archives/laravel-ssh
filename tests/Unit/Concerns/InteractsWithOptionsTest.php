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
use KodeKeep\SecureShell\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * @covers \KodeKeep\SecureShell\Concerns\InteractsWithOptions
 */
class InteractsWithOptionsTest extends TestCase
{
    use MatchesSnapshots;

    private SecureShell $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new SecureShell('user', '127.0.0.1');
    }

    /** @test */
    public function can_use_user(): void
    {
        $this->assertSame('user', $this->subject->user);

        $command = $this->subject->useUser('root')->getCommand('whoami');

        $this->assertSame('root', $this->subject->user);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_host(): void
    {
        $this->assertSame('127.0.0.1', $this->subject->host);

        $command = $this->subject->useHost('127.0.0.2')->getCommand('whoami');

        $this->assertSame('127.0.0.2', $this->subject->host);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_port(): void
    {
        $this->assertSame(22, $this->subject->port);

        $command = $this->subject->usePort(1234)->getCommand('whoami');

        $this->assertSame(1234, $this->subject->port);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_private_key(): void
    {
        $this->assertNull($this->subject->pathToPrivateKey);

        $command = $this->subject->usePrivateKey('/home/root/.ssh/id_rsa')->getCommand('whoami');

        $this->assertNotNull($this->subject->pathToPrivateKey);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_timeout(): void
    {
        $this->assertSame(0, $this->subject->timeout);

        $command = $this->subject->useTimeout(60)->getCommand('whoami');

        $this->assertSame(60, $this->subject->timeout);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_strict_host_key_checking(): void
    {
        $command = $this->subject->enableStrictHostKeyChecking()->getCommand('whoami');

        $this->assertTrue($this->subject->enableStrictHostKeyChecking);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_strict_host_key_checking(): void
    {
        $command = $this->subject->disableStrictHostKeyChecking()->getCommand('whoami');

        $this->assertFalse($this->subject->enableStrictHostKeyChecking);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_batch_mode(): void
    {
        $command = $this->subject->enableBatchMode()->getCommand('whoami');

        $this->assertTrue($this->subject->enableBatchMode);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_batch_mode(): void
    {
        $command = $this->subject->disableBatchMode()->getCommand('whoami');

        $this->assertFalse($this->subject->enableBatchMode);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_password_authentication(): void
    {
        $command = $this->subject->enablePasswordAuthentication()->getCommand('whoami');

        $this->assertTrue($this->subject->enablePasswordAuthentication);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_password_authentication(): void
    {
        $command = $this->subject->disablePasswordAuthentication()->getCommand('whoami');

        $this->assertFalse($this->subject->enablePasswordAuthentication);
        $this->assertMatchesSnapshot($command);
    }
}
