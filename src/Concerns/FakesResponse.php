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

use Exception;
use Facades\KodeKeep\SecureShell\ShellProcessRunner as Facade;
use KodeKeep\SecureShell\ShellResponse;

trait FakesResponse
{
    /**
     * @codeCoverageIgnore
     */
    public function mock(int $exitCode, string $output, bool $timedOut): void
    {
        Facade::shouldReceive('run')->andReturn(new ShellResponse($exitCode, $output, $timedOut));
    }

    /**
     * @codeCoverageIgnore
     */
    public function mockException(Exception $exception): void
    {
        Facade::shouldReceive('run')->andThrow($exception);
    }
}
