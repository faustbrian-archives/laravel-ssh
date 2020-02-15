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

namespace KodeKeep\SecureShell\Concerns;

trait GeneratesCommands
{
    public function getExecuteCommand($commands): string
    {
        $command = $this->secureShellCommand->forScript();

        $commandString = implode(PHP_EOL, (array) $commands);

        $delimiter = 'EOF-KK-SSH';

        return "{$command} 'bash -se' << \\$delimiter".PHP_EOL.$commandString.PHP_EOL.$delimiter;
    }

    public function getUploadCommand(string $sourcePath, string $destinationPath): string
    {
        return $this->secureShellCommand->forUpload($sourcePath, $destinationPath);
    }

    public function getDownloadCommand(string $sourcePath, string $destinationPath): string
    {
        return $this->secureShellCommand->forDownload($sourcePath, $destinationPath);
    }
}
