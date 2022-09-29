# CHANGELOG

## [v2.0.3](https://github.com/josantonius/php-hook/releases/tag/v2.0.3) (2022-XX-XX)

* The notation type in the test function names has been changed from camel to snake case for readability.

* Functions were added to document the methods and avoid confusion.

* Disabled the ´CamelCaseMethodName´ rule in ´phpmd.xml´ to avoid warnings about function names in tests.

* The alignment of the asterisks in the comments has been fixed.

* Tests for Windows have been added.

* Tests for PHP 8.2 have been added.

## [v2.0.2](https://github.com/josantonius/php-hook/releases/tag/v2.0.2) (2022-08-11)

* Improved documentation.

## [v2.0.1](https://github.com/josantonius/php-hook/releases/tag/v2.0.1) (2022-07-31)

* Removed the warning about version 1.x in the `README.md` files.

* Fixed blank line at the beginning of the file in `FUNDING.yml`.

* Fixed CodeCov link in the `README.md` files.

## [v2.0.0](https://github.com/josantonius/php-hook/releases/tag/v2.0.0) (2022-07-30)

> Version 1.x is considered as deprecated and unsupported.
> In this version (2.x) the library was completely restructured.
> It is recommended to review the documentation for this version and make the necessary changes
> before starting to use it, as it not be compatible with version 1.x.

---

* The library was completely refactored.

* Support for PHP version 8.1.

* Support for earlier versions of PHP **8.1** is discontinued.

* Replaced all static methods in `Josantonius\Hook\Hook` class.

* Improved documentation; `README.md`, `CODE_OF_CONDUCT.md`, `CONTRIBUTING.md` and `CHANGELOG.md`.

* Removed `Codacy`.

* Removed `PHP Coding Standards Fixer`.

* The `master` branch was renamed to `main`.

* The `develop` branch was added to use a workflow based on `Git Flow`.

* `Travis` is discontinued for continuous integration. `GitHub Actions` will be used from now on.

* Added `.github/CODE_OF_CONDUCT.md` file.
* Added `.github/CONTRIBUTING.md` file.
* Added `.github/FUNDING.yml` file.
* Added `.github/workflows/ci.yml` file.
* Added `.github/lang/es-ES/CODE_OF_CONDUCT.md` file.
* Added `.github/lang/es-ES/CONTRIBUTING.md` file.
* Added `.github/lang/es-ES/LICENSE` file.
* Added `.github/lang/es-ES/README` file.

* Deleted `.travis.yml` file.
* Deleted `.editorconfig` file.
* Deleted `CONDUCT.MD` file.
* Deleted `README-ES.MD` file.
* Deleted `.php_cs.dist` file.

## [1.1.0](https://github.com/josantonius/php-hook/releases/tag/1.1.0) (2018-01-06)

* The tests were fixed.

* Changes in documentation.

## [1.0.9](https://github.com/josantonius/php-hook/releases/tag/1.0.9) (2017-11-08)

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to PSR standards.

## [1.0.8](https://github.com/josantonius/php-hook/releases/tag/1.0.8) (2017-10-30)

* Implemented `PSR-4 autoloader standard` from all library files.

* Implemented `PSR-2 coding standard` from all library PHP files.

* Implemented `PHPCS` to ensure that PHP code complies with `PSR2` code standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

* Added `Hook/phpcs.ruleset.xml` file.

* Deleted `Hook/src/bootstrap.php` file.

* Deleted `Hook/tests/bootstrap.php` file.

* Deleted `Hook/vendor` folder.

* Changed `Josantonius\Hook\Test\HookTest` class to  `Josantonius\Hook\HookTest` class.

## [1.0.7](https://github.com/josantonius/php-hook/releases/tag/1.0.7) (2017-10-18)

* Added `Josantonius\Hook\Hook::isAction()` method.

* Added `Josantonius\Hook\Test\HookTest::testIsAction()` method.
* Added `Josantonius\Hook\Test\HookTest::testIsNotAction()` method.

## [1.0.6](https://github.com/josantonius/php-hook/releases/tag/1.0.6) (2017-09-13)

* Unit tests supported by `PHPUnit` were added.

* The repository was synchronized with Travis CI to implement continuous integration.

* Added `Hook/src/bootstrap.php` file

* Added `Hook/tests/bootstrap.php` file.

* Added `Hook/phpunit.xml.dist` file.
* Added `Hook/_config.yml` file.
* Added `Hook/.travis.yml` file.

* Deleted `Josantonius\Hook\Tests\HookTest::testAddHooksMethod()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testAddHooksArray()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testAddHooksInstance()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testCurrentHook()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testSetSingletonName()` method.

* Deleted `Josantonius\Hook\Exception\HookException` class.
* Deleted `Josantonius\Hook\Exception\Exceptions` abstract class.
* Deleted `Josantonius\Hook\Exception\HookException->__construct()` method.

* Added `Josantonius\Hook\Test\HookTest::testAddAction()` method.
* Added `Josantonius\Hook\Test\HookTest::testAddActionWithPriority()` method.
* Added `Josantonius\Hook\Test\HookTest::testAddActionWithPriorityAndArguments()` method.
* Added `Josantonius\Hook\Test\HookTest::testAddActionWithCustomSingletonMethod()` method.
* Added `Josantonius\Hook\Test\HookTest::testAddMultipleActions()` method.
* Added `Josantonius\Hook\Test\HookTest::testAddMultipleActionsWithCustomSingletonMethod()` method.
* Added `Josantonius\Hook\Test\HookTest::testDoActions()` method.
* Added `Josantonius\Hook\Test\HookTest::testDoActionAndGetCurrentHook()` method.
* Added `Josantonius\Hook\Test\HookTest::testDoActionsWithArguments()` method.

