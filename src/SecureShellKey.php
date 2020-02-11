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

namespace KodeKeep\SecureShell;

use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class SecureShellKey
{
    public static function make(string $email, string $password = ''): array
    {
        $name = Str::random(20);

        (new Process(
            "ssh-keygen -C \"{$email}\" -f {$name} -t rsa -b 4096 -N ".escapeshellarg($password),
            storage_path('app')
        ))->run();

        [$publicKey, $privateKey] = [
            file_get_contents(storage_path('app/'.$name.'.pub')),
            file_get_contents(storage_path('app/'.$name)),
        ];

        @unlink(storage_path("app/{$name}.pub"));
        @unlink(storage_path("app/{$name}"));

        return compact('publicKey', 'privateKey');
    }

    public static function storeFor(string $name, string $privateKey): string
    {
        return tap(storage_path("app/keys/{$name}"), function ($path) use ($privateKey) {
            static::ensureKeyDirectoryExists();

            static::ensureFileExists($path, $privateKey, 0600);
        });
    }

    private static function ensureKeyDirectoryExists(): void
    {
        if (! is_dir(storage_path('app/keys'))) {
            mkdir(storage_path('app/keys'), 0755, true);
        }
    }

    private static function ensureFileExists(string $path, string $contents, int $chmod): void
    {
        file_put_contents($path, $contents);

        chmod($path, $chmod);
    }
}
