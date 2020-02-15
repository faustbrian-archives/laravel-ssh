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

class ScpCommandBuilder
{
    use Concerns\InteractsWithSecureShell;

    public function forUpload(string $sourcePath, string $destinationPath): string
    {
        return sprintf(
            'scp %s %s %s:%s',
            $this->getFlags(), $sourcePath, $this->shell->getTarget(), $destinationPath
        );
    }

    public function forDownload(string $sourcePath, string $destinationPath): string
    {
        return sprintf(
            'scp %s %s:%s %s',
            $this->getFlags(), $this->shell->getTarget(), $sourcePath, $destinationPath
        );
    }

    private function getFlags(): string
    {
        $result = $this->getCommonFlags();

        if (! is_null($this->shell->port)) {
            $result[] = "-p {$this->shell->port}";
        }

        if ($this->shell->enableRecursiveCopying) {
            $result[] = '-r';
        }

        return implode(' ', $result);
    }
}
