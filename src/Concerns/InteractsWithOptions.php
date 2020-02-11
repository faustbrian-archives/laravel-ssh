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

trait InteractsWithOptions
{
    public string $user;

    public string $host;

    public int $port = 22;

    public ?string $pathToPrivateKey = null;

    public int $timeout = 0;

    public bool $enableStrictHostKeyChecking = true;

    public bool $enableBatchMode = true;

    public bool $enablePasswordAuthentication = false;

    public function useUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function useHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function usePort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function usePrivateKey(string $pathToPrivateKey): self
    {
        $this->pathToPrivateKey = $pathToPrivateKey;

        return $this;
    }

    public function useTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function enableStrictHostKeyChecking(): self
    {
        $this->enableStrictHostKeyChecking = true;

        return $this;
    }

    public function disableStrictHostKeyChecking(): self
    {
        $this->enableStrictHostKeyChecking = false;

        return $this;
    }

    public function enableBatchMode(): self
    {
        $this->enableBatchMode = true;

        return $this;
    }

    public function disableBatchMode(): self
    {
        $this->enableBatchMode = false;

        return $this;
    }

    public function enablePasswordAuthentication(): self
    {
        $this->enablePasswordAuthentication = true;

        return $this;
    }

    public function disablePasswordAuthentication(): self
    {
        $this->enablePasswordAuthentication = false;

        return $this;
    }
}
