<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Delegate;


use JTGenerator\Exception\InvalidArgumentException;
use JTGenerator\Structure\Method;
use JTGenerator\Structure\Property;

/**
 * Trait RepositoryTrait
 *
 * @package JTGenerator\Delegate
 */
trait ElementTrait
{
    /** @var Property[] name => Property */
    private array $properties = [];

    /** @var Method[] name => Method */
    private array $methods = [];

    /**
     * @param array<Method> $methods
     *
     * @return $this
     */
    public function setMethods(array $methods): self
    {
        foreach ($methods as $method) {
            if (!$method instanceof Method) {
                throw new InvalidArgumentException('Must be type Method[]');
            }

            $this->methods[$method->getName()] = $method;
        }

        return $this;
    }

    /**
     * @param string $name
     */
    public function addMethod(string $name): void
    {
        if (!isset($this->methods[$name])) {
            $this->methods[$name] = new Method($name);
        }
    }

    /**
     * @param array<Property> $properties
     *
     * @return $this
     */
    public function setProperties(array $properties): self
    {
        foreach ($properties as $property) {
            if (!$property instanceof Property) {
                throw new InvalidArgumentException('Must be type Property[]');
            }
            $this->properties[$property->getName()] = $property;
        }

        return $this;
    }

    /**
     * @param string      $name
     * @param string|null $value
     */
    public function addProperty(string $name, string $value = null): void
    {
        if (!isset($this->properties[$name])) {
            $this->properties[$name] = (new Property($name))->setValue($value);
        }
    }

    /**
     * @return Method[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param string $name
     *
     * @return Method|null
     */
    public function getMethod(string $name): ?Method
    {
        if (\array_key_exists($name, $this->methods)) {
            return $this->methods[$name];
        }
        return null;
    }

    /**
     * @param string $name
     *
     * @return Property|null
     */
    public function getProperty(string $name): ?Property
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        return null;
    }

}
