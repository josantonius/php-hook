# CHANGELOG

## 1.1.0 - 2018-01-06

* The tests were fixed.

* Changes in documentation.

## 1.0.9 - 2017-11-08

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to PSR standards.

## 1.0.8 - 2017-10-30

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


## 1.0.7 - 2017-10-18

* Added `Josantonius\Hook\Hook::isAction()` method.

* Added `Josantonius\Hook\Test\HookTest::testIsAction()` method.
* Added `Josantonius\Hook\Test\HookTest::testIsNotAction()` method.

## 1.0.6 - 2017-09-13

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

## 1.0.5 - 2017-06-24

* The class was improved to work with different instances and some static methods were changed to dynamic ones.

## 1.0.4 - 2017-06-02

Return was added in the doAction method. Useful for receiving actions that are only executed once.

* Deleted `$_hooks` property.

* Deleted `Josantonius\Hook\Hook::setHook()` method.
* Deleted `Josantonius\Hook\Hook::addHook()` method.
* Deleted `Josantonius\Hook\Hook::resetHook()` method.
* Deleted `Josantonius\Hook\Hook::run()` method.
* Deleted `Josantonius\Hook\Hook::collectHook()` method.

## 1.0.3 - 2017-05-31

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

## 1.0.2 - 2017-05-19

* Added option to remove custom function to hook.

* Added `Josantonius\Hook\Hook::resetHook()` method.

## 1.0.1 - 2017-03-18

* Some files were excluded from download and comments and readme files were updated.

## 1.0.0 - 2017-03-15

* Added `Josantonius\Hook\Hook` class.
* Added `Josantonius\Hook\Hook::getInstance()` method.
* Added `Josantonius\Hook\Hook::setSingletonName()` method.
* Added `Josantonius\Hook\Hook::setHook()` method.
* Added `Josantonius\Hook\Hook::addHook()` method.
* Added `Josantonius\Hook\Hook::run()` method.
* Added `Josantonius\Hook\Hook->collectHook()` method.

## 1.0.0 - 2017-03-15

* Added `Josantonius\Hook\Exception\HookException` class.
* Added `Josantonius\Hook\Exception\Exceptions` abstract class.
* Added `Josantonius\Hook\Exception\HookException->__construct()` method.

## 1.0.0 - 2017-03-15

* Added `Josantonius\Hook\Tests\HookTest` class.
* Added `Josantonius\Hook\Tests\HookTest::testAddHooks()` method.
* Added `Josantonius\Hook\Tests\HookTest::testSetSingletonName()` method.
* Added `Josantonius\Hook\Tests\HookTest::testExecuteHooks()` method.
* Added `Josantonius\Hook\Tests\HookTest::testSetOneHook()` method.
* Added `Josantonius\Hook\Tests\HookTest::testSetMultipleHooks()` method.