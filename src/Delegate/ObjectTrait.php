<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Delegate;


/**
 * Trait ObjectTrait
 *
 * @package JTGenerator\Delegate
 */
trait ObjectTrait
{
    private bool $export = false;

    private bool $default = false;

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
     * @param bool $state
     *
     * @return $this
     */
    public function setDefault(bool $state = true): self
    {
        $this->default = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }
}
