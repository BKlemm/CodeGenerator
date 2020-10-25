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


use CodeGenerator\Contracts\JTScript\CommentInterface;
use CodeGenerator\Contracts\JTScript\ElementInterface;
use CodeGenerator\Contracts\JTScript\CommentTrait;
use CodeGenerator\Contracts\JTScript\MemberTrait;
use CodeGenerator\Contracts\JTScript\NameTrait;
use CodeGenerator\Contracts\JTScript\ElementTrait;
use CodeGenerator\Contracts\JTScript\ValueTrait;
use CodeGenerator\Component\JTScript\Renderer;

/**
 * Class Constant
 *
 * @package CodeGenerator\Component\JTScript\Structure
 */
class Constant implements CommentInterface, ElementInterface
{
    use NameTrait;
    use MemberTrait;
    use CommentTrait;
    use ElementTrait;
    use ValueTrait;

    private bool $export = false;

    private bool $object = true;

    /**
     * @param bool $export
     *
     * @return $this
     */
    public function setExport(bool $export = true): self
    {
        $this->export = $export;

        return $this;
    }

    /**
     * @return bool
     */
    public function isExport(): bool
    {
        return $this->export;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new Renderer())->renderConstant($this);
    }

    /**
     * @param bool $state
     *
     * @return $this
     */
    public function setObject(bool $state = true): self
    {
        $this->object = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isObject(): bool
    {
        return $this->object;
    }

}
