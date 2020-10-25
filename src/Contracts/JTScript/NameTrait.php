<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Contracts\JTScript;


/**
 * Trait NameTrait
 *
 * @package CodeGenerator\Delegate
 */
trait NameTrait
{
    private ?string $name = null;

    /**
     * NameTrait constructor.
     *
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        $this->name = $name;
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
