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


use CodeGenerator\Component\Java\Exception\RenderAssertion;
use CodeGenerator\Contracts\Common\CommentTrait;
use CodeGenerator\Contracts\Java\AnnotationTrait;
use CodeGenerator\Contracts\Java\ClassInterface;
use CodeGenerator\Contracts\Common\CommentInterface;
use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Contracts\Java\ClassTrait;
use CodeGenerator\Contracts\Java\ElementInterface;
use CodeGenerator\Contracts\Java\ElementTrait;

/**
 * Class TypescriptClass
 *
 * @package CodeGenerator
 */
class JavaClass implements ClassInterface, ElementInterface, CommentInterface
{
    use CommentTrait;
    use NameTrait;
    use ClassTrait;
    use AnnotationTrait;
    use ElementTrait;

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
