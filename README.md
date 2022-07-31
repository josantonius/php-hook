# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/hook/v/stable)](https://packagist.org/packages/josantonius/hook)
[![License](https://poser.pugx.org/josantonius/hook/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/hook/downloads)](https://packagist.org/packages/josantonius/hook)
[![CI](https://github.com/josantonius/php-hook/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-hook/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-hook/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-hook)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Translations**: [Español](.github/lang/es-ES/README.md)

Library for handling hooks in PHP.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Classes and Instances](#available-classes-and-instances)
  - [Hook Class](#hook-class)
  - [Action Instance](#action-instance)
  - [Priority Class](#priority-class)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Tests](#tests)
- [TODO](#todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#Sponsor)
- [License](#license)

---

## Requirements

This library is compatible with the PHP versions: 8.1.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP Hook library**, simply:

```console
composer require josantonius/hook
```

The previous command will only install the necessary files,
if you prefer to **download the entire source code** you can use:

```console
composer require josantonius/hook --prefer-source
```

You can also **clone the complete repository** with Git:

```console
git clone https://github.com/josantonius/php-hook.git
```

## Available Classes and Instances

### Hook Class

**Available methods:**

#### Register new hook

```php
$hook = new Hook(string $name);
```

#### Adds action on the hook

```php
$hook->addAction(callable $callback, int $priority = Priority::NORMAL): Action
```

Action will be maintained after performing actions and will be available if are done again.

**@see** <https://www.php.net/manual/en/functions.first_class_callable_syntax.php>
for more information about first class callable syntax.

**@return** [Action](#action-instance) added.

#### Adds action once on the hook

```php
$hook->addActionOnce(callable $callback, int $priority = Priority::NORMAL): Action
```

Action will only be done once and will be deleted after it is done.

**It is recommended to use this method to release the actions from
memory if the hook actions will only be done once.**

**@return** [Action](#action-instance) added.

#### Runs the added actions for the hook

```php
$hook->doActions(mixed ...$arguments): Action[]
```

**@throws** `HookException` if the actions have already been done.

**@throws** `HookException` if no actions were added for the hook.

**@return** `array` [Actions](#action-instance) done.

#### Checks if the hook has actions

```php
$hook->hasActions(): bool
```

True if the hook has any action even if the action has been done before
(recurring actions created with [addAction](#add-action-on-the-hook)).

#### Checks if the hook has undone actions

```php
$hook->hasUndoneActions(): bool
```

True if the hook has some action left undone.

#### Checks if the actions were done at least once

```php
$hook->hasDoneActions(): bool
```

If [doActions](#runs-the-added-actions-for-the-hook) was executed at least once.

#### Gets hook name

```php
$hook->getName(): string
```

### Action Instance

**Available methods:**

#### Gets action priority

```php
$action->getPriority(): int
```

#### Gets action callback result

```php
$action->getResult(): mixed
```

#### Checks if the action is done once

```php
$action->isOnce(): bool
```

#### Checks if the action has already been done

```php
$action->wasDone(): bool
```

### Priority Class

**Available constants:**

```php
Priority::HIGHEST; // 50
Priority::HIGH;    // 100
Priority::NORMAL;  // 150
Priority::LOW;     // 200
Priority::LOWEST;  // 250
```

## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';
```

```php
use Josantonius\Hook\Hook;
use Josantonius\Hook\Priority;
```

## Usage

Example of use for this library:

### - Register new hook

```php
$hook = new Hook('foo');
```

### - Adds actions on the hook

```php
$hook->addAction(foo(...));

$hook->addAction(Foo::bar(...), Priority::HIGH);
```

### - Adds actions once on the hook

```php
$hook->addActionOnce(bar(...));

$hook->addActionOnce($foo->bar(...), Priority::LOWEST);
```

### - Runs the added actions for the hook

#### Do actions with the same priority

```php
$hook->addAction(one(...));
$hook->addAction(two(...));

/**
 * The actions will be executed according to their natural order:
 * 
 *  one(), two()...
 */
$hook->doActions();
```

#### Do actions with different priority

```php
$hook->addAction(a(...), priority::LOW);
$hook->addAction(b(...), priority::NORMAL);
$hook->addAction(c(...), priority::HIGHEST);

/**
 * Actions will be executed according to their priority:
 * 
 * c(), b(), a()...
 */
$hook->doActions();
```

#### Do actions with arguments

```php
$hook->addAction(foo(...));

$hook->doActions('foo', 'bar');
```

#### Do actions recurrently

```php
$hook->addAction(one(...));
$hook->addAction(tho(...));
$hook->addActionOnce(three(...)); // Will be done only once

$hook->doActions(); // one(), two(), three()

$hook->doActions(); // one(), two()
```

#### Do actions only once

```php
$hook->addActionOnce(one(...));
$hook->addActionOnce(tho(...));

$hook->doActions();

// $hook->doActions(); Throw exception since there are no actions to be done
```

### - Checks if the hook has actions

```php
$hook->addAction(foo());

$hook->hasActions(); // true

$hook->doActions();

$hook->hasActions(); // True since the action is recurrent and remains stored
```

### - Checks if the hook has undone actions

```php
$hook->addAction(foo());

$hook->hasUndoneActions(); // true

$hook->doActions();

$hook->hasUndoneActions(); // False since there are no undone actions
```

### - Checks if the actions were done at least once

```php
$hook->addAction(foo());

$hook->hasDoneActions(); // false

$hook->doActions();

$hook->hasDoneActions(); // True since the actions were done
```

### - Gets hook name

```php
$name = $hook->getName();
```

#### - Gets action priority

```php
$action = $hook->addAction(foo());

$action->getPriority();
```

#### - Gets action callback result

```php
$action = $hook->addAction(foo());

$action->getResult();
```

#### - Checks if the action is done once

```php
$action = $hook->addAction(foo());

$action->isOnce(); // false

$action = $hook->addActionOnce(foo());

$action->isOnce(); // true
```

#### - Checks if the action has already been done

```php
$action = $hook->addAction(foo());

$action->wasDone(); // false

$hook->doActions();

$action->wasDone(); // true
```

## Tests

To run [tests](tests) you just need [composer](http://getcomposer.org/download/)
and to execute the following:

```console
git clone https://github.com/josantonius/php-hook.git
```

```console
cd php-hook
```

```console
composer install
```

Run unit tests with [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Run code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Run [PHP Mess Detector](https://phpmd.org/) tests to detect inconsistencies in code style:

```console
composer phpmd
```

Run all previous tests:

```console
composer tests
```

## TODO

- [ ] Add new feature
- [ ] Improve tests
- [ ] Improve documentation
- [ ] Improve English translation in the README file
- [ ] Refactor code for disabled code style rules (see phpmd.xml and phpcs.xml)
- [ ] Make Action->runCallback() accessible only to the Hook class
- [ ] Add method to remove action?
- [ ] Add option to add ID in actions?

## Changelog

Detailed changes for each release are documented in the
[release notes](https://github.com/josantonius/php-hook/releases).

## Contribution

Please make sure to read the [Contributing Guide](.github/CONTRIBUTING.md), before making a pull
request, start a discussion or report a issue.

Thanks to all [contributors](https://github.com/josantonius/php-hook/graphs/contributors)! :heart:

## Sponsor

If this project helps you to reduce your development time,
[you can sponsor me](https://github.com/josantonius#sponsor) to support my open source work :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2017-present, [Josantonius](https://github.com/josantonius#contact)
