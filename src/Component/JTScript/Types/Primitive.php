<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript\Types;


/**
 * Class Primitive
 *
 * @package CodeGenerator
 */
final class Primitive
{
    public const
        STRING    = 'string',
        BOOLEAN   = 'boolean',
        ARRAY     = 'Array',
        OBJECT    = 'Object',
        NUMBER    = 'number',
        ANY       = 'any',
        VOID      = 'void',
        NULL      = 'null',
        UNDEFINED = 'undefined',
        NEVER     = 'never';
}
