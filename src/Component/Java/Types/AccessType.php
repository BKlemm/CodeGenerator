<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java\Types;


/**
 * Class AccessType
 *
 * @package CodeGenerator
 */
final class AccessType
{
    public const
        PACKAGE     = '',
        PUBLIC      = 'public',
        PRIVATE     = 'private',
        PROTECTED   = 'protected',
        FINAL       = 'final',
        STATIC_TYPE = 'static';
}
