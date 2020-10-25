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


use CodeGenerator\Contracts\Common\NameTrait;
use CodeGenerator\Component\JTScript\Renderer;

/**
 * Class Decorator
 *
 * @package CodeGenerator\Component\JTScript\Structure
 */
class Decorator
{
    use NameTrait;

    /** @var mixed */
    private $values;

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     *
     * @return Decorator
     */
    public function setValues($values): self
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasValues(): bool
    {
        return $this->values !== null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new Renderer())->renderDecorator($this);
    }
}
