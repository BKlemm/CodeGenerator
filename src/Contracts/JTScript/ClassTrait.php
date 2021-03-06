<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Contracts\JTScript;

use CodeGenerator\Component\JTScript\Structure\Import;

/**
 * Trait ClassTrait
 *
 * @package CodeGenerator\Delegate
 */
trait ClassTrait
{
    /** @var Import[] */
    private array $imports = [];

    private ?string $extend = null;

    /** @var string[] */
    private array $implements = [];

    private bool $abstract = false;

    /**
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->abstract;
    }

    /**
     * @param bool $abstract
     */
    public function setAbstract(bool $abstract = true): void
    {
        $this->abstract = $abstract;
    }

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
