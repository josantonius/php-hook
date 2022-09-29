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
use Josantonius\Hook\Action;
use Josantonius\Hook\Priority;
use PHPUnit\Framework\TestCase;
use Josantonius\Hook\Tests\Example\Foo;

class AddActionMethodTest extends TestCase
{
    private Foo $foo;

    private Hook $hook;

    public function setUp(): void
    {
        parent::setUp();

        $this->foo  = new Foo();
        $this->hook = new Hook('foo');
    }

    public function test_should_add_action_with_default_priority(): void
    {
        $action = $this->hook->addAction($this->foo->bar(...));

        $this->assertInstanceOf(Action::class, $action);

        $hooks = $this->getPrivateProperty($this->hook, 'hooks');

        $this->assertArrayHasKey('foo', $hooks);
        $this->assertArrayHasKey('actions', $hooks['foo']);
        $this->assertArrayHasKey('done', $hooks['foo']);
        $this->assertFalse($hooks['foo']['done']);
        $this->assertCount(1, $hooks['foo']['actions']);
        $this->assertSame($hooks['foo']['actions'][0], $action);

        $this->assertFalse($action->isOnce());
        $this->assertSame(Priority::NORMAL, $action->getPriority());
    }

    public function test_should_add_action_with_custom_priority(): void
    {
        $action = $this->hook->addAction($this->foo->bar(...), Priority::HIGH);

        $this->assertSame(Priority::HIGH, $action->getPriority());
    }

    private function getPrivateProperty(Hook $object, string $property): mixed
    {
        $reflection = new ReflectionClass($object);

        $reflection = $reflection->getProperty($property);
        $reflection->setAccessible(true);

        return $reflection->getValue($object);
    }
}
