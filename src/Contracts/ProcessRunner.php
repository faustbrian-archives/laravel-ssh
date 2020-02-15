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

namespace KodeKeep\SecureShell\Contracts;

use KodeKeep\SecureShell\ShellResponse;
use Symfony\Component\Process\Process;

interface ProcessRunner
{
    public function run(Process $process): ShellResponse;
}