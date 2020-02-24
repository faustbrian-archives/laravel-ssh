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

use Symfony\Component\Process\Process;
use KodeKeep\ProcessRunner\ShellResponse;
use KodeKeep\SecureShell\Concerns\GeneratesCommands;
use KodeKeep\SecureShell\Concerns\InteractsWithServer;
use KodeKeep\SecureShell\Concerns\InteractsWithProcess;
use KodeKeep\ProcessRunner\ProcessRunners\ProcessRunner;

class SecureShell
{
    use GeneratesCommands;
    use InteractsWithProcess;
    use InteractsWithServer;

    public function __construct(string $user, string $host, ?int $port = null)
    {
        $this->user = $user;
        $this->host = $host;
        $this->port = $port;

        $this->processConfiguration = fn (Process $process) => null;
        $this->outputCallback       = fn (string $type, int $line) => null;

        $this->processRunner = new ProcessRunner();
    }

    public function execute($command): ShellResponse
    {
        return $this->run($this->getExecuteCommand($command));
    }

    public function upload(string $sourcePath, string $destinationPath): ShellResponse
    {
        return $this->run($this->getUploadCommand($sourcePath, $destinationPath));
    }

    public function download(string $sourcePath, string $destinationPath): ShellResponse
    {
        return $this->run($this->getDownloadCommand($sourcePath, $destinationPath));
    }

    public function getTarget(): string
    {
        return "{$this->user}@{$this->host}";
    }

    private function run($command): ShellResponse
    {
        $process = Process::fromShellCommandline($command, $this->workingDirectory);

        $process->setTimeout($this->timeout ?? 0);

        ($this->processConfiguration)($process);

        return $this->processRunner->run($process);
    }
}
