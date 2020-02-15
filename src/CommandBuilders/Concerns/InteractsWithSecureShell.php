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

namespace KodeKeep\SecureShell\CommandBuilders\Concerns;

use KodeKeep\SecureShell\SecureShell;

trait InteractsWithSecureShell
{
    protected SecureShell $shell;

    public function __construct(SecureShell $shell)
    {
        $this->shell = $shell;
    }

    protected function getCommonFlags(): array
    {
        $result = [];

        if ($this->shell->pathToPrivateKey) {
            $result[] = "-i {$this->shell->pathToPrivateKey}";
        }

        if ($this->shell->enableStrictHostKeyChecking) {
            $result[] = '-o StrictHostKeyChecking=no';
            $result[] = '-o UserKnownHostsFile=/dev/null';
        }

        if ($this->shell->enableBatchMode) {
            $result[] = '-o BatchMode=yes';
        }

        if (! $this->shell->enablePasswordAuthentication) {
            $result[] = '-o PasswordAuthentication=no';
        }

        return $result;
    }
}
