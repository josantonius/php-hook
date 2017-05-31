<?php 
/**
 * Library for handling hooks.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Hook
 * @since      1.0.0
 */

namespace Josantonius\Hook\Tests;

use Josantonius\Hook\Hook;

/**
 * Tests class for Hook library.
 *
 * @since 1.0.0
 */
class HookTest { 

    /**
     * Tests class name.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public static 'Josantonius\Hook\Tests\Example';

    /**
     * Add hooks.
     *
     * By default it will look for the 'getInstance' method to use singleton 
     * pattern and create a single instance of the class. If it does not
     * exist it will create a new object.
     *
     * You can change the method name using Hook::setSingletonName().
     *
     * @since 1.0.3
     */
    public static function testAddHooksMethod() {

        Hook::addAction('css',        [self::$class, 'css'], 2, 0);
        Hook::addAction('meta',       [self::$class, 'met'], 1, 1);
        Hook::addAction('js',         [self::$class, 'js'], 3, 0);
        Hook::addAction('after-body', [self::$class, 'after-body']);
        Hook::addAction('footer',     [self::$class, 'footer']);
    }

    /**
     * Add hooks.
     *
     * @since 1.0.3
     *
     * @return boolean
     */
    public static function testAddHooksArray() {

        $hooks = [

            ['css',        [self::$class, 'css'], 2, 0],
            ['meta',       [self::$class, 'meta'], 1, 0],
            ['js',         [self::$class, 'js'], 3, 0],
            ['after-body', [self::$class, 'afterBody']],
            ['footer',     [self::$class, 'footer']],
        ];

        return Hook::addActions($hooks);
    }

    /**
     * Add hooks.
     *
     * @since 1.0.3
     *
     * @return boolean
     */
    public static function testAddHooksInstance() {

        $instance = call_user_func(self::$class, 'getInstance');

        $hooks = [

            ['css',        [$instance, 'css'], 2, 0],
            ['meta',       [$instance, 'meta'], 1, 0],
            ['js',         [$instance, 'js'], 3, 0],
            ['after-body', [$instance, 'afterBody']],
            ['footer',     [$instance, 'footer']],
        ];

        return Hook::addActions($hooks);
    }

    /**
     * Set singleton name.
     *
     * @since 1.0.0
     *
     * @return boolean
     */
    public static function testSetSingletonName() {

        $singleton = 'newSingletonMethodName';

        Hook::setSingletonName($singleton);

        $instance = call_user_func(self::$class, $singleton);

        return Hook::addAction('css', [$instance, 'css'], 1, 0);
    }

    /**
     * Get current hook.
     *
     * @since 1.0.3
     */
    public static function testCurrentHook() {

        self::testAddHooksMethod();

        Hook::doAction('meta', 'Argument for title');
        Hook::doAction('css');

        $current = Hook::current();

        Hook::doAction('js');
        Hook::doAction('after-body');

        $current = Hook::current();

        Hook::doAction('footer');
    }

    /**
     * Execute hooks.
     *
     * @since 1.0.0
     */
    public static function testExecuteHooks() {

        self::testAddHooksMethod();

        Hook::doAction('meta', 'Argument for title');
        Hook::doAction('css');
        Hook::doAction('js');
        Hook::doAction('after-body');
        Hook::doAction('footer');
    }

}
