# JTGenerator
Typescript and ES6 Javascript class / file generator


[![Build Status](https://travis-ci.org/BKlemm/JTGenerator.svg?branch=master)](https://travis-ci.org/BKlemm/JTGenerator)
[![codecov](https://codecov.io/gh/BKlemm/JTGenerator/branch/master/graph/badge.svg)](https://codecov.io/gh/BKlemm/JTGenerator)
[![phpstan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat)](https://img.shields.io/badge/PHPStan-level%203-brightgreen.svg?style=flat)

# Example

# Installation

JTGenerator supports only installation via [composer](https://getcomposer.org). So first ensure your composer is installed, configured and ready to use.

```bash
$ composer require jtgenerator/jtgenerator
```

# Usage
Define Constants:
```php
$state = new Constant('TASK');
$state->setValue('data');
$state->setExport();

$file = new ScriptFile();
$file->addContent($state);

echo $file;
```

Results:
```javascript
export const TASK = 'data';
```

```php
$state = new Constant('state');
$state->setExport();

$file = new ScriptFile();
$file->addContent($state);

echo $file;
```

Results:
```javascript
export const state = {

};
```

More complex:
```php
$method = new Method('INCREMENT_ACTIVE');
$method->addParameter('state');
$method->setBody('state.active++');

$method2 = new Method('DECREMENT_ACTIVE');
$method2->addParameter('state');
$method2->setBody('if (state.active >= 1) { state.active-- }');

$s = new Constant('mutations');
$s->setExport();

$s->setMethods([$method,$method2]);

$file = new ScriptFile();
$file->addContent($s);

echo $file;
```

Results:
```javascript
export const mutations = {
        
    INCREMENT_ACTIVE(state) {
        state.active++
    }
    DECREMENT_ACTIVE(state) {
        if (state.active >= 1) { state.active-- }
    }
};
```

Arrow Functions:

```php
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
$file = new ScriptFile();
$file->addContent($s);

echo $file;
```

Results:
```javascript
export default () => ({
    [TASKS]: [],
    [TOTAL]: [],
    [PAGINATION]: {
        page: 1,
        limit: 10,
        totalPages: 0,
        totalItems: 0
    }
});
```




