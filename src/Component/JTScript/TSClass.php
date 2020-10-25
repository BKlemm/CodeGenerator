<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript;


use CodeGenerator\Contracts\JTScript\ClassInterface;
use CodeGenerator\Contracts\Common\CommentInterface;
use CodeGenerator\Contracts\JTScript\DecoratorTrait;
use CodeGenerator\Contracts\JTScript\ElementInterface;
use CodeGenerator\Contracts\JTScript\ClassTrait;
use CodeGenerator\Contracts\Common\CommentTrait;
use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Contracts\JTScript\ObjectTrait;
use CodeGenerator\Contracts\JTScript\ElementTrait;
use CodeGenerator\Component\JTScript\Exception\RenderAssertion;

/**
 * Class TypescriptClass
 *
 * @package CodeGenerator
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
