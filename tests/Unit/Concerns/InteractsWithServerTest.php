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

use Exception;
use KodeKeep\SecureShell\SecureShell;
use KodeKeep\SecureShell\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * @covers \KodeKeep\SecureShell\Concerns\InteractsWithServer
 */
class InteractsWithServerTest extends TestCase
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

        $command = $this->subject->useUser('root')->getExecuteCommand('whoami');

        $this->assertSame('root', $this->subject->user);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_host(): void
    {
        $this->assertSame('127.0.0.1', $this->subject->host);

        $command = $this->subject->useHost('127.0.0.2')->getExecuteCommand('whoami');

        $this->assertSame('127.0.0.2', $this->subject->host);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_port(): void
    {
        $this->assertNull($this->subject->port);

        $command = $this->subject->usePort(1234)->getExecuteCommand('whoami');

        $this->assertSame(1234, $this->subject->port);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function zero_is_a_valid_port_number()
    {
        $command = $this->subject->usePort(0)->getExecuteCommand('whoami');

        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function it_throws_an_exception_if_a_port_is_negative()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Port must be between 0 and 65535.');

        $this->subject->usePort(-45)->getExecuteCommand('whoami');
    }

    /** @test */
    public function can_use_private_key(): void
    {
        $this->assertNull($this->subject->pathToPrivateKey);

        $command = $this->subject->usePrivateKey('/home/root/.ssh/id_rsa')->getExecuteCommand('whoami');

        $this->assertNotNull($this->subject->pathToPrivateKey);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_use_timeout(): void
    {
        $this->assertSame(0, $this->subject->timeout);

        $command = $this->subject->useTimeout(60)->getExecuteCommand('whoami');

        $this->assertSame(60, $this->subject->timeout);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_strict_host_key_checking(): void
    {
        $command = $this->subject->enableStrictHostKeyChecking()->getExecuteCommand('whoami');

        $this->assertTrue($this->subject->enableStrictHostKeyChecking);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_strict_host_key_checking(): void
    {
        $command = $this->subject->disableStrictHostKeyChecking()->getExecuteCommand('whoami');

        $this->assertFalse($this->subject->enableStrictHostKeyChecking);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_batch_mode(): void
    {
        $command = $this->subject->enableBatchMode()->getExecuteCommand('whoami');

        $this->assertTrue($this->subject->enableBatchMode);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_batch_mode(): void
    {
        $command = $this->subject->disableBatchMode()->getExecuteCommand('whoami');

        $this->assertFalse($this->subject->enableBatchMode);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_password_authentication(): void
    {
        $command = $this->subject->enablePasswordAuthentication()->getExecuteCommand('whoami');

        $this->assertTrue($this->subject->enablePasswordAuthentication);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_password_authentication(): void
    {
        $command = $this->subject->disablePasswordAuthentication()->getExecuteCommand('whoami');

        $this->assertFalse($this->subject->enablePasswordAuthentication);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_recursive_copying(): void
    {
        $command = $this->subject->enableRecursiveCopying()->getExecuteCommand('whoami');

        $this->assertTrue($this->subject->enableRecursiveCopying);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_recursive_copying(): void
    {
        $command = $this->subject->disableRecursiveCopying()->getExecuteCommand('whoami');

        $this->assertFalse($this->subject->enableRecursiveCopying);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_enable_rsync(): void
    {
        $command = $this->subject->enableRsync()->getExecuteCommand('whoami');

        $this->assertTrue($this->subject->enableRsync);
        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function can_disable_rsync(): void
    {
        $command = $this->subject->disableRsync()->getExecuteCommand('whoami');

        $this->assertFalse($this->subject->enableRsync);
        $this->assertMatchesSnapshot($command);
    }
}
