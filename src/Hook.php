<?php 
/**
 * Library for handling hooks.
 * 
 * @author     Daveismyname - dave@daveismyname.com 
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
     * Available hooks.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private static $_hooks = [
        'meta',
        'css',
        'after-body',
        'footer',
        'js',
        'launch',
        'routes'
    ];

    /**
     * Method name to use the singleton pattern and just create an instance.
     *
     * @since 1.0.0
     *
     * @var string
     */
    private static $_singleton = 'getInstance';

    /**
     * Instances.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private static $_instances = array();

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
        
        if (isset(self::$_instances[$id])) {

            return self::$_instances[$id];
        } 
        
        return self::$_instances[$id] = new self;
    }

    /**
     * Set method name for use singleton pattern.
     *
     * @since 1.0.0
     *
     * @param string $method → singleton method name
     */
    public static function setSingletonName($method) {

        self::$_singleton = $method;
    }

    /**
     * Add hook/hooks to hook list.
     *
     * @since 1.0.0
     *
     * @param string|array $where → hook to add
     *
     * @return int → number hooks added
     */
    public static function setHook($where) {

        if (!is_array($where)) {

            self::$_hooks[$where] = '';

            return 1;
        }

        foreach ($where as $where) {

            self::$_hooks[$where] = '';
        }

        return count($where);
    }

    /**
     * Attach custom function to hook.
     *
     * @since 1.0.0
     *
     * @param array|string $where    → hook to use
     * @param string       $function → function to attach to hook
     *
     * @throws HookException → hook location not defined
     * @return boolean       → success with adding
     */
    public static function addHook($where, $function = '') {

        if (!is_array($where)) {

            $where = [$where => $function];
        }

        foreach ($where as $hook => $function) {

            if (!isset(self::$_hooks[$hook])) {

                $message = 'Hook location not defined';
                
                throw new HookException($message . ': ' . $hook, 811);
            }

            $theseHooks   = explode('|', self::$_hooks[$hook]);
            $theseHooks[] = $function;

            self::$_hooks[$hook] = implode('|', $theseHooks);
        }

        return true;
    }

    /**
     * Run all hooks attached to the hook.
     *
     * By default it will look for the 'getInstance' method to use singleton 
     * pattern and create a single instance of the class. If it does not
     * exist it will create a new object.
     *
     * @see setSingletonName() for change the method name.
     *
     * @since 1.0.0
     *
     * @param  string $where          → hook to run
     * @param  string $args           → optional arguments
     *
     * @throws HookException → the hook is not yet known
     * @return object|false  → returns the calling function
     */
    public static function run($where, $args='') {

        if (!isset(self::$_hooks[$where])) {

            $message = 'Hook location not defined';
            
            throw new HookException($message . ': ' . $where, 811);
        }

        $theseHooks = explode('|', self::$_hooks[$where]);

        foreach ($theseHooks as $hook) {

            if (preg_match("/@/i", $hook)) {

                $parts = explode('/', $hook);

                $last = end($parts);

                $segments = explode('@', $last);

                $class = $segments[0];

                $method = $segments[1];

                if (method_exists($class, self::$_singleton)) {

                    $instance = call_user_func([$class, self::$_singleton]); 

                    call_user_func([$instance, $method], $args);

                    continue;
                }

                $instance = new $class;

                call_user_func([$instance, $method], $args);
                    
            } else {

                if (function_exists($hook)) {

                    call_user_func($hook, $result);
                }
            }
        }
    }

    /**
     * Execute hooks attached to run and collect instead of running.
     *
     * @since 1.0.0
     *
     * @param string $where → hook
     * @param string $args  → optional arguments
     *
     * @return object → returns output of hook call
     */
    public function collectHook($where, $args = null) {

        ob_start();

        echo $this->run($where, $args);

        return ob_get_clean();
    }
}
