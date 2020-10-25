<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Contracts\Java;

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
 * @package CodeGenerator\Contracts\Java
 */
interface ClassInterface
{
    /**
     *
     */
    public function validate(): void;

    public function isAbstract(): bool;

    public function isFinal(): bool;

    public function hasAnnotations(): bool;

    public function hasExtend(): bool;

    public function getExtend(): string;

    public function getAccess(): string;
}
