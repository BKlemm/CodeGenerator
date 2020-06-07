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


/**
 * Class Export
 *
 * @package JTGenerator\Structure
 */
class Export
{
    private array $exports;

    /**
     * @param array  $values
     * @param string $from
     *
     * @return $this
     */
    public function addExport(array $values, string $from): self
    {
        if (isset($this->exports[$from])) {
            throw new \InvalidArgumentException("Export $from used already");
        }

        $this->exports[$from] = $values;
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
}