* Added `Josantonius\Hook\Test\Example` class.
* Added `Josantonius\Hook\Test\Example::getInstance()` method.
* Added `Josantonius\Hook\Test\Example::singletonMethod()` method.
* Added `Josantonius\Hook\Test\Example::meta()` method.
* Added `Josantonius\Hook\Test\Example::css()` method.
* Added `Josantonius\Hook\Test\Example::js()` method.
* Added `Josantonius\Hook\Test\Example::afterBody()` method.
* Added `Josantonius\Hook\Test\Example::slide()` method.
* Added `Josantonius\Hook\Test\Example::form()` method.
* Added `Josantonius\Hook\Test\Example::article()` method.
* Added `Josantonius\Hook\Test\Example::footer()` method.

## [1.0.5](https://github.com/josantonius/php-hook/releases/tag/1.0.5) (2017-06-24)

* The class was improved to work with different instances and some static methods were changed to dynamic ones.

## [1.0.4](https://github.com/josantonius/php-hook/releases/tag/1.0.4) (2017-06-02)

Return was added in the doAction method. Useful for receiving actions that are only executed once.

* Deleted `$_hooks` property.

* Deleted `Josantonius\Hook\Hook::setHook()` method.
* Deleted `Josantonius\Hook\Hook::addHook()` method.
* Deleted `Josantonius\Hook\Hook::resetHook()` method.
* Deleted `Josantonius\Hook\Hook::run()` method.
* Deleted `Josantonius\Hook\Hook::collectHook()` method.

## [1.0.3](https://github.com/josantonius/php-hook/releases/tag/1.0.3) (2017-05-31)

These deprecated methods will be removed as of version 1.0.4:

* Deprecated `$_hooks` property.

* Deprecated `Josantonius\Hook\Hook::setHook()` method.
* Deprecated `Josantonius\Hook\Hook::addHook()` method.
* Deprecated `Josantonius\Hook\Hook::resetHook()` method.
* Deprecated `Josantonius\Hook\Hook::run()` method.
* Deprecated `Josantonius\Hook\Hook::collectHook()` method.

* Added `Josantonius\Hook\Hook::addAction()` method.
* Added `Josantonius\Hook\Hook::addActions()` method.
* Added `Josantonius\Hook\Hook::doAction()` method.
* Added `Josantonius\Hook\Hook::_runAction()` method.
* Added `Josantonius\Hook\Hook::_getActions()` method.
* Added `Josantonius\Hook\Hook::_getArguments()` method.
* Added `Josantonius\Hook\Hook::current()` method.

* Deleted `Josantonius\Hook\Tests\HookTest::testAddHooks()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testExecuteHooks()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testSetOneHook()` method.
* Deleted `Josantonius\Hook\Tests\HookTest::testSetMultipleHooks()` method

* Added `Josantonius\Hook\Tests\HookTest::testAddHooksMethod()` method.
* Added `Josantonius\Hook\Tests\HookTest::testAddHooksArray()` method.
* Added `Josantonius\Hook\Tests\HookTest::testAddHooksInstance()` method.
* Added `Josantonius\Hook\Tests\HookTest::testCurrentHook()` method.

* Added `$callbacks` property.
* Added `$actions` property.
* Added `$current` property.

## [1.0.2](https://github.com/josantonius/php-hook/releases/tag/1.0.2) (2017-05-19)

* Added option to remove custom function to hook.

* Added `Josantonius\Hook\Hook::resetHook()` method.

## [1.0.1](https://github.com/josantonius/php-hook/releases/tag/1.0.1) (2017-03-18)

* Some files were excluded from download and comments and readme files were updated.

## [1.0.0](https://github.com/josantonius/php-hook/releases/tag/1.0.0) (2017-03-15)

* Added `Josantonius\Hook\Tests\HookTest` class.
* Added `Josantonius\Hook\Tests\HookTest::testAddHooks()` method.
* Added `Josantonius\Hook\Tests\HookTest::testSetSingletonName()` method.
* Added `Josantonius\Hook\Tests\HookTest::testExecuteHooks()` method.
* Added `Josantonius\Hook\Tests\HookTest::testSetOneHook()` method.
* Added `Josantonius\Hook\Tests\HookTest::testSetMultipleHooks()` method.
* Added `Josantonius\Hook\Exception\HookException` class.
* Added `Josantonius\Hook\Exception\Exceptions` abstract class.
* Added `Josantonius\Hook\Exception\HookException->__construct()` method.
* Added `Josantonius\Hook\Hook` class.
* Added `Josantonius\Hook\Hook::getInstance()` method.
* Added `Josantonius\Hook\Hook::setSingletonName()` method.
* Added `Josantonius\Hook\Hook::setHook()` method.
* Added `Josantonius\Hook\Hook::addHook()` method.
* Added `Josantonius\Hook\Hook::run()` method.
* Added `Josantonius\Hook\Hook->collectHook()` method.
