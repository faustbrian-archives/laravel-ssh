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

namespace KodeKeep\SecureShell\Tests\Unit\CommandBuilders;

use KodeKeep\SecureShell\CommandBuilders\SshCommandBuilder;
use KodeKeep\SecureShell\SecureShell;
use KodeKeep\SecureShell\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * @covers \KodeKeep\SecureShell\CommandBuilders\SshCommandBuilder
 */
class SshCommandBuilderTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function can_create_a_command_for_a_script(): void
    {
        $shell = new SecureShell('user', '127.0.0.1', 22);
        $shell->usePrivateKey('/home/root/.ssh/id_rsa');

        $command = new SshCommandBuilder($shell);

        $this->assertMatchesSnapshot($command->forScript());
    }
}
