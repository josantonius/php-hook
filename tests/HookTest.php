<?php
/**
 * Library for handling hooks.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 - 2018 (c) Josantonius - PHP-Hook
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Hook
 * @since     1.0.6
 */
namespace Josantonius\Hook;

use PHPUnit\Framework\TestCase;

/**
 * Tests class for Hook library.
 */
final class HookTest extends TestCase
{
    /**
     * Hook instance.
     *
     * @since 1.0.9
     *
     * @var object
     */
    protected $Hook;

    /**
     * Set up.
     *
     * @since 1.0.9
     */
    public function setUp()
    {
        $hook = $this->Hook;

        parent::setUp();

        $this->Hook = new Hook;
    }

    /**
     * Check if it is an instance of Hook.
     *
     * @since 1.0.9
     */
    public function testIsInstanceOfHook()
    {
        $hook = $this->Hook;

        $this->assertInstanceOf('Josantonius\Hook\Hook', $this->Hook);
    }

    /**
     * Add action hook.
     */
    public function testAddAction()
    {
        $hook = $this->Hook;

        $this->assertTrue(
            $hook::addAction('css', ['Josantonius\Hook\Example', 'css'])
        );
    }

    /**
     * Add action hook with priority.
     */
    public function testAddActionWithPriority()
    {
        $hook = $this->Hook;

        $this->assertTrue(
            $hook::addAction('js', ['Josantonius\Hook\Example', 'js'], 1)
        );
    }

    /**
     * Add action hook with priority and arguments number.
     */
    public function testAddActionWithPriorityAndArguments()
    {
        $hook = $this->Hook;

        $instance = new Example;

        $this->assertTrue(
            $hook::addAction('meta', [$instance, 'meta'], 2, 1)
        );
    }

    /**
     * Add action hook and set singleton method.
     */
    public function testAddActionWithCustomSingletonMethod()
    {
        $hook = $this->Hook;

         $hook::setSingletonName('singletonMethod');

        $instance = call_user_func(
            'Josantonius\Hook\Example::singletonMethod'
        );

        $this->assertTrue(
            $hook::addAction('article', [$instance, 'article'], 3, 0)
        );
    }

    /**
     * Add multiple action hooks.
     */
    public function testAddMultipleActions()
    {
        $hook = $this->Hook;

        $instance = new Example;

        $this->assertTrue(
            $hook::addActions([
                ['after-body', [$instance, 'afterBody'], 4, 0],
                ['footer', [$instance, 'footer'], 5, 0],
             ])
        );
    }

    /**
     * Add multiple action hooks and set singleton method.
     */
    public function testAddMultipleActionsWithCustomSingletonMethod()
    {
        $hook = $this->Hook;

         $hook::setSingletonName('singletonMethod');

        $instance = call_user_func(
            'Josantonius\Hook\Example::singletonMethod'
        );

        $this->assertTrue(
            $hook::addActions([
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
        $hook = $this->Hook;

        $this->assertTrue(
            $hook::isAction('meta')
        );

        $this->assertTrue(
            $hook::isAction('form')
        );
    }

    /**
     * Check if isn`t action.
     *
     * @since 1.0.7
     */
    public function testIsNotAction()
    {
        $hook = $this->Hook;

        $this->assertFalse(
            $hook::isAction('unknown')
        );
    }

    /**
     * Execute action hooks.
     */
    public function testDoActions()
    {
        $hook = $this->Hook;

        $this->assertContains('css-hook', $hook::doAction('css'));
        $this->assertContains('js-hook', $hook::doAction('js'));
        $this->assertContains('after-hook', $hook::doAction('after-body'));
        $this->assertContains('article-hook', $hook::doAction('article'));
        $this->assertContains('footer-hook', $hook::doAction('footer'));
    }

    /**
     * Execute action hooks and get current hook.
     */
    public function testDoActionAndGetCurrentHook()
    {
        $hook = $this->Hook;

        $this->assertContains('slide', $hook::doAction('slide'));
    }

    /**
     * Execute action hook with arguments.
     */
    public function testDoActionsWithArguments()
    {
        $hook = $this->Hook;

        $this->assertContains(
            'meta-hook',
            $hook::doAction('meta', 'The title')
        );

        $this->assertContains(
            'form-hook',
            $hook::doAction('form', ['input', 'select'])
        );
    }
}
