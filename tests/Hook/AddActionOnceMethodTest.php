<?php

/*
* This file is part of https://github.com/josantonius/php-hook repository.
*
* (c) Josantonius <hello@josantonius.dev>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Josantonius\Hook\Tests\Hook;

use ReflectionClass;
use Josantonius\Hook\Hook;
use Josantonius\Hook\Action;
use Josantonius\Hook\Priority;
use PHPUnit\Framework\TestCase;
use Josantonius\Hook\Tests\Example\Foo;

class AddActionOnceMethodTest extends TestCase
{
    private Foo $foo;

    private Hook $hook;

    public function setUp(): void
    {
        parent::setUp();

        $this->foo  = new Foo();
        $this->hook = new Hook('bar');
    }

    public function testShouldAddActionWithDefaultPriority(): void
    {
        $action = $this->hook->addActionOnce($this->foo->bar(...));

        $this->assertInstanceOf(Action::class, $action);

        $hooks = $this->getPrivateProperty($this->hook, 'hooks');

        $this->assertArrayHasKey('bar', $hooks);
        $this->assertArrayHasKey('actions', $hooks['bar']);
        $this->assertArrayHasKey('done', $hooks['bar']);
        $this->assertFalse($hooks['foo']['done']);
        $this->assertCount(1, $hooks['bar']['actions']);
        $this->assertSame($hooks['bar']['actions'][0], $action);

        $this->assertTrue($action->isOnce());
        $this->assertSame(Priority::NORMAL, $action->getPriority());
    }

    public function testShouldAddActionWithCustomPriority(): void
    {
        $action = $this->hook->addActionOnce($this->foo->bar(...), Priority::HIGH);

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
