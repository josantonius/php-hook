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

The previous command will only install the necessary files, if you prefer to download the entire source code (including tests, vendor folder, exceptions not used, docs...) you can use:

    $ composer require Josantonius/Hook --prefer-source

Or you can also clone the complete repository with Git:

	$ git clone https://github.com/Josantonius/PHP-Hook.git
	
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

**getInstance()**
```php
Hook::getInstance();
```

**setSingletonName()**
```php
Hook::setSingletonName($method);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $method | Set method name for use singleton pattern | string | Yes | |

**addAction()**
```php
Hook::addAction($tag, $function, $priority, $args);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $tag | Action hook name | string | Yes | |
| $function | Function to attach to action hook | callable | Yes | |
| $priority | Order in which the action is executed | int | No | 8 |
| $args | Number of arguments accepted | int | No | 0 |

**addActions()**
```php
Hook::addActions($actions);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $actions | Actions hooks | array | Yes | |

**doAction()**
```php
Hook::doAction($tag, $args, $remove);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $tag | Action hook name | string | Yes | |
| $args | Optional arguments | mixed | No | array() |
| $remove | Delete hook after executing actions | boolean | No | true |

**current()**
```php
Hook::current();
```
 
### Usage

Example of use for this library:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;

/* Add actions */

Hook::addAction('css', ['Namespace\Class\Example', 'css'], 2, 0);

$hooks = [
    ['meta',       ['Namespace\Class\Example', 'meta'],      1, 0],
    ['js',         ['Namespace\Class\Example', 'js'],        3, 0],
    ['after-body', ['Namespace\Class\Example', 'afterBody'], 4, 0],
    ['footer',     ['Namespace\Class\Example', 'footer'],    5, 0],
];

Hook::addActions($hooks);

/* Run actions */

Hook::doAction('meta');
Hook::doAction('css');
Hook::doAction('js');
Hook::doAction('after-body');
Hook::doAction('footer');
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
HookTest::testAddHooksMethod();
HookTest::testAddHooksArray();
HookTest::testAddHooksInstance();
HookTest::testSetSingletonName();
HookTest::testCurrentHook();
HookTest::testExecuteHooks();
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

If you find it useful, let me know :wink:

You can contact me on [Twitter](https://twitter.com/Josantonius) or through my [email](mailto:hello@josantonius.com).