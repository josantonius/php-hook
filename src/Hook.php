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

use Josantonius\Hook\Exceptions\HookException;

/**
 * Hook handler.
 */
class Hook
{
    private static array $hooks = [];

    /**
     * Register new hook.
     */
    public function __construct(private string $name)
    {
        if (!isset(self::$hooks[$name])) {
            self::$hooks[$name] = [
                'actions' => [],
                'done' => false,
            ];
        }
    }

    /**
     * Add action on the hook.
     *
     * Action will be maintained after performing actions and will be available if are done again.
     */
    public function addAction(callable $callback, int $priority = Priority::NORMAL): Action
    {
        return $this->setAction($callback, $priority, once: false);
    }

    /**
     * Add action once on the hook.
     *
     * Action will only be done once and will be deleted after it is done.
     */
    public function addActionOnce(callable $callback, int $priority = Priority::NORMAL): Action
    {
        return $this->setAction($callback, $priority, once: true);
    }

    /**
     * Run the added actions for the hook.
     *
     * @throws HookException if the actions have already been done.
     * @throws HookException if no actions were added for the hook.
     *
     * @return Action[] Actions done.
     */
    public function doActions(mixed ...$arguments): array
    {
        if (!$this->hasActions()) {
            $this->hasDoneActions()
                ? (throw new HookException("Actions for '$this->name' hook have already been done"))
                : (throw new HookException("No actions were added for '$this->name' hook"));
        }

        $this->sortActionsByPriority();

        $actions = $this->getActions();

        foreach ($actions as $key => $action) {
            $action->runCallback(...$arguments);
            if ($action->isOnce()) {
                unset($this->getActions()[$key]);
            }
            self::$hooks[$this->name]['done'] = true;
        }

        return $actions;
    }

    /**
     * Gets hook name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * If there are actions to be done.
     */
    public function hasActions(): bool
    {
        return count($this->getActions()) > 0;
    }

    /**
     * If the actions have already been done at least once.
     */
    public function hasDoneActions(): bool
    {
        return self::$hooks[$this->name]['done'];
    }

    /**
     * If there are actions to be done.
     */
    public function hasUndoneActions(): bool
    {
        $actions = array_filter($this->getActions(), function (Action $action) {
            return !$action->wasDone();
        });

        return count($actions) > 0;
    }

    /**
     * Get actions from the hook.
     *
     * @return Action[]
     */
    private function &getActions(): array
    {
        return self::$hooks[$this->name]['actions'];
    }

    /**
     * Register new action on the hook.
     */
    private function setAction(callable $callback, int $priority, bool $once): Action
    {
        $action = new Action($callback, $priority, $once);

        $this->getActions()[] = $action;

        return $action;
    }

    /**
     * Sort actions by priority level.
     */
    private function sortActionsByPriority(): void
    {
        usort($this->getActions(), fn ($a, $b) => $a->getPriority() - $b->getPriority());
    }
}
