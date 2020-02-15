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

class SecureShellCommand
{
    private SecureShell $shell;

    public function __construct(SecureShell $shell)
    {
        $this->shell = $shell;
    }

    public function forScript(): string
    {
        return sprintf(
            'ssh %s %s',
            $this->getScriptFlags(), $this->shell->getTarget(),
        );
    }

    public function forUpload(string $sourcePath, string $destinationPath): string
    {
        return sprintf(
            'scp %s %s %s:%s',
            $this->getFileFlags(), $sourcePath, $this->shell->getTarget(), $destinationPath
        );
    }

    public function forDownload(string $sourcePath, string $destinationPath): string
    {
        return sprintf(
            'scp %s %s:%s %s',
            $this->getFileFlags(), $this->shell->getTarget(), $sourcePath, $destinationPath
        );
    }

    private function getScriptFlags(): string
    {
        $flags = $this->getCommonFlags();

        if (! is_null($this->shell->port)) {
            $flags[] = "-p {$this->shell->port}";
        }

        return implode(' ', $flags);
    }

    private function getFileFlags(): string
    {
        $flags = $this->getCommonFlags();

        if (! is_null($this->shell->port)) {
            $flags[] = "-p {$this->shell->port}";
        }

        return implode(' ', $flags);
    }

    private function getCommonFlags(): array
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
