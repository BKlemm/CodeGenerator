<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java\Tests;


use CodeGenerator\Component\Java\JavaClass;
use CodeGenerator\Component\Java\Structure\Method;
use CodeGenerator\Component\Java\Structure\Parameter;
use CodeGenerator\Component\Java\Structure\Property;
use CodeGenerator\Component\Java\Tests\Expected\ComparableTemplates;
use CodeGenerator\Component\Java\Types\AccessType;
use CodeGenerator\Component\Java\Types\Primitive;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{

    // tests
    public function testClass()
    {

        $class = new JavaClass('Task');
        $class->setAccess(AccessType::PACKAGE);
        $class->setPackage('com.jentix.services.parking.reservation.core.command');

        $class->addImports([
            'org.springframework.web.bind.annotation.RequestMapping',
            'org.axonframework.spring.stereotype.Aggregate'
        ]);
        $class->addExtend('Parent');

        $class->addAnnotation('Aggregate');
        $class->addAnnotation('RequestMapping');

        $properties = [
            (new Property('reservationId'))
                ->setAccess(AccessType::PACKAGE)
                ->setType(Primitive::STRING)
        ];
        $class->setProperties(...$properties);

        $method = new Method('create');
        $method->setReturnType(Primitive::VOID);
        $method->setAccess(AccessType::PUBLIC);
        $method->setBody('');

        $param = new Parameter('name');
        $param->setType(Primitive::STRING);
        $method->setParameter($param);

        $methods = [$method];
        $class->setMethods(...$methods);


        self::assertStringContainsString(ComparableTemplates::javaClass(),$this->tabsToSpaces((string) $class));
    }



    /**
     * @return string
     */
    private function getCopyRight(): string
    {
        return <<<EOT
        This file is part of the CodeGenerator project.
        
        (c) CodeGenerator <project@CodeGenerator.de>
        
        For the full copyright and license information, please view the LICENSE
        file that was distributed with this source code.
        EOT;

    }

    /**
     * @param string $code
     *
     * @return string
     */
    private function tabsToSpaces(string $code): string
    {
        return (string) preg_replace('/[ ]{2,}|[\t]/', '    ', $code);
    }
}
