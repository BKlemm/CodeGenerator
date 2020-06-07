<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator;


use JTGenerator\Contracts\ClassInterface;
use JTGenerator\Contracts\CommentInterface;
use JTGenerator\Contracts\ElementInterface;
use JTGenerator\Delegate\ClassTrait;
use JTGenerator\Delegate\CommentTrait;
use JTGenerator\Delegate\NameTrait;
use JTGenerator\Delegate\ObjectTrait;
use JTGenerator\Delegate\ElementTrait;
use JTGenerator\Structure\Decorator;

/**
 * Class TypescriptClass
 *
 * @package JTGenerator
 */
class TSClass implements ClassInterface, ElementInterface, CommentInterface
{
    use CommentTrait;
    use NameTrait;
    use ElementTrait;
    use ClassTrait;
    use ObjectTrait;

    public const
        CLASS_TYPE     = 'class',
        INTERFACE_TYPE = 'interface';

    private string $type = self::CLASS_TYPE;

    private bool $abstract = false;

    /** @var Decorator[] */
    private array $decorators = [];


    /**
     * @param string $name
     * @param mixed  $values
     *
     * @return TSClass
     */
    public function addDecorator(string $name, $values = null): self
    {
        if (!isset($this->decorators[$name])) {
            $this->decorators[$name] = (new Decorator($name))->setValues($values);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->abstract;
    }

    /**
     * @throws \Exception
     */
    public function validate(): void
    {
        $this->validateName();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function __toString(): string
    {
        return (new Renderer())->renderClass($this);
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
