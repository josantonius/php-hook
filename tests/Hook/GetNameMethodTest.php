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

class GetNameMethodTest extends TestCase
{
    private Hook $hook;

    public function setUp(): void
    {
        parent::setUp();

        $this->hook = new Hook('foo');
    }

    public function test_should_get_hook_name(): void
    {
        $this->assertEquals('foo', $this->hook->getName());
    }
}
