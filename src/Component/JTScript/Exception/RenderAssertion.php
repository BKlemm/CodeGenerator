<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript\Exception;


use CodeGenerator\Contracts\JTScript\ClassInterface;

/**
 * Class RenderAssertion
 *
 * @package CodeGenerator\Component\JTScript\Exception
 */
class RenderAssertion
{
    /**
     * @param string $name
     */
    public static function assertName(string $name): void
    {
        $pattern = "/[A-Za-z_][\w]*/";
        if (!preg_match($pattern, $name)) {
            throw new InvalidStateException('Is not a valid name for classes or members');
        }
    }

    /**
     * @param ClassInterface $clazz
     */
    public static function assertRules(ClassInterface $clazz): void
    {
        if ($clazz->hasDecorators() && $clazz->isAbstract()) {
            throw new InvalidStateException('Class could not be abstract and has a class decorator');
        }
    }
}
