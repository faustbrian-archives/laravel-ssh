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

class ShellResponse
{
    public Process $process;

    public int $exitCode;

    public string $output;

    public bool $timedOut;

    public function __construct(int $exitCode, string $output, bool $timedOut)
    {
        $this->exitCode = $exitCode;
        $this->output   = $output;
        $this->timedOut = $timedOut;
    }

    public function setProcess(Process $process): void
    {
        $this->process = $process;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->process, $name], $arguments);
    }
}
