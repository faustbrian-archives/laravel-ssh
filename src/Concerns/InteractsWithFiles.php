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

trait InteractsWithFiles
{
    public ?string $copySource = null;

    public ?string $copyTarget = null;

    public function copy(string $source, string $target): self
    {
        $this->copySource = $source;
        $this->copyTarget = $target;

        return $this;
    }
}
