<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <webinnovativ@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Tests;


use JTGenerator\Enum\AccessType;
use JTGenerator\Enum\Primitive;
use JTGenerator\ScriptFile;
use JTGenerator\Structure\ArrowFunction;
use JTGenerator\Structure\Constant;
use JTGenerator\Structure\JSObject;
use JTGenerator\Structure\Method;
use JTGenerator\Structure\Parameter;
use JTGenerator\Structure\Property;
use JTGenerator\Tests\Expected\ComparableTemplates;
use JTGenerator\TSClass;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{

    // tests
    public function testClass()
    {
        $file = new ScriptFile();
        $file->addComment($this->getCopyRight());
        $file->addImport(['Component','Vue'],'vue-property-decorator');
        $file->addImport(['getModule'],'vuex-module-decorators');

        $class = new TSClass('Task');
        $class->addComment('This is a Ts Task class');
        $class->addComment('Use this in vue js');
        $class->addExtend('Vue');
        $class->addDecorator('Component',['compontents' => '{Form,Table}','computed' => '...mapState({currentApp: (state:any) => state.currentApp})']);
        $class->addDecorator('Watch','\'child\'');
        $class->addDecorator('Prop',['default' => '\'def\'']);
        $class->setDefault();
        $class->setExport();
        $class->addProperty('name', 'ben');


        $method = new Method('created');
        $method->setReturnType(Primitive::VOID);
        $method->setAccess(AccessType::PUBLIC);
        $method->addComment('LC Hook create');
        $method->setBody('let a = await this.get("/hrm");');

        $method2 = new Method('mounted');
        $method2->setReturnType(Primitive::VOID);
        $method2->setAccess(AccessType::PUBLIC);
        $method2->addComment('LC Hook mount');
        $method2->setBody(' ');

        $param = new Parameter('name');
        $param->setType(Primitive::STRING);
        $method->setParameter($param);

        $class->setMethods([$method,$method2]);

        $file->setClass($class);

        $this->assertStringContainsString(ComparableTemplates::tsClass(),$this->tabsToSpaces((string) $file));
    }

    public function testScript()
    {
        $file = new ScriptFile();
        $state = new Constant('state');
        $state->setExport();

        $method = new Method('INCREMENT_ACTIVE');
        $method->addParameter('state');
        $method->setBody('state.active++');

        $method2 = new Method('DECREMENT_ACTIVE');
        $method2->addParameter('state');
        $method2->setBody('if (state.active >= 1) { state.active-- }');

        $s = new Constant('mutations');
        $s->setExport();

        $s->setMethods([$method,$method2]);

        $file->addContent($state);
        $file->addContent($s);

        $this->assertStringContainsString(ComparableTemplates::script(),$this->tabsToSpaces((string) $file));
    }

    public function testConstant()
    {
        $file = new ScriptFile();
        $state = new Constant('TASK');
        $state->setValue('data');
        $state->setExport();

        $s = new ArrowFunction('');
        $s->setExport();
        $s->setDefault();
        $s->setProperties([
            (new Property('[TASKS]'))->setType('[]'),
            (new Property('[TOTAL]'))->setType('[]'),
            (new Property('[PAGINATION]'))->setType([
                'page' => 1,
                'limit' => 10,
                'totalPages' => 0,
                'totalItems' => 0
            ])
        ]);

        $file->addContent($state);
        $file->addContent($s);

        $this->assertStringContainsString(ComparableTemplates::constant(),$this->tabsToSpaces((string) $file));
    }

    public function testObject()
    {
        $file = new ScriptFile();

        $mutation = new JSObject;
        $mutation->setDefault();
        $mutation->setExport();
        $mutation->setMethods([
            (new Method("[SET_DATA]"))
                ->addParameter('state')
                ->addParameter('data')
                ->setBody('state.data = data'),
            (new Method("[SET_PAGE]"))
                ->addParameter('state')
                ->addParameter('pagination')
                ->setBody('state.pagination = pagination'),
            (new Method("[SET_TOTAL]"))
                ->addParameter('state')
                ->addParameter('data')
                ->setBody('state.total[state.pagination.page] = data')
        ]);

        $file->addContent($mutation);

        $file->addExport(['*'],'./state');
        $file->addExport(['*'],'./mutations');
        $file->addExport(['*'],'./actions');

        $this->assertStringContainsString(ComparableTemplates::objects(),$this->tabsToSpaces((string)$file));
    }

    /**
     * @return string
     */
    private function getCopyRight(): string
    {
        return <<<EOT
        This file is part of the JTGenerator project.
        
        (c) JTGenerator <project@jtgenerator.de>
        
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
