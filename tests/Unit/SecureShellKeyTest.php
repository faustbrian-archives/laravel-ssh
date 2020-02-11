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

use Illuminate\Support\Facades\File;
use KodeKeep\SecureShell\SecureShellKey;
use KodeKeep\SecureShell\Tests\TestCase;

/**
 * @covers \KodeKeep\SecureShell\SecureShellKey
 */
class SecureShellKeyTest extends TestCase
{
    /** @test */
    public function creates_a_command_for_a_script(): void
    {
        $keys = SecureShellKey::make('robot@kodekeep.com');

        $this->assertIsString($keys['publicKey']);
        $this->assertIsString($keys['privateKey']);
    }

    /** @test */
    public function creates_a_command_for_an_upload(): void
    {
        File::deleteDirectory(storage_path('app/keys'));

        $this->assertIsString(SecureShellKey::storeFor('name', 'privateKey'));
    }
}
