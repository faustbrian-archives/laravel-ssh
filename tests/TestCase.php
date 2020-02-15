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

namespace KodeKeep\SecureShell\Tests;

use KodeKeep\SecureShell\Contracts\ProcessRunner;
use KodeKeep\SecureShell\ProcessRunners\MockProcessRunner;
use KodeKeep\SecureShell\SecureShell;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function configureProcessRunner(SecureShell $shell, int $exitCode, string $output, bool $timedOut): ProcessRunner
    {
        $runner = new MockProcessRunner();
        $runner->mock($exitCode, $output, $timedOut);

        $shell->configureProcessRunner($runner);

        return $runner;
    }
}
