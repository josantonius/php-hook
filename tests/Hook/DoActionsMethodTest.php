<?php

/*
 * This file is part of https://github.com/josantonius/php-hook repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */

namespace Josantonius\Hook\Tests\Hook;

use ReflectionClass;
use Josantonius\Hook\Hook;
use Josantonius\Hook\Priority;
use PHPUnit\Framework\TestCase;
use Josantonius\Hook\Tests\Example\Foo;
use Josantonius\Hook\Exceptions\HookException;

class DoActionMethodTest extends TestCase
{
    private Foo $foo;

    private Hook $hook;

    public function setUp(): void
    {
        parent::setUp();

        $this->foo  = new Foo();
        $this->hook = new Hook('foo_hook');
    }

    public function test_should_fail_if_no_actions_were_added(): void
    {
        $this->expectException(HookException::class);

        $this->hook->doActions();
    }

    public function test_should_do_actions_without_arguments(): void
    {
        $fooHook = new Hook('foo_hook');
        $barHook = new Hook('bar_hook');

        $action1 = $fooHook->addAction($this->foo->one(...));
        $action2 = $fooHook->addAction($this->foo->two(...));
        $action3 = $barHook->addAction($this->foo->three(...));

        $this->assertNull($action1->getResult());
        $this->assertNull($action2->getResult());
        $this->assertNull($action3->getResult());

        $fooHook->doActions();
        $barHook->doActions();

        $this->assertEquals('one', $action1->getResult()->methodName);
        $this->assertEquals('two', $action2->getResult()->methodName);
        $this->assertEquals('three', $action3->getResult()->methodName);

        $this->assertEmpty($action1->getResult()->arguments);
        $this->assertEmpty($action2->getResult()->arguments);
        $this->assertEmpty($action3->getResult()->arguments);
    }

    public function test_should_do_actions_with_arguments(): void
    {
        $fooHook = new Hook('foo_hook');
        $barHook = new Hook('bar_hook');

        $action1 = $fooHook->addAction($this->foo->one(...));
        $action2 = $fooHook->addAction($this->foo->two(...));
        $action3 = $barHook->addAction($this->foo->three(...));

        $this->assertNull($action1->getResult());
        $this->assertNull($action2->getResult());
        $this->assertNull($action3->getResult());

        $fooHook->doActions('foo', 'bar');
        $barHook->doActions('bar', 'foo');

        $this->assertEquals('one', $action1->getResult()->methodName);
        $this->assertEquals('two', $action2->getResult()->methodName);
        $this->assertEquals('three', $action3->getResult()->methodName);

        $this->assertEquals(['foo', 'bar'], $action1->getResult()->arguments);
        $this->assertEquals(['foo', 'bar'], $action2->getResult()->arguments);
        $this->assertEquals(['bar', 'foo'], $action3->getResult()->arguments);
    }

    public function test_should_keep_the_action_if_was_set_with_add_action(): void
    {
        $hook = new Hook('user_hook');

        $hook->addAction($this->foo->bar(...));

        $hook->doActions();

        $actions = $this->getPrivateMethod($hook, 'getActions');

        $this->assertCount(1, $actions);
    }

    public function test_should_remove_the_action_if_was_set_with_add_action_once(): void
    {
        $hook = new Hook('login_hook');

        $hook->addActionOnce($this->foo->bar(...));

        $hook->doActions();

        $actions = $this->getPrivateMethod($hook, 'getActions');

        $this->assertCount(0, $actions);
    }

    public function test_should_return_an_array_with_the_actions_done(): void
    {
        $hook = new Hook('logout_hook');

        $action1 = $hook->addAction($this->foo->one(...));
        $action2 = $hook->addAction($this->foo->two(...));
        $action3 = $hook->addAction($this->foo->three(...));

        $actions = $hook->doActions();

        $this->assertCount(3, $actions);

        $this->assertSame($actions[0], $action1);
        $this->assertSame($actions[1], $action2);
        $this->assertSame($actions[2], $action3);
    }

    public function test_should_mark_the_hook_as_done(): void
    {
        $hook = new Hook('called_hook');

        $hook->addAction($this->foo->bar(...));

        $hook->doActions();

        $hooks = $this->getPrivateProperty($this->hook, 'hooks');

        $this->assertTrue($hooks['called_hook']['done']);
    }

    public function test_should_fail_if_the_actions_are_done_once_and_have_already_been_done(): void
    {
        $this->expectException(HookException::class);

        $hook = new Hook('the_hook');

        $hook->addActionOnce($this->foo->one(...));
        $hook->addActionOnce($this->foo->two(...));

        $hook->doActions();
        $hook->doActions();
    }

    public function test_should_do_actions_according_to_their_entry_order_with_same_priority(): void
    {
        $this->foo->clearHistory();

        $hook = new Hook('one_hook');

        $hook->addAction($this->foo->one(...));
        $hook->addAction($this->foo->two(...));
        $hook->addAction($this->foo->three(...));
        $hook->addAction($this->foo->four(...));

        $hook->doActions();

        $this->assertEquals(['one', 'two', 'three', 'four'], $this->foo->getHistory());
    }

    public function test_should_do_actions_according_to_their_priority_level(): void
    {
        $this->foo->clearHistory();

        $hook = new Hook('hook_with_priority');

        $hook->addAction($this->foo->normal(...));
        $hook->addAction($this->foo->lowest(...), Priority::LOWEST);
        $hook->addAction($this->foo->high(...), Priority::HIGH);
        $hook->addAction($this->foo->low(...), Priority::LOW);
        $hook->addAction($this->foo->highest(...), Priority::HIGHEST);

        $hook->doActions();

        $this->assertEquals(
            ['highest', 'high', 'normal', 'low', 'lowest'],
            $this->foo->getHistory()
        );
    }

    private function getPrivateProperty(Hook $object, string $property): mixed
    {
        $reflection = new ReflectionClass($object);

        $reflection = $reflection->getProperty($property);
        $reflection->setAccessible(true);

        return $reflection->getValue($object);
    }

    private function getPrivateMethod(Hook $object, string $method): mixed
    {
        $reflection = new ReflectionClass($object);

        $reflection = $reflection->getMethod($method);
        $reflection->setAccessible(true);

        return $reflection->invoke($object);
    }
}
