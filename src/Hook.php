<?php 
/**
 * Library for handling hooks.
 * 
 * @author     Josantonius  - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Hook
 * @since      1.0.0
 */

namespace Josantonius\Hook;

use Josantonius\Hook\Exception\HookException;

/**
 * Hook handler.
 *
 * @since 1.0.0
 */
class Hook {

    /**
     * Instance id.
     *
     * @since 1.0.5
     *
     * @var int
     */
    protected static $id = 0;

    /**
     * Callbacks.
     *
     * @since 1.0.3
     *
     * @var array
     */
    protected $callbacks = [];

    /**
     * Number of actions executed.
     *
     * @since 1.0.3
     *
     * @var array
     */
    protected $actions = ['count' => 0];

    /**
     * Current action hook.
     *
     * @since 1.0.3
     *
     * @var string|false
     */
    protected $current = false;

    /**
     * Method to use the singleton pattern and just create an instance.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $singleton = 'getInstance';

    /**
     * Instances.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private static $_instances = [];

    /**
     * Get instance.
     *
     * @since 1.0.0
     *
     * @param int $id
     *
     * @return object → instance
     */
    public static function getInstance($id = 0) {

        self::$id = $id;
        
        if (isset(self::$_instances[self::$id])) {

            return self::$_instances[self::$id];
        } 
        
        return self::$_instances[self::$id] = new self;
    }

    /**
     * Set method name for use singleton pattern.
     *
     * @since 1.0.0
     *
     * @param string $method → singleton method name
     */
    public static function setSingletonName($method) {

        $that = getInstance(self::$id);

        $that->singleton = $method;
    }

    /**
     * Attach custom function to action hook.
     *
     * @since 1.0.3
     *
     * @param string   $tag      → action hook name
     * @param callable $func     → function to attach to action hook
     * @param int      $priority → order in which the action is executed
     * @param int      $args     → number of arguments accepted
     *
     * @return boolean
     */
    public static function addAction($tag, $func, $priority=8, $args=0) {

        $that = getInstance(self::$id);

        $that->callbacks[$tag][$priority][] = [

            'function'  => $func,
            'arguments' => $args
        ];
        
        return true;
    }

    /**
     * Add actions hooks from array.
     *
     * @since 1.0.3
     *
     * @param array $actions
     *
     * @return boolean
     */
    public static function addActions($actions) {

        foreach ($actions as $arguments) {

            call_user_func_array([__CLASS__, 'addAction'], $arguments);
        }

        return true;
    }

    /**
     * Run all hooks attached to the hook.
     *
     * By default it will look for getInstance method to use singleton 
     * pattern and create a single instance of the class. If it does not
     * exist it will create a new object.
     *
     * @see setSingletonName() for change the method name.
     *
     * @since 1.0.3
     *
     * @param  string  $tag    → action hook name
     * @param  mixed   $args   → optional arguments
     * @param  boolean $remove → delete hook after executing actions
     *
     * @return returns the output of the last action or false
     */
    public static function doAction($tag, $args = [], $remove = true) {

        $that = getInstance(self::$id);

        $that->current = $tag;

        $that->actions['count']++;

        if (!array_key_exists($tag, $that->actions)) {

            $that->actions[$tag] = 0;
        }

        $that->actions[$tag]++;

        $actions = $that->_getActions($tag, $remove);

        asort($actions);

        foreach ($actions as $priority) {

            foreach ($priority as $action) {

                $action = $that->_runAction($action, $args);
            }
        }

        $that->current = false;

        return (isset($action)) ? $action : false;
    }

    /**
     * Run action hook.
     *
     * @since 1.0.3
     *
     * @param string  $action → action hook
     * @param int     $args   → arguments
     *
     * @return callable|false → returns the calling function
     */
    private function _runAction($action, $args) {

        $that = getInstance(self::$id);

        $function   = $action['function'];
        $argsNumber = $action['arguments'];

        $class  = (isset($function[0])) ? $function[0] : false;
        $method = (isset($function[1])) ? $function[1] : false;

        $args = $that->_getArguments($argsNumber, $args);

        if (!($class && $method) && function_exists($function)) {

            return call_user_func($function, $args);

        } else if ($obj = call_user_func([$class, $that->$singleton])) {

            if ($obj !== false) {

                return call_user_func_array([$obj, $method], $args);
            }

        } else {

            $instance = new $class;

            return call_user_func_array([$instance, $method], $args);
        }
    }

    /**
     * Get actions for hook
     *
     * @since 1.0.3
     *
     * @param string  $tag    → action hook name
     * @param boolean $remove → delete hook after executing actions
     *
     * @return object|false → returns the calling function
     */
    private function _getActions($tag, $remove) {

        $that = getInstance(self::$id);

        if (isset($that->callbacks[$tag])) {

            $actions = $that->callbacks[$tag];

            if ($remove) {

                unset($that->callbacks[$tag]);
            }
        }

        return (isset($actions)) ? $actions : [];
    }

    /**
     * Get arguments for action.
     *
     * @since 1.0.3
     *
     * @param int   $argsNumber → arguments number
     * @param mixed $arguments  → arguments
     *
     * @return array → arguments
     */
    private function _getArguments($argsNumber, $arguments) {

        if ($argsNumber == 1 && is_string($arguments)) {

            return [$arguments];

        } else if ($argsNumber === count($arguments)) {

            return $arguments;
        }

        for ($i=0; $i < $argsNumber; $i++) {

            if (array_key_exists($i, $arguments)) {
            
                $args[] = $arguments[$i];

                continue;
            }

            return $args;
        }

        return [];
    }

    /**
     * Returns the current action hook.
     *
     * @since 1.0.3
     *
     * @return string|false → current action hook
     */
    public static function current() {

        $that = getInstance(self::$id);

        return $that->current;
    }
}
