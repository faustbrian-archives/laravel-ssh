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

use Facades\KodeKeep\SecureShell\ShellProcessRunner;
use KodeKeep\SecureShell\Concerns\InteractsWithFiles;
use KodeKeep\SecureShell\Concerns\InteractsWithOptions;
use KodeKeep\SecureShell\Contracts\Shell;
use Symfony\Component\Process\Process;

class SecureCopyShell implements Shell
{
    use InteractsWithFiles;
    use InteractsWithOptions;

    public function __construct(string $user, string $host, int $port = 22)
    {
        $this->useUser($user)->useHost($host)->usePort($port);
    }

    public function execute(): ShellResponse
    {
        $command = $this->getCommand();

        $process = Process::fromShellCommandline($command);
        $process->setTimeout($this->timeout);

        return ShellProcessRunner::run($process);
    }

    public function getCommand(): string
    {
        return SecureShellCommand::forUpload($this);
    }
}
