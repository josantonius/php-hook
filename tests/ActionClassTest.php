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

use Josantonius\Hook\Action;
use Josantonius\Hook\Priority;
use PHPUnit\Framework\TestCase;
use Josantonius\Hook\Tests\Example\Foo;

class ActionClassTest extends TestCase
{
    private Foo $foo;

    private Action $action;

    public function setUp(): void
    {
        parent::setUp();

        $this->foo = new Foo();

        $this->action = new Action($this->foo->bar(...), Priority::NORMAL, once: false);
    }

    public function testShouldGetCallback(): void
    {
        $this->assertEquals($this->foo->bar(...), $this->action->getCallback());
    }

    public function testShouldGetPriority(): void
    {
        $this->assertEquals(Priority::NORMAL, $this->action->getPriority());
    }

    public function testShouldGetResult(): void
    {
        $this->assertNull($this->action->getResult());
    }

    public function testShouldCheckIfItRunsOnce(): void
    {
        $this->assertFalse($this->action->isOnce());
    }

    public function testShouldCheckIfWasDone(): void
    {
        $this->assertFalse($this->action->wasDone());

        $this->action->runCallback();

        $this->assertTrue($this->action->wasDone());
    }

    public function testShouldSetTheResultAfterRunCallback(): void
    {
        $this->action->runCallback('foo');

        $result = $this->action->getResult();

        $this->assertInstanceOf(Foo::class, $result);

        $this->assertEquals('bar', $result->methodName);
        $this->assertEquals('foo', $result->arguments[0]);
    }
}
