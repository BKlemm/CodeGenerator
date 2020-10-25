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


use CodeGenerator\Contracts\JTScript\ElementInterface;
use CodeGenerator\Component\JTScript\Exception\InvalidArgumentException;
use CodeGenerator\Component\JTScript\Structure\ArrowFunction;
use CodeGenerator\Component\JTScript\Structure\Constant;
use CodeGenerator\Component\JTScript\Structure\Decorator;
use CodeGenerator\Component\JTScript\Structure\Export;
use CodeGenerator\Component\JTScript\Structure\Import;
use CodeGenerator\Component\JTScript\Structure\JSObject;
use CodeGenerator\Component\JTScript\Structure\Method;
use CodeGenerator\Component\JTScript\Structure\Property;

/**
 * Class Printer
 *
 * @package CodeGenerator
 */
class Renderer
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
            if (\is_array($val)) {
                $comps     = implode(',',$val);
                $imports[] = 'import {'.$comps."} from '$key';";
            } else {
                $imports[] = 'import '.$val." from '$key';";
            }
        }
        return implode(PHP_EOL,$imports);
    }

    /**
     * @param Export $nodes
     *
     * @return string
     */
    public function renderExports(Export $nodes): string
    {
        $exports = [];
        foreach ($nodes->getExports() as $key => $val) {
            if (\is_array($val)) {
                $comps     = implode(',',$val);
                $exports[] = 'export {'.$comps."} from '$key';";
            } else {
                $exports[] = 'export '.$val." from '$key';";
            }
        }
        return implode(PHP_EOL,$exports);
    }

    /**
     * @param ES6Class $class
     *
     * @return string
     * @throws \Exception
     */
    public function renderESClass(ES6Class $class): string
    {
        $class->validate();

        $members = $this->renderMembers($class);

        return ($class->hasComment() ? $class->formatComment() : '')
            . $class->getName() . ' '
            . ($class->hasExtend() ? 'extends ' . $class->getExtend() : '')
            . ($class->hasImplements() ? 'implements ' . implode(', ', $class->getImplements()) : '')
            . ' {' . PHP_EOL
            . ($members ? $this->indent(implode(PHP_EOL, $members)) : '')
            . PHP_EOL.'}';
    }

    /**
     * @param TSClass $class
     *
     * @return string
     * @throws \Exception
     */
    public function renderClass(TSClass $class): string
    {
        $class->validate();

        $members = $this->renderMembers($class);

        $decorators = [];
        foreach ($class->getDecorators() as $decorator) {
            $decorators[] = $this->renderDecorator($decorator);
        }

        return ($class->hasComment() ? $class->formatComment() : '')
            . ($class->hasDecorator() ? implode(PHP_EOL,$decorators) .PHP_EOL : '')
            . ($class->isExport() ? 'export ' : '')
            . ($class->isDefault() ? 'default ' : '')
            . ($class->isAbstract() ? 'abstract ' : '')
            . 'class ' . $class->getName() . ' '
            . ($class->hasExtend() ? 'extends ' . $class->getExtend() : '')
            . ($class->hasImplements() ? 'implements ' . implode(', ', $class->getImplements()) : '')
            . ' {' . PHP_EOL
            . ($members ? $this->indent(implode(PHP_EOL, $members)) : '')
            . PHP_EOL.'}';
    }

    /**
     * @param ScriptFile $file
     *
     * @return string
     */
    public function renderFile(ScriptFile $file): string
    {
        $imports = [];
        foreach ($file->getImports() as $import) {
            $imports[] = $this->renderImports($import);
        }

        $exports = [];
        foreach ($file->getExports() as $export) {
            $exports[] = $this->renderExports($export);
        }

        $constants = [];
        foreach ($file->getConstants() as $constant) {
            $constants[] = $this->renderConstant($constant);
        }

        return ($file->hasComment() ? $file->formatComment() .PHP_EOL : '')
            . ($imports ? implode(PHP_EOL, $imports) . str_repeat(PHP_EOL,2) : '')
            . ($constants ? implode(PHP_EOL, $constants) . str_repeat(PHP_EOL,2) : '')
            . ($file->hasClass() ? (string) $file->getClass() : '')
            . (!$file->hasClass() && $file->hasContent() ? implode(PHP_EOL,$file->getContent()) : '')
            . ($exports ? implode(PHP_EOL, $exports) . str_repeat(PHP_EOL,2) : '');
    }

    /**
     * @param Property $property
     *
     * @return string
     */
    public function renderProperties(Property $property): string
    {
        return ($property->hasComment() ? $property->formatComment() . PHP_EOL : '')
            . ($property->hasDecorator() ? $this->renderDecorator($property->getDecorator()) . PHP_EOL : '')
            . ($property->hasAccess() ? $property->getAccess() . ' ' : '')
            . $property->getName()
            . ($property->isDefiniteAssignment() ? '!' : '')
            . ($property->typeIsString() ? ': ' . ($property->isNullable() ? '?' : '') . $property->getType() : '')
            . ($property->typeIsArray() ? ': ' . $this->encode($property->getType()) : '')
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
            . ($method->isAsync() ? 'async ' : '')
            . $method->getName()
            . '('.$this->renderParameter($method).')'
            . $this->renderReturnType($method)
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
            $_param   = $parameter->typeIsString() ? $parameter->getType() : null;
            $params[] = $parameter->getName() . ($parameter->hasType() ? $this->renderType($_param,$parameter->isNullable()) : '');
        }

        return implode(', ',$params);
    }

    /**
     * @param string|null $type
     * @param bool        $nullable
     *
     * @return string
     */
    public function renderType(?string $type, bool $nullable = false): string
    {
        return $type
            ? ($nullable ? '?: ' . $type : $type)
            : '';
    }

    /**
     * @param Method $method
     *
     * @return string
     */
    public function renderReturnType(Method $method): string
    {
        return ($str = $this->renderType($method->getReturnType(), $method->isNullable()))
            ? ': ' . $str
            : '';
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
                . ($constant->isExport() ? 'export const ' : 'const ')
                . $constant->getName() . ' = '
                . ($constant->isQuoted() ? "'" .$constant->getValue() ."';" : $constant->getValue());
        }

        return ($constant->hasComment() ? $constant->formatComment() : '')
            . ($constant->isExport() ? 'export const ' : 'const ')
            . $constant->getName()
            . ($constant->isObject() ? ' = {' . str_repeat(PHP_EOL,2) : ' = () => ({' . PHP_EOL)
            . $this->indent(implode(",\n",$members))
            . PHP_EOL.'}' . ($constant->isObject() ? ';' : ');') . PHP_EOL;
    }

    /**
     * @param ArrowFunction $value
     *
     * @return string
     */
    public function renderArrowFunction(ArrowFunction $value): string
    {
        $members = $this->renderMembers($value,",\n");

        return ($value->isExport() ? 'export ' : '')
            . ($value->isDefault() ? 'default ' : '')
            . ($value->getName() ? $value->getName() . ' = ' : '')
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
     * @param Decorator $decorator
     *
     * @return string
     */
    public function renderDecorator(Decorator $decorator): string
    {
        return '@'.$decorator->getName()
             . ($decorator->hasValues()
                ? '(' .$this->encode($decorator->getValues()) .')'
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

    /**
     * @param JSObject $param
     *
     * @return string
     */
    public function renderObject(JSObject $param): string
    {
        $members = $this->renderMembers($param, ",\n");

        return ($param->isExport() ? 'export ' : '')
            . ($param->isDefault() ? 'default ' : '')
            . '{' . PHP_EOL
            . $this->indent(implode(",\n",$members))
            . PHP_EOL.'}' .PHP_EOL;
    }
}
