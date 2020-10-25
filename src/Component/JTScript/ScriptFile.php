<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript;


use CodeGenerator\Contracts\JTScript\ClassInterface;
use CodeGenerator\Contracts\Common\CommentInterface;
use CodeGenerator\Contracts\Common\CommentTrait;
use CodeGenerator\Component\JTScript\Structure\Constant;
use CodeGenerator\Component\JTScript\Structure\Export;
use CodeGenerator\Component\JTScript\Structure\Import;

/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


/**
 * Class ScriptFile
 */
class ScriptFile implements CommentInterface
{
    use CommentTrait;

    private array $imports = [];

    private array $exports = [];

    private ?ClassInterface $class = null;

    /** @var array */
    private array $content = [];

    /** @var array  */
    private array $constants = [];

    /**
     * @param array  $imports
     * @param string $from
     *
     * @return self
     */
    public function addImport(array $imports, string $from): self
    {
        if (!isset($this->imports[$from])) {
            $this->imports[$from] = (new Import($from))->addImport($imports);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (new Renderer())->renderFile($this);
    }

    /**
     * @return array
     */
    public function getImports(): array
    {
        return $this->imports;
    }

    /**
     * @return bool
     */
    public function hasClass(): bool
    {
        return $this->class !== null;
    }

    /**
     * @return ClassInterface
     */
    public function getClass(): ClassInterface
    {
        return $this->class;
    }

    /**
     * @param ClassInterface $class
     *
     * @return $this
     */
    public function setClass(ClassInterface $class): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasContent(): bool
    {
        return $this->content !== null;
    }

    /**
     * @param object $state
     *
     * @return $this
     */
    public function addContent(object $state): self
    {
        $this->content[] = (string) $state;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array  $export
     * @param string $from
     *
     * @return $this
     */
    public function addExport(array $export, string $from): self
    {
        if (!isset($this->exports[$from])) {
            $this->exports[$from] = (new Export($from))->addExport($export);
        }
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
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function addConstant(string $name, $value): self
    {
        if (!isset($this->constants[$name])) {
            $this->constants[$name] = (new Constant($name))->setValue($value);
        }
        return $this;
    }

    /**
     * @param Constant $constant
     *
     * @return $this
     */
    public function setConstant(Constant $constant): self
    {
        if (!isset($this->constants[$constant->getName()])) {
            $this->constants[$constant->getName()] = $constant;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

}
