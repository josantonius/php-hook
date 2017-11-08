<?php
/**
 * Library for handling hooks.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 (c) Josantonius - PHP-Hook
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Hook
 * @since     1.0.6
 */
namespace Josantonius\Hook;

use PHPUnit\Framework\TestCase;

/**
 * Tests class for Hook library.
 *
 * @since 1.0.6
 */
final class HookTest extends TestCase
{
    /**
     * Hook instance.
     *
     * @since 1.1.5
     *
     * @var object
     */
    protected $Hook;

    /**
     * Set up.
     *
     * @since 1.1.5
     */
    public function setUp()
    {
        parent::setUp();

        $this->Hook = new Hook;
    }

    /**
     * Check if it is an instance of Hook.
     *
     * @since 1.1.5
     */
    public function testIsInstanceOfHook()
    {
        $actual = $this->Hook;
        $this->assertInstanceOf('Josantonius\Hook\Hook', $actual);
    }

    /**
     * Add action hook.
     *
     * @since 1.0.6
     */
    public function testAddAction()
    {
        $this->assertTrue(
            $this->Hook->addAction('css', ['Josantonius\Hook\Example', 'css'])
        );
    }

    /**
     * Add action hook with priority.
     *
     * @since 1.0.6
     */
    public function testAddActionWithPriority()
    {
        $this->assertTrue(
            $this->Hook->addAction('js', ['Josantonius\Hook\Example', 'js'], 1)
        );
    }

    /**
     * Add action hook with priority and arguments number.
     *
     * @since 1.0.6
     */
    public function testAddActionWithPriorityAndArguments()
    {
        $instance = new Example;

        $this->assertTrue(
            $this->Hook->addAction('meta', [$instance, 'meta'], 2, 1)
        );
    }

    /**
     * Add action hook and set singleton method.
     *
     * @since 1.0.6
     */
    public function testAddActionWithCustomSingletonMethod()
    {
        $this->Hook->setSingletonName('singletonMethod');

        $instance = call_user_func(
            'Josantonius\Hook\Example::singletonMethod'
        );

        $this->assertTrue(
            $this->Hook->addAction('article', [$instance, 'article'], 3, 0)
        );
    }

    /**
     * Add multiple action hooks.
     *
     * @since 1.0.6
     */
    public function testAddMultipleActions()
    {
        $instance = new Example;

        $this->assertTrue(
            $this->Hook->addActions([
                ['after-body', [$instance, 'afterBody'], 4, 0],
                ['footer', [$instance, 'footer'], 5, 0],
            ])
        );
    }

    /**
     * Add multiple action hooks and set singleton method.
     *
     * @since 1.0.6
     */
    public function testAddMultipleActionsWithCustomSingletonMethod()
    {
        $this->Hook->setSingletonName('singletonMethod');

        $instance = call_user_func(
            'Josantonius\Hook\Example::singletonMethod'
        );

        $this->assertTrue(
            $this->Hook->addActions([
                ['slide', [$instance, 'slide'], 6, 0],
                ['form', [$instance, 'form'], 7, 2],
            ])
        );
    }

    /**
     * Check if is action.
     *
     * @since 1.0.7
     */
    public function testIsAction()
    {
        $this->assertTrue(
            $this->Hook->isAction('meta')
        );

        $this->assertTrue(
            $this->Hook->isAction('form')
        );
    }

    /**
     * Check if isn`t action.
     *
     * @since 1.0.7
     */
    public function testIsNotAction()
    {
        $this->assertFalse(
            $this->Hook->isAction('unknown')
        );
    }

    /**
     * Execute action hooks.
     *
     * @since 1.0.6
     */
    public function testDoActions()
    {
        $this->assertContains('css-hook', $this->Hook->doAction('css'));
        $this->assertContains('js-hook', $this->Hook->doAction('js'));
        $this->assertContains('after-hook', $this->Hook->doAction('after-body'));
        $this->assertContains('article-hook', $this->Hook->doAction('article'));
        $this->assertContains('footer-hook', $this->Hook->doAction('footer'));
    }

    /**
     * Execute action hooks and get current hook.
     *
     * @since 1.0.6
     */
    public function testDoActionAndGetCurrentHook()
    {
        $this->assertContains('slide', $this->Hook->doAction('slide'));
    }

    /**
     * Execute action hook with arguments.
     *
     * @since 1.0.6
     */
    public function testDoActionsWithArguments()
    {
        $this->assertContains(
            'meta-hook',
            $this->Hook->doAction('meta', 'The title')
        );

        $this->assertContains(
            'form-hook',
            $this->Hook->doAction('form', ['input', 'select'])
        );
    }
}
