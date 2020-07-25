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

    /** @var string[] */
    private array $extends = [];

    /** @var string[] */
    private array $implements = [];

    /**
     * @param string ...$extends
     *
     * @return $this
     */
    public function setExtends(string ...$extends): self
    {
        $this->extends = $extends;
        return $this;
    }

    /**
     * @param string $name
     */
    public function addExtend(string $name): void
    {
        if (!isset($this->extends[$name])) {
            $this->extends[] = $name;
        }
    }

    /**
     * @return bool
     */
    public function hasExtends(): bool
    {
        return (bool) count($this->extends);
    }

    /**
     * @return bool
     */
    public function hasImplements(): bool
    {
        return (bool) count($this->implements);
    }

    /**
     * @return array
     */
    public function getExtends(): array
    {
        return $this->extends;
    }

    /**
     * @return array
     */
    public function getImplements(): array
    {
        return $this->implements;
    }
}
