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
use CodeGenerator\Contracts\JTScript\CommentInterface;
use CodeGenerator\Contracts\JTScript\ElementInterface;
use CodeGenerator\Contracts\JTScript\ClassTrait;
use CodeGenerator\Contracts\JTScript\CommentTrait;
use CodeGenerator\Contracts\JTScript\DecoratorTrait;
use CodeGenerator\Contracts\JTScript\NameTrait;
use CodeGenerator\Contracts\JTScript\ElementTrait;
use CodeGenerator\Component\JTScript\Exception\RenderAssertion;

/**
 * Class ES6Class
 *
 * @package CodeGenerator
 */
class ES6Class implements ClassInterface, ElementInterface, CommentInterface
{
    use CommentTrait;
    use NameTrait;
    use ElementTrait;
    use ClassTrait;
    use DecoratorTrait;

    private string $type = 'class';

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
        return (new Renderer())->renderESClass($this);
    }
}
