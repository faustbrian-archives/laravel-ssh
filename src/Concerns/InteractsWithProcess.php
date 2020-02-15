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

use Closure;
use KodeKeep\SecureShell\Contracts\ProcessRunner;

trait InteractsWithProcess
{
    public ProcessRunner $processRunner;

    public Closure $processConfiguration;

    public Closure $outputCallback;

    public ?string $workingDirectory = null;

    public function configureProcessRunner(ProcessRunner $processRunner): self
    {
        $this->processRunner = $processRunner;

        return $this;
    }

    public function configureProcess(Closure $processConfiguration): self
    {
        $this->processConfiguration = $processConfiguration;

        return $this;
    }

    public function whenOutput(Closure $outputCallback): self
    {
        $this->outputCallback = $outputCallback;

        return $this;
    }

    public function useWorkingDirectory(string $workingDirectory): self
    {
        $this->workingDirectory = $workingDirectory;

        return $this;
    }
}
