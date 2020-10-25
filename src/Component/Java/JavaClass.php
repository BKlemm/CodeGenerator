<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java;


use CodeGenerator\Contracts\ClassInterface;
use CodeGenerator\Contracts\CommentInterface;
use CodeGenerator\Contracts\ElementInterface;
use CodeGenerator\Delegate\ClassTrait;
use CodeGenerator\Delegate\CommentTrait;
use CodeGenerator\Delegate\DecoratorTrait;
use CodeGenerator\Delegate\NameTrait;
use CodeGenerator\Delegate\ObjectTrait;
use CodeGenerator\Delegate\ElementTrait;
use CodeGenerator\Exception\RenderAssertion;

/**
 * Class TypescriptClass
 *
 * @package CodeGenerator
 */
class JavaClass implements ClassInterface, ElementInterface, CommentInterface
{
    use CommentTrait;
    use NameTrait;
    use ElementTrait;
    use ClassTrait;
    use ObjectTrait;
    use DecoratorTrait;

    public const
        CLASS_TYPE     = 'class',
        INTERFACE_TYPE = 'interface',
        ENUM_TYPE      = 'enum';

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
        return (new JavaRenderer())->renderClass($this);
    }
}
