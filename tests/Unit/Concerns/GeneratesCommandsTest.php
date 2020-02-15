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
 * @covers \KodeKeep\SecureShell\Concerns\GeneratesCommands
 */
class GeneratesCommandsTest extends TestCase
{
    use MatchesSnapshots;

    private SecureShell $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new SecureShell('user', '127.0.0.1');
    }

    /** @test */
    public function generates_an_execute_command(): void
    {
        $command = $this->subject->getExecuteCommand('whoami');

        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function generates_an_upload_command(): void
    {
        $command = $this->subject->getUploadCommand('source', 'target');

        $this->assertMatchesSnapshot($command);
    }

    /** @test */
    public function generates_an_download_command(): void
    {
        $command = $this->subject->getDownloadCommand('source', 'target');

        $this->assertMatchesSnapshot($command);
    }
}
