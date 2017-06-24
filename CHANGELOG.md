# CHANGELOG

## 1.0.5 - 2017-06-24

*The class was improved to work with different instances and some static methods were changed to dynamic ones.

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