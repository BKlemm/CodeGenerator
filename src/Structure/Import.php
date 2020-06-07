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
 * Class Import
 *
 * @package JTGenerator\Structure
 */
class Import
{
    private array $imports;

    /**
     * @param array  $values
     * @param string $from
     *
     * @return $this
     */
    public function addImport($values, string $from): self
    {
        if (isset($this->imports[$from])) {
            throw new \InvalidArgumentException("Import $from used already");
        }

        $this->imports[$from] = $values;
        return $this;
    }

    /**
     * @return array
     */
    public function getImports(): array
    {
        return $this->imports;
    }

}
