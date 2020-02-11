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

use KodeKeep\SecureShell\SecureCopyShell;
use KodeKeep\SecureShell\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * @covers \KodeKeep\SecureShell\Concerns\InteractsWithFiles
 */
class InteractsWithFilesTest extends TestCase
{
    use MatchesSnapshots;

    private SecureCopyShell $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new SecureCopyShell('user', '127.0.0.1');
    }

    /** @test */
    public function can_copy_from_source_to_target(): void
    {
        $this->assertNull($this->subject->copySource);
        $this->assertNull($this->subject->copyTarget);

        $command = $this->subject->copy('source', 'target')->getCommand();

        $this->assertSame('source', $this->subject->copySource);
        $this->assertSame('target', $this->subject->copyTarget);
        $this->assertMatchesSnapshot($command);
    }
}
