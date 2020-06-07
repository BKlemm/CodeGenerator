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


use JTGenerator\Contracts\CommentInterface;
use JTGenerator\Delegate\CommentTrait;
use JTGenerator\Delegate\MemberTrait;
use JTGenerator\Delegate\NameTrait;
use JTGenerator\Delegate\ValueTrait;

/**
 * Class Property
 *
 * @package JTGenerator\Structure
 */
class Property implements CommentInterface
{
    use MemberTrait;
    use CommentTrait;
    use NameTrait;
    use ValueTrait;

    private ?Decorator $decorator = null;

    private bool $definiteAssignment = false;

    /**
     * @param string $name
     * @param mixed  $values
     *
     * @return $this
     */
    public function setDecorator(string $name, $values = null): self
    {
        $this->decorator = (new Decorator($name))->setValues($values);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDecorator(): bool
    {
        return $this->decorator !== null;
    }

    /**
     * @return Decorator|null
     */
    public function getDecorator(): ?Decorator
    {
        return $this->decorator;
    }

    /**
     * @param bool $state
     *
     * @return $this
     */
    public function setDefiniteAssignment(bool $state = true): self
    {
        $this->definiteAssignment = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDefiniteAssignment(): bool
    {
        return $this->definiteAssignment;
    }
}
