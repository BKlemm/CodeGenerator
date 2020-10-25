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


use CodeGenerator\Component\Java\Structure\Annotation;

/**
 * Trait DecoratorTrait
 *
 * @package CodeGenerator\Contracts\Java
 */
trait AnnotationTrait
{
    /** @var Annotation[] */
    private array $annotations = [];

    /**
     * @param string $name
     * @param mixed  $values
     *
     * @return ClassInterface
     */
    public function addAnnotation(string $name, $values = null): ClassInterface
    {
        if (!isset($this->annotations[$name])) {
            $this->annotations[$name] = (new Annotation($name))->setValue($values);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAnnotations(): bool
    {
        return (bool) count($this->annotations);
    }

    /**
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }

    /**
     * @param string $name
     *
     * @return Annotation|null
     */
    public function getAnnotation(string $name): ?Annotation
    {
        if (\array_key_exists($name, $this->annotations)) {
            return $this->annotations[$name];
        }
        return null;
    }
}
