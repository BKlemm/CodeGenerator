<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Delegate;


use JTGenerator\Exception\InvalidStateException;

/**
 * Trait NameTrait
 *
 * @package JTGenerator\Delegate
 */
trait NameTrait
{
    private string $name;

    /**
     * NameTrait constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     *
     */
    public function validateName(): void
    {
        $pattern = "/[A-Za-z_][\w]*/";
        if (!preg_match($pattern, $this->name)) {
            throw new InvalidStateException('Is not a valid name for classes or members');
        }
    }
}
