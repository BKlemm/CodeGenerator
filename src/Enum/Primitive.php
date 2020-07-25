<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Enum;


/**
 * Class Primitive
 *
 * @package JTGenerator
 */
class Primitive
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
