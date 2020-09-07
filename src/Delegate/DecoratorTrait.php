<?php
/*
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Delegate;


use JTGenerator\Contracts\ClassInterface;
use JTGenerator\Structure\Decorator;

/**
 * Trait DecoratorTrait
 *
 * @package JTGenerator\Delegate
 */
trait DecoratorTrait
{
    /** @var Decorator[] */
    private array $decorators = [];

    /**
     * @param string $name
     * @param mixed  $values
     *
     * @return ClassInterface
     */
    public function addDecorator(string $name, $values = null): ClassInterface
    {
        if (!isset($this->decorators[$name])) {
            $this->decorators[$name] = (new Decorator($name))->setValues($values);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDecorator(): bool
    {
        return (bool) count($this->decorators);
    }

    /**
     * @return array
     */
    public function getDecorators(): array
    {
        return $this->decorators;
    }

    /**
     * @param string $name
     *
     * @return Decorator|null
     */
    public function getDecorator(string $name): ?Decorator
    {
        if (\array_key_exists($name, $this->decorators)) {
            return $this->decorators[$name];
        }
        return null;
    }
}
