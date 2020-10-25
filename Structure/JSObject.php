<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript\Structure;


use CodeGenerator\Contracts\JTScript\ElementInterface;
use CodeGenerator\Contracts\JTScript\ObjectTrait;
use CodeGenerator\Contracts\JTScript\ElementTrait;
use CodeGenerator\Component\JTScript\Renderer;

/**
 * Class JSObject
 *
 * @package CodeGenerator\Component\JTScript\Structure
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
