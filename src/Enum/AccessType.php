<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Enum;


/**
 * Class AccessType
 *
 * @package JTGenerator
 */
class AccessType
{
    public const
        PUBLIC      = 'public',
        PRIVATE     = 'private',
        PROTECTED   = 'protected',
        READONLY    = 'readonly',
        STATIC_TYPE = 'static';
}
