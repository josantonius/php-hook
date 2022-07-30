<?php

/*
* This file is part of https://github.com/josantonius/php-hook repository.
*
* (c) Josantonius <hello@josantonius.dev>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Josantonius\Hook\Tests\Example;

class Foo
{
    public string $methodName;

    public array $arguments;

    private static array $history = [];

    public function __call(string $methodName, array $arguments): static
    {
        $instance = new static();

        $instance->methodName = $methodName;
        $instance->arguments  = $arguments;

        self::$history[] = $methodName;

        return $instance;
    }

    public function getHistory(): array
    {
        return self::$history;
    }

    public function clearHistory(): void
    {
        self::$history = [];
    }
}
