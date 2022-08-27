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

use Josantonius\Hook\Hook;
use PHPUnit\Framework\TestCase;
use Josantonius\Hook\Tests\Example\Foo;

class HasUndoneActionsMethodTest extends TestCase
{
    private Foo $foo;

    private Hook $hook;

    public function setUp(): void
    {
        parent::setUp();

        $this->foo  = new Foo();
        $this->hook = new Hook('user_delete');
    }

    public function test_should_check_if_hook_has_undone_actions(): void
    {
        $this->assertFalse($this->hook->hasUndoneActions());

        $this->hook->addAction($this->foo->one(...));

        $this->assertTrue($this->hook->hasUndoneActions());
    }
}
