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

    public function test_should_get_callback(): void
    {
        $this->assertEquals($this->foo->bar(...), $this->action->getCallback());
    }

    public function test_should_get_priority(): void
    {
        $this->assertEquals(Priority::NORMAL, $this->action->getPriority());
    }

    public function test_should_get_result(): void
    {
        $this->assertNull($this->action->getResult());
    }

    public function test_should_check_if_it_runs_once(): void
    {
        $this->assertFalse($this->action->isOnce());
    }

    public function test_should_check_if_was_done(): void
    {
        $this->assertFalse($this->action->wasDone());

        $this->action->runCallback();

        $this->assertTrue($this->action->wasDone());
    }

    public function test_should_set_the_result_after_run_callback(): void
    {
        $this->action->runCallback('foo');

        $result = $this->action->getResult();

        $this->assertInstanceOf(Foo::class, $result);

        $this->assertEquals('bar', $result->methodName);
        $this->assertEquals('foo', $result->arguments[0]);
    }
}
