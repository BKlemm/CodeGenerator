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


use CodeGenerator\Contracts\JTScript\NameTrait;

/**
 * Class Export
 *
 * @package CodeGenerator\Component\JTScript\Structure
 */
class Export
{
    use NameTrait;

    private array $exports;

    /**
     * @param array  $values
     *
     * @return $this
     */
    public function addExport(array $values): self
    {
        if (isset($this->exports[$this->getName()])) {
            throw new \InvalidArgumentException("Export {$this->getName()} used already");
        }

        $this->exports[$this->getName()] = $values;
        asort($this->exports);
        return $this;
    }

    /**
     * @return array
     */
    public function getExports(): array
    {
        return $this->exports;
    }

    /**
     * @param Export ...$exports
     */
    public function setExports(Export ...$exports): void
    {
        foreach ($exports as $export) {
            $this->exports[$export->getName()] = $exports;
        }
    }
}
