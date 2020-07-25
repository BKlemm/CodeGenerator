<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Delegate;

use JTGenerator\Structure\Import;

/**
 * Trait ClassTrait
 *
 * @package JTGenerator\Delegate
 */
trait ClassTrait
{
    /** @var Import[] */
    private array $imports = [];

    private string $extend;

    /** @var string[] */
    private array $implements = [];

    /**
     * @param string $name
     */
    public function addExtend(string $name): void
    {
        $this->extend = $name;
    }

    /**
     * @return bool
     */
    public function hasExtend(): bool
    {
        return $this->extend !== null;
    }

    /**
     * @return bool
     */
    public function hasImplements(): bool
    {
        return (bool) count($this->implements);
    }

    /**
     * @return string
     */
    public function getExtend(): string
    {
        return $this->extend;
    }

    /**
     * @return array
     */
    public function getImplements(): array
    {
        return $this->implements;
    }
}
