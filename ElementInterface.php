<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Contracts;

use JTGenerator\Structure\Method;
use JTGenerator\Structure\Property;

/**
 * Interface MembersInterface
 *
 * @package JTGenerator\Contracts
 */
interface ElementInterface
{
    /**
     * @param array<Method> $methods
     *
     * @return $this
     */
    public function setMethods(array $methods): self;

    /**
     * @param string $name
     */
    public function addMethod(string $name): void;

    /**
     * @param array<Property> $properties
     *
     * @return $this
     */
    public function setProperties(array $properties): self;

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
