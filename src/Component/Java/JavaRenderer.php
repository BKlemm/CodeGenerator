<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java;


use CodeGenerator\Component\Java\Types\Primitive;
use CodeGenerator\Contracts\Java\ElementInterface;
use CodeGenerator\Component\Java\Exception\InvalidArgumentException;
use CodeGenerator\Component\Java\Structure\ArrowFunction;
use CodeGenerator\Component\Java\Structure\Constant;
use CodeGenerator\Component\Java\Structure\Annotation;
use CodeGenerator\Component\Java\Structure\Import;
use CodeGenerator\Component\Java\Structure\Method;
use CodeGenerator\Component\Java\Structure\Property;

/**
 * Class Printer
 *
 * @package CodeGenerator
 */
class JavaRenderer
{

    private string $indentCharacter = "\t";

    /**
     * @param Import $nodes
     *
     * @return string
     */
    public function renderImports(Import $nodes): string
    {
        $imports = [];
        foreach ($nodes->getImports() as $key => $val) {
            $imports[] = 'import '.$key .";";
        }
        return implode(PHP_EOL, $imports);
    }


    /**
     * @param JavaClass $class
     *
     * @return string
     * @throws \Exception
     */
    public function renderClass(JavaClass $class): string
    {
        $class->validate();

        $imports = [];
        foreach ($class->getImports() as $import) {
            $imports[] = $this->renderImports($import);
        }

        $members = $this->renderMembers($class);

        $annotations = [];
        foreach ($class->getAnnotations() as $decorator) {
            $annotations[] = $this->renderAnnotation($decorator);
        }

        return ($class->hasPackage() ? 'package ' . $class->getPackage() .';'. PHP_EOL : '')
            . ($class->hasImports() ? implode(PHP_EOL, $imports) . PHP_EOL : '')
            .($class->hasComment() ? $class->formatComment() : '')
            . ($class->hasAnnotations() ? implode(PHP_EOL,$annotations) .PHP_EOL : '')
            . ($class->isAbstract() ? 'abstract ' : '')
            . $class->getAccess()
            . ($class->isFinal() ? ' final ' : '')
            . 'class ' . $class->getName() . ' '
            . ($class->hasExtend() ? 'extends ' . $class->getExtend() : '')
            . ($class->hasImplements() ? 'implements ' . implode(', ', $class->getImplements()) : '')
            . ' {' . PHP_EOL
            . ($members ? $this->indent(implode(PHP_EOL, $members)) : '')
            . PHP_EOL.'}';
    }

    /**
     * @param Property $property
     *
     * @return string
     */
    public function renderProperties(Property $property): string
    {
        return ($property->hasComment() ? $property->formatComment() . PHP_EOL : '')
            . ($property->hasAnnotations() ? $this->renderAnnotation($property->getAnnotation()) . PHP_EOL : '')
            . ($property->hasAccess() ? $property->getAccess() : '')
            . $property->getType() . ' ' . $property->getName()
            . ($property->hasValue() ? $this->renderValue($property->getValue()) : '');
    }

    /**
     * @param Method $method
     *
     * @return string
     */
    public function renderMethods(Method $method): string
    {
        $method->validate();

        return ($method->hasComment() ? $method->formatComment() : '')
            . ($method->isAbstract() ? 'abstract ' : '')
            . ($method->hasAccess() ? $method->getAccess().' ' : '')
            . ($method->isStatic() ? 'static ' : '')
            . ($method->isFinal() ? ' final ' : '')
            . $method->getReturnType() . ' '
            . $method->getName()
            . '('.$this->renderParameter($method).')'
            . ($method->isAbstract() || $method->getBody() === null
                ? ";\n"
                : ' {' . ($method->hasBody() ? PHP_EOL : ' ')
                . $this->indent($method->getBody()) . PHP_EOL
                . "}");

    }

    /**
     * @param Method $method
     *
     * @return string
     */
    public function renderParameter(Method $method): string
    {
        $params = [];
        foreach ($method->getParameters() as $parameter) {
            $params[] = $parameter->getType() . ' ' . $parameter->getName() . ($parameter->isNullable() ? ' = '.Primitive::NULL : '');
        }

        return implode(', ',$params);
    }

    /**
     * @param string $char
     *
     * @throws \Exception
     */
    public function setIndentCharacter(string $char): void
    {
        if ($char !== "\t" && $char !== "\u0020") {
            throw new InvalidArgumentException('Tab or space only');
        }
        $this->indentCharacter = $char;
    }

    /**
     * @param string $str
     * @param int    $depth
     *
     * @return string
     */
    public function indent(string $str, int $depth = 1): string {
        $parts = array_filter(explode(PHP_EOL, $str));
        $parts = array_map(
            function ($part) use ($depth) {
                return str_repeat($this->indentCharacter, $depth).$part;
            },
            $parts
        );
        return implode(PHP_EOL, $parts);
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function renderValue($value): string
    {
        $res = ' = ';
        if (\is_string($value)) {
            $res .= "'{$value}'";
        } else {
            $res .= $value;
        }
        return $res . ';';
    }

    /**
     * @param Constant $constant
     *
     * @return string
     */
    public function renderConstant(Constant $constant): string
    {
        $members = $this->renderMembers($constant);

        if ($constant->hasValue()) {
            return ($constant->hasComment() ? $constant->formatComment() : '')
                . $constant->getName() . ' = '
                . ($constant->isQuoted() ? "'" .$constant->getValue() ."';" : $constant->getValue());
        }
    }

    /**
     * @param ArrowFunction $value
     *
     * @return string
     */
    public function renderArrowFunction(ArrowFunction $value): string
    {
        $members = $this->renderMembers($value,",\n");

        return ($value->getName() ? $value->getName() . ' = ' : '')
            . '() => ({' . PHP_EOL
            . $this->indent(implode(",\n",$members))
            . PHP_EOL.'});' . PHP_EOL;
    }

    /**
     * @param ElementInterface $object
     * @param string $glue
     *
     * @return array
     */
    public function renderMembers(ElementInterface $object, string $glue = PHP_EOL): array
    {
        $properties = [];
        foreach ($object->getProperties() as $property) {
            $properties[] = $this->renderProperties($property);
        }

        $methods = [];
        foreach ($object->getMethods() as $method) {
            $methods[] = $this->renderMethods($method);
        }

        return array_filter(
            [
                implode($glue, $properties),
                ($methods && $properties ? str_repeat(PHP_EOL, 2) : '')
                . implode($glue,$methods)
            ]
        );
    }

    /**
     * @param Annotation $annotation
     *
     * @return string
     */
    public function renderAnnotation(Annotation $annotation): string
    {
        return '@'.$annotation->getName()
            . ($annotation->hasValue()
                ? '(' .$this->encode($annotation->getValue()) .')'
                : '') ;
    }

    /**
     * @param mixed $data
     *
     * @return string
     */
    public function encode($data): string
    {
        $data = (string) json_encode($data,(JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
        return strtr($data, [\chr(34) => '']);
    }

}
