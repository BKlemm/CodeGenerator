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

/**
 * Trait MemberTrait
 *
 * @package CodeGenerator\Delegate
 */
trait MemberTrait
{
    private bool $nullable = false;

    private ?string $access = null;

    /** @var string|array|null */
    private $type;

    /**
     * @param bool $state
     *
     * @return $this
     */
    public function setNullable(bool $state = true): self
    {
        $this->nullable = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return bool
     */
    public function hasAccess(): bool
    {
        return $this->access !== null;
    }

    /**
     * @return string
     */
    public function getAccess(): ?string
    {
        return $this->access;
    }

    /**
     * @param string $access
     *
     * @return self
     */
    public function setAccess(string $access): self
    {
        $this->access = $access;

        return $this;
    }

    /**
     * @return string|array|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|array $type
     *
     * @return self
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasType(): bool
    {
        return $this->type !== null;
    }

    /**
     * @return bool
     */
    public function typeIsArray(): bool
    {
        return $this->hasType() && \is_array($this->type);
    }

    /**
     * @return bool
     */
    public function typeIsString(): bool
    {
        return $this->hasType() && \is_string($this->type);
    }
}
