# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/hook/v/stable)](https://packagist.org/packages/josantonius/hook) [![Total Downloads](https://poser.pugx.org/josantonius/hook/downloads)](https://packagist.org/packages/josantonius/hook) [![Latest Unstable Version](https://poser.pugx.org/josantonius/hook/v/unstable)](https://packagist.org/packages/josantonius/hook) [![License](https://poser.pugx.org/josantonius/hook/license)](https://packagist.org/packages/josantonius/hook)

[Versión en español](README-ES.md)

Library for handling hooks.

---

- [Installation](#installation)
- [Requirements](#requirements)
- [Quick Start and Examples](#quick-start-and-examples)
- [Available Methods](#available-methods)
- [Usage](#usage)
- [Tests](#tests)
- [Exception Handler](#exception-handler)
- [Contribute](#contribute)
- [Repository](#repository)
- [Licensing](#licensing)
- [Copyright](#copyright)

---

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install PHP Hook library, simply:

    $ composer require Josantonius/Hook

### Requirements

This library is supported by PHP versions 5.6 or higher and is compatible with HHVM versions 3.0 or higher.

To use this library in HHVM (HipHop Virtual Machine) you will have to activate the scalar types. Add the following line "hhvm.php7.scalar_types = true" in your "/etc/hhvm/php.ini".

### Quick Start and Examples

To use this class, simply:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;
```
### Available Methods

Available methods in this library:

```php
Hook::getInstance();
Hook::setSingletonName();
Hook::setHook();
Hook::addHook();
Hook::run();
Hook->collectHook();
```
### Usage

Example of use for this library:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;

$Hook = Hook::getInstance();

$hooks = [
    'css'        => 'Namespace\Class\Example@css',
    'js'         => 'Namespace\Class\EExample@js',
    'after-body' => 'Namespace\Class\Example@afterBody',
    'footer'     => 'Namespace\Class\Example@footer',
];

$Hook->addHook($hooks);

$Hook->run('meta');
$Hook->run('css');
$Hook->run('js');
$Hook->run('after-body');
$Hook->run('footer');
```

### Tests 

To use the [test](tests) class, simply:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\Hook\\Tests\\', __DIR__ . '/vendor/josantonius/hook/tests');

use Josantonius\Hook\Tests\HookTest;

```

Available test methods in this library:

```php
HookTest::testAddHooks();
HookTest::testSetSingletonName();
HookTest::testExecuteHooks();
HookTest::testSetOneHook();
HookTest::testSetMultipleHooks();
```

### Exception Handler

This library uses [exception handler](src/Exception) that you can customize.
### Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

### Repository

All files in this repository were created and uploaded automatically with [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Licensing

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

### Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

If you found this release useful please let the author know! Follow on [Twitter](https://twitter.com/Josantonius).