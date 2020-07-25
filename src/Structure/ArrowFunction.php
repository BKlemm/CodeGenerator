<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Structure;


use JTGenerator\Contracts\ElementInterface;
use JTGenerator\Delegate\NameTrait;
use JTGenerator\Delegate\ObjectTrait;
use JTGenerator\Delegate\ElementTrait;
use JTGenerator\Renderer;

/**
 * Class ArrowFunction
 *
 * @package JTGenerator\Structure
 */
class ArrowFunction implements ElementInterface
{
    use NameTrait;
    use ElementTrait;
    use ObjectTrait;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new Renderer())->renderArrowFunction($this);
    }
}
