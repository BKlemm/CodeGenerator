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
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Interface ClassInterface
 *
 * @package CodeGenerator\Contracts
 */
interface ClassInterface
{
    /**
     *
     */
    public function validate(): void;

    public function isAbstract(): bool;

    public function hasDecorator(): bool;

    public function hasExtend(): bool;

    public function getExtend(): string;
}
