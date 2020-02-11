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

use KodeKeep\SecureShell\Contracts\Shell;

class SecureShellCommand
{
    public static function forScript(Shell $shell): string
    {
        $sharedOptions = static::getSharedOptions($shell);

        return sprintf(
            'ssh %s -p %s %s',
            $sharedOptions, $shell->port, "{$shell->user}@{$shell->host}",
        );
    }

    public static function forUpload(Shell $shell): string
    {
        $sharedOptions = static::getSharedOptions($shell);

        return sprintf(
            'scp %s -P %s %s %s:%s',
            $sharedOptions, $shell->port, "{$shell->user}@{$shell->host}", $shell->copySource, $shell->copyTarget
        );
    }

    private static function getSharedOptions(Shell $shell): string
    {
        $result = [];

        if ($shell->pathToPrivateKey) {
            $result[] = "-i {$shell->pathToPrivateKey}";
        }

        if ($shell->enableStrictHostKeyChecking) {
            $result[] = '-o StrictHostKeyChecking=no';
            $result[] = '-o UserKnownHostsFile=/dev/null';
        }

        if ($shell->enableBatchMode) {
            $result[] = '-o BatchMode=yes';
        }

        if (! $shell->enablePasswordAuthentication) {
            $result[] = '-o PasswordAuthentication=no';
        }

        return implode(' ', $result);
    }
}
