<?php
/*
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
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
use JTGenerator\Delegate\DecoratorTrait;
use JTGenerator\Delegate\NameTrait;
use JTGenerator\Delegate\ObjectTrait;
use JTGenerator\Delegate\ElementTrait;
use JTGenerator\Exception\RenderAssertion;

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
    use DecoratorTrait;

    public const
        CLASS_TYPE     = 'class',
        INTERFACE_TYPE = 'interface';

    private string $type = self::CLASS_TYPE;

    /**
     * @throws \Exception
     */
    public function validate(): void
    {
        RenderAssertion::assertName($this->getName());
        RenderAssertion::assertRules($this);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function __toString(): string
    {
        return (new Renderer())->renderClass($this);
    }
}
