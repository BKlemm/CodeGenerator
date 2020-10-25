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
use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Contracts\Common\ValueTrait;

/**
 * Class Decorator
 *
 * @package CodeGenerator\Component\Java\Structure
 */
class Annotation
{
    use NameTrait;
    use ValueTrait;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new JavaRenderer())->renderAnnotation($this);
    }
}
