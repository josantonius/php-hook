# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Hook/v/stable)](https://packagist.org/packages/josantonius/Hook) [![Latest Unstable Version](https://poser.pugx.org/josantonius/Hook/v/unstable)](https://packagist.org/packages/josantonius/Hook) [![License](https://poser.pugx.org/josantonius/Hook/license)](LICENSE) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/22a7928128324c3e8a7ca9ea4aa2abcb)](https://www.codacy.com/app/Josantonius/PHP-Hook?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Josantonius/PHP-Hook&amp;utm_campaign=Badge_Grade) [![Total Downloads](https://poser.pugx.org/josantonius/Hook/downloads)](https://packagist.org/packages/josantonius/Hook) [![Travis](https://travis-ci.org/Josantonius/PHP-Hook.svg)](https://travis-ci.org/Josantonius/PHP-Hook) [![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/) [![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/) [![CodeCov](https://codecov.io/gh/Josantonius/PHP-Hook/branch/master/graph/badge.svg)](https://codecov.io/gh/Josantonius/PHP-Hook)

[Versión en español](README-ES.md)

Library for handling hooks.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Tests](#tests)
- [TODO](#-todo)
- [Contribute](#contribute)
- [Repository](#repository)
- [License](#license)
- [Copyright](#copyright)

---

## Requirements

This library is supported by **PHP versions 5.6** or higher and is compatible with **HHVM versions 3.0** or higher.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP Hook library**, simply:

    $ composer require Josantonius/Hook

The previous command will only install the necessary files, if you prefer to **download the entire source code** you can use:

    $ composer require Josantonius/Hook --prefer-source

You can also **clone the complete repository** with Git:

  $ git clone https://github.com/Josantonius/PHP-Hook.git

Or **install it manually**:

[Download Hook.php](https://raw.githubusercontent.com/Josantonius/PHP-Hook/master/src/Hook.php):

    $ wget https://raw.githubusercontent.com/Josantonius/PHP-Hook/master/src/Hook.php

## Available Methods

Available methods in this library:

### - Get Hook instance:

```php
Hook::getInstance();
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $id | Unique ID for multiple instances. | string | No | '0' |

**# Return** (object) → Hook instance

### - Set method name for use singleton pattern:

```php
Hook::setSingletonName($method);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $method | Set method name for use singleton pattern. | callable | No | |

**# Return** (void)

### - Attach custom function to action hook:

```php
Hook::addAction($tag, $function, $priority, $args);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $tag | Action hook name. | string | Yes | |
| $function | Function to attach to action hook. | callable | Yes | |
| $priority | Order in which the action is executed. | int | No | 8 |
| $args | Number of arguments accepted. | int | No | 0 |

**# Return** (boolean)

### - Add actions hooks from array:

```php
Hook::addActions($actions);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $actions | Actions hooks | array | Yes | |

**# Return** (boolean)

### - Run all hooks attached to the hook:

By default it will look for getInstance method to use singleton pattern and create a single instance of the class. If it does not exist it will create a new object.

```php
Hook::doAction($tag, $args, $remove);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $tag | Action hook name | string | Yes | |
| $args | Optional arguments | mixed | No | array() |
| $remove | Delete hook after executing actions | boolean | No | true |

**# Return** (mixed|false) → output of the last action or false 

### - Returns the current action hook:

```php
Hook::current();
```

**# Return** (string|false) → current action hook

### - Check if there is a certain action hook:

```php
Hook::isAction($tag);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $tag | Action hook name | string | Yes | |

**# Return** (boolean)

## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;
```

Or If you installed it **manually**, use it:

```php
require_once __DIR__ . '/Hook.php';

use Josantonius\Hook\Hook;
```

## Usage

[Example](tests/Example.php) of use for this library:

### - Add action hook:

```php
Hook::addAction('css', ['Josantonius\Hook\Test\Example', 'css']);
```

### - Add action hook with priority:

```php
Hook::addAction('js', ['Josantonius\Hook\Test\Example', 'js'], 1);
```

### - Add action hook with priority and arguments number:

```php
$instance = new Example;

Hook::addAction('meta', [$instance, 'meta'], 2, 1);
```

### - Add action hook and set singleton method:

```php
Hook::setSingletonName('singletonMethod');

$instance = call_user_func(
    'Josantonius\Hook\Test\Example::singletonMethod'
);

Hook::addAction('article', [$instance, 'article'], 3, 0);
```

### - Add multiple action hooks:

```php
$instance = new Example;
        
Hook::addActions([
    ['after-body', [$instance, 'afterBody'], 4, 0],
    ['footer', [$instance, 'footer'], 5, 0],
]);
```

### - Add multiple action hooks and set singleton method:

```php
Hook::setSingletonName('singletonMethod');

$instance = call_user_func(
    'Josantonius\Hook\Test\Example::singletonMethod'
);

Hook::addActions([
    ['slide', [$instance, 'slide'], 6, 0],
    ['form', [$instance, 'form'], 7, 2],
]);
```

### - Check if is action:

```php
Hook::setSingletonName('singletonMethod');

Hook::isAction('meta');
```

### - Execute action hooks:

```php
Hook::doAction('css');
Hook::doAction('js');
Hook::doAction('after-body');
Hook::doAction('article');
Hook::doAction('footer');
```

### - Execute action hook with arguments:

```php
Hook::doAction('meta', 'The title');
Hook::doAction('form', ['input', 'select']);
```

## Tests 

To run [tests](tests) you just need [Composer](http://getcomposer.org/download/) and to execute the following:

    $ git clone https://github.com/Josantonius/PHP-Hook.git
    
    $ cd PHP-Hook

    $ composer install

Run unit tests with [PHPUnit](https://phpunit.de/):

    $ composer phpunit

Run [PSR2](http://www.php-fig.org/psr/psr-2/) code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    $ composer phpcs

Run all previous tests:

    $ composer tests

## ☑ TODO

- [x] Create tests
- [ ] Improve documentation

## Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

## Repository

All files in this repository were created and uploaded automatically with [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

## License

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

## Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

If you find it useful, let me know :wink:

You can contact me on [Twitter](https://twitter.com/Josantonius) or through my [email](mailto:hello@josantonius.com).