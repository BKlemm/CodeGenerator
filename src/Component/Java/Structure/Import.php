<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java\Structure;


use CodeGenerator\Contracts\Common\NameTrait;

/**
 * Class Import
 *
 * @package CodeGenerator\Component\Java\Structure
 */
class Import
{
    use NameTrait;

    private array $imports;

    /**
     * @param $value
     *
     * @return $this
     */
    public function addImport($value): self
    {
        $this->imports[$this->getName()] = $value;
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
