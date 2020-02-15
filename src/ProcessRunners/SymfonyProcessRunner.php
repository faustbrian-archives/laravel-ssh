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

namespace KodeKeep\SecureShell\ProcessRunners;

use KodeKeep\SecureShell\Contracts\ProcessRunner;
use KodeKeep\SecureShell\ShellResponse;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;

class SymfonyProcessRunner implements ProcessRunner
{
    public function run(Process $process): ShellResponse
    {
        try {
            $process->run();
        } catch (ProcessTimedOutException $e) {
            $timedOut = true;
        }

        $response = new ShellResponse($process->getExitCode(), $process->getOutput(), $timedOut ?? false);

        $response->setProcess($process);

        return $response;
    }
}
