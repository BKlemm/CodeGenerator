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


use CodeGenerator\Contracts\Common\CommentInterface;
use CodeGenerator\Contracts\Common\CommentTrait;
use CodeGenerator\Contracts\Java\AnnotationTrait;
use CodeGenerator\Contracts\Java\MemberTrait;
use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Contracts\Common\ValueTrait;

/**
 * Class Property
 *
 * @package CodeGenerator\Component\Java\Structure
 */
class Property implements CommentInterface
{
    use MemberTrait;
    use CommentTrait;
    use NameTrait;
    use ValueTrait;
    use AnnotationTrait;
}
