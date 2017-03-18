<?php 
/**
 * Library for handling hooks.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Hook
 * @since      1.0.0
 */

namespace Josantonius\Hook\Tests;

/**
 * Example class.
 *
 * @since 1.0.0
 */
class Example {

    /**
     * Instance.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private static $_instance = array();

    /**
     * Singleton pattern is used to create a single instance of the class.
     *
     * @since 1.0.0
     *
     * @return object → instance
     */
    public static function getInstance() {
        
        if (isset(self::$_instance)) {

            return self::$_instance;
        } 

        return self::$_instance = new self;
    }

    /**
     * Singleton pattern with custom name.
     *
     * @since 1.0.0
     *
     * @return object → instance
     */
    public static function newSingletonMethodName() {
        
        if (isset(self::$_instance)) {

            return self::$_instance;
        } 

        return self::$_instance = new self;
    }
    
    /**
     * Actions for css hook.
     *
     * @since 1.0.0
     */
    public function meta() {

        print('<title>A title</title>');
    }

    /**
     * Actions for css hook.
     *
     * @since 1.0.0
     */
    public function css() {

        print('<link rel="stylesheet" type="text/css" href="resources/style.css">');
    }
    
    /**
     * Actions for js hook.
     *
     * @since 1.0.0
     */
    public function js() { 

        print('<script src="resources/script.js"></script>');
    }
    
    /**
     * Actions for afterbody hook.
     *
     * @since 1.0.0
     */
    public function afterBody() { 

        print('<h1>Hello World</h1>');
    }
    
    /**
     * Actions for footer hook.
     *
     * @since 1.0.0
     */
    public function footer() {

        print('<h2>Footer</h2>');
    }
}
