<?php

declare(strict_types=1);

/*
 * This file is part of https://github.com/josantonius/php-hook repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Josantonius\Hook;

/**
 * Action hook instance.
 */
class Action
{
    /**
     * If the action was done.
     */
    private bool $done = false;

    /**
     * Callback result.
     */
    private mixed $result = null;

    /**
     * Create new action instance.
     */
    public function __construct(
        private $callback,
        private int $priority,
        private bool $once
    ) {
    }

    /**
     * Gets action callback.
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * Gets action priority.
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Gets callback result.
     */
    public function getResult(): mixed
    {
        return $this->result;
    }

    /**
     * True if the action is called only once and deleted.
     */
    public function isOnce(): bool
    {
        return $this->once;
    }

    /**
     * Run action callback.
     */
    public function runCallback(...$arguments): void
    {
        $this->result = $this->getCallback()(...$arguments);

        $this->done = true;
    }

    /**
     * If the action has already been done.
     */
    public function wasDone(): bool
    {
        return $this->done === true;
    }
}
