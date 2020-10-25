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


use CodeGenerator\Component\JTScript\Structure\Decorator;

/**
 * Trait DecoratorTrait
 *
 * @package CodeGenerator\Contracts\JTScript
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
    public function hasDecorators(): bool
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
