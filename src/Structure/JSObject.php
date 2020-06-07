<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Structure;


use JTGenerator\Contracts\ElementInterface;
use JTGenerator\Delegate\ObjectTrait;
use JTGenerator\Delegate\ElementTrait;
use JTGenerator\Renderer;

/**
 * Class JSObject
 *
 * @package JTGenerator\Structure
 */
class JSObject implements ElementInterface
{
    use ObjectTrait;
    use ElementTrait;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new Renderer())->renderObject($this);
    }
}
