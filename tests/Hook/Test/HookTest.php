<?php 
/**
 * Library for handling hooks.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Hook
 * @since      1.0.6
 */

namespace Josantonius\Hook\Test;

use Josantonius\Hook\Hook,
    PHPUnit\Framework\TestCase;

/**
 * Tests class for Hook library.
 *
 * @since 1.0.6
 */
final class HookTest extends TestCase {

    /**
     * Add action hook.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testAddAction() {

        $this->assertTrue(

            Hook::addAction('css', ['Josantonius\Hook\Test\Example', 'css'])
        );
    }

    /**
     * Add action hook with priority.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testAddActionWithPriority() {

        $this->assertTrue(

            Hook::addAction('js', ['Josantonius\Hook\Test\Example', 'js'], 1)
        );
    }

    /**
     * Add action hook with priority and arguments number.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testAddActionWithPriorityAndArguments() {

        $instance = new Example;

        $this->assertTrue(

            Hook::addAction('meta', [$instance, 'meta'], 2, 1)
        );
    }

    /**
     * Add action hook and set singleton method.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testAddActionWithCustomSingletonMethod() {

        Hook::setSingletonName('singletonMethod');

        $instance = call_user_func(

            'Josantonius\Hook\Test\Example::singletonMethod'
        );

        $this->assertTrue(

            Hook::addAction('article', [$instance, 'article'], 3, 0)
        );
    }

    /**
     * Add multiple action hooks.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testAddMultipleActions() {

        $instance = new Example;

        $this->assertTrue(

            Hook::addActions([

                ['after-body', [$instance, 'afterBody'], 4, 0],
                ['footer',     [$instance, 'footer'],    5, 0],
            ])
        );
    }

    /**
     * Add multiple action hooks and set singleton method.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testAddMultipleActionsWithCustomSingletonMethod() {

        Hook::setSingletonName('singletonMethod');

        $instance = call_user_func(

            'Josantonius\Hook\Test\Example::singletonMethod'
        );

        $this->assertTrue(

            Hook::addActions([

                ['slide', [$instance, 'slide'], 6, 0],
                ['form',  [$instance, 'form'],  7, 2],
            ])
        );
    }

    /**
     * Check if is action.
     *
     * @since 1.0.7
     *
     * @return void
     */
    public function testIsAction() {

        $this->assertTrue(

            Hook::isAction('meta')
        );

        $this->assertTrue(

            Hook::isAction('form')
        );
    }

    /**
     * Check if isn`t action.
     *
     * @since 1.0.7
     *
     * @return void
     */
    public function testIsNotAction() {

        $this->assertFalse(

            Hook::isAction('unknown')
        );
    }

    /**
     * Execute action hooks.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testDoActions() {

        $this->assertContains('css-hook', Hook::doAction('css'));

        $this->assertContains('js-hook', Hook::doAction('js'));

        $this->assertContains('after-hook', Hook::doAction('after-body'));

        $this->assertContains('article-hook', Hook::doAction('article'));

        $this->assertContains('footer-hook', Hook::doAction('footer'));

    }

    /**
     * Execute action hooks and get current hook.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testDoActionAndGetCurrentHook() {

        $this->assertContains('slide', Hook::doAction('slide'));
    }

    /**
     * Execute action hook with arguments.
     *
     * @since 1.0.6
     *
     * @return void
     */
    public function testDoActionsWithArguments() {

        $this->assertContains(

            'meta-hook',
            Hook::doAction('meta', 'The title')
        );

        $this->assertContains(

            'form-hook',
            Hook::doAction('form', ['input', 'select'])
        );
    }
}

/**
 * Example class.
 *
 * @since 1.0.6
 */
class Example {

    private static $sing;

    public static function getInstance() { return self::$sing = new self; }

    public static function singletonMethod() { return self::getInstance(); }

    public function meta($title) { return 'meta-hook'; }

    public function css() { return 'css-hook'; }

    public function js() { return 'js-hook'; }
    
    public function afterBody() { return 'after-hook'; }

    public function slide() { return Hook::current(); }

    public function form($input, $select) { return 'form-hook'; }

    public function article() { return 'article-hook'; }

    public function footer() { return 'footer-hook'; }
}
