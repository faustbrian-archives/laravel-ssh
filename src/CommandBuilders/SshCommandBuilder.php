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

namespace KodeKeep\SecureShell\CommandBuilders;

class SshCommandBuilder
{
    use Concerns\InteractsWithSecureShell;

    public function forScript(): string
    {
        return sprintf(
            'ssh %s %s',
            $this->getFlags(), $this->shell->getTarget(),
        );
    }

    private function getFlags(): string
    {
        $result = $this->getCommonFlags();

        if (! is_null($this->shell->port)) {
            $result[] = "-p {$this->shell->port}";
        }

        return implode(' ', $result);
    }
}
