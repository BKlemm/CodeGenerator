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

use CodeGenerator\Component\Java\Structure\Method;
use CodeGenerator\Component\Java\Structure\Property;

/**
 * Interface MembersInterface
 *
 * @package CodeGenerator\Contracts
 */
interface ElementInterface
{
    /**
     * @param Method ...$methods
     *
     * @return $this
     */
    public function setMethods(Method ...$methods): self;

    /**
     * @param string $name
     */
    public function addMethod(string $name): void;

    /**
     * @param Property ...$properties
     *
     * @return $this
     */
    public function setProperties(Property ...$properties): self;

    /**
     * @param string      $name
     * @param string|null $value
     */
    public function addProperty(string $name, string $value = null): void;

    /**
     * @return Method[]
     */
    public function getMethods(): array;

    /**
     * @return Property[]
     */
    public function getProperties(): array;

    /**
     * @param string $name
     *
     * @return Method|null
     */
    public function getMethod(string $name): ?Method;

    /**
     * @param string $name
     *
     * @return Property|null
     */
    public function getProperty(string $name): ?Property;
}
