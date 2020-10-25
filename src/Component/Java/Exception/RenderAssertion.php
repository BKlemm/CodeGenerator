<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java\Exception;


/**
 * Class RenderAssertion
 *
 * @package CodeGenerator\Component\Java\Exception
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

}
