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
use CodeGenerator\Contracts\Common\CommentInterface;
use CodeGenerator\Contracts\Java\ElementInterface;
use CodeGenerator\Contracts\Common\CommentTrait;
use CodeGenerator\Contracts\Java\MemberTrait;
use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Contracts\Java\ElementTrait;
use CodeGenerator\Contracts\Common\ValueTrait;

/**
 * Class Constant
 *
 * @package CodeGenerator\Component\Java\Structure
 */
class Constant implements CommentInterface, ElementInterface
{
    use NameTrait;
    use MemberTrait;
    use CommentTrait;
    use ElementTrait;
    use ValueTrait;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new JavaRenderer())->renderConstant($this);
    }

}
