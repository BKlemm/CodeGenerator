<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript\Structure;


use CodeGenerator\Contracts\Common\NameTrait;

/**
 * Class Import
 *
 * @package CodeGenerator\Component\JTScript\Structure
 */
class Import
{
    use NameTrait;

    private array $imports;

    /**
     * @param array  $values
     *
     * @return $this
     */
    public function addImport(array $values): self
    {
        if (isset($this->imports[$this->getName()])) {
            throw new \InvalidArgumentException("Import {$this->getName()} used already");
        }

        $this->imports[$this->getName()] = $values;
        return $this;
    }

    /**
     * @return array
     */
    public function getImports(): array
    {
        return $this->imports;
    }

    /**
     * @param Import ...$imports
     */
    public function setImports(Import ...$imports): void
    {
        foreach ($imports as $import) {
            $this->imports[$import->getName()] = $import;
        }
    }

}
