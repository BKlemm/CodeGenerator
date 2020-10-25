<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Contracts\Java;

use CodeGenerator\Component\Java\Structure\Import;
use CodeGenerator\Component\Java\Types\AccessType;

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

    private bool $final = false;

    private string $acccess = AccessType::PUBLIC;

    private ?string $package = null;

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->final;
    }

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
     * @param array  $imports
     *
     * @return self
     */
    public function addImports(array $imports): self
    {
        foreach ($imports as $import) {
            $this->imports[] = (new Import($import))->addImport($import);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getImports(): array
    {
        return $this->imports;
    }

    /**
     * @return bool
     */
    public function hasImports(): bool
    {
        return (bool) count($this->imports);
    }

    /**
     * @return string
     */
    public function getAccess(): string
    {
        return $this->acccess;
    }

    /**
     * @param string $access
     *
     * @return $this
     */
    public function setAccess(string $access = AccessType::PUBLIC): self
    {
        $this->acccess = $access;

        return $this;
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

    /**
     * @return string|null
     */
    public function getPackage(): ?string
    {
        return $this->package;
    }

    /**
     * @param string|null $package
     *
     * @return ClassTrait
     */
    public function setPackage(?string $package): self
    {
        $this->package = $package;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasPackage(): bool
    {
        return $this->package !== null;
    }
}
