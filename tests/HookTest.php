<?php 
/**
 * Library for handling hooks.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017 Copyright (c) 2017
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
     * Add hooks.
     *
     * By default it will look for the 'getInstance' method to use singleton 
     * pattern and create a single instance of the class. If it does not
     * exist it will create a new object.
     *
     * You can change the method name using Hook::setSingletonName(),
     *
     * @since 1.0.0
     */
    public static function testAddHooks() {

        $Hook = Hook::getInstance();

        $hooks = [
            'css'        => 'Josantonius\Hook\Tests\Example@css',
            'js'         => 'Josantonius\Hook\Tests\EExample@js',
            'after-body' => 'Josantonius\Hook\Tests\Example@afterBody',
            'footer'     => 'Josantonius\Hook\Tests\Example@footer',
        ];

        var_dump($Hook->addHook($hooks));
    }

    /**
     * Add hooks.
     *
     * By default it will look for the 'getInstance' method to use singleton 
     * pattern and create a single instance of the class. If it does not
     * exist it will create a new object.
     *
     * You can change the method name using Hook::setSingletonName(),
     *
     * @since 1.0.0
     */
    public static function testSetSingletonName() {

        $Hook = Hook::getInstance();

        $Hook->setSingletonName('newSingletonMethodName');

        $hooks = [
            'css'        => 'Josantonius\Hook\Tests\Example@css',
            'js'         => 'Josantonius\Hook\Tests\EExample@js',
            'after-body' => 'Josantonius\Hook\Tests\Example@afterBody',
            'footer'     => 'Josantonius\Hook\Tests\Example@footer',
        ];

        var_dump($Hook->addHook($hooks));
    }

    /**
     * Execute hooks.
     *
     * @since 1.0.0
     */
    public static function testExecuteHooks() {

        self::testSetHooks();

        Hook::run('meta');
        Hook::run('css');
        Hook::run('js');
        Hook::run('after-body');
        Hook::run('footer');
    }

    /**
     * Set hook.
     *
     * @since 1.0.0
     */
    public static function testSetOneHook() {

        Hook::setHook('beforeFooter');
    }

    /**
     * Set hooks.
     *
     * @since 1.0.0
     */
    public static function testSetMultipleHooks() {

        Hook::setHook([

            'before-footer',
            'top-right',
        ]);
    }
}
