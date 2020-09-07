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
use JTGenerator\Delegate\ElementTrait;
use JTGenerator\Exception\RenderAssertion;

/**
 * Class ES6Class
 *
 * @package JTGenerator
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
