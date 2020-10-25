<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java\Structure;


use CodeGenerator\Component\Java\JavaRenderer;
use CodeGenerator\Contracts\Java\ElementInterface;
use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Contracts\Java\ObjectTrait;
use CodeGenerator\Contracts\Java\ElementTrait;

/**
 * Class ArrowFunction
 *
 * @package CodeGenerator\Component\Java\Structure
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
        return (new JavaRenderer())->renderArrowFunction($this);
    }
}
