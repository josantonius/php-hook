<?php
/**
 * Library for handling hooks.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 (c) Josantonius - PHP-Hook
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Hook
 * @since     1.0.8
 */

namespace Josantonius\Hook;

/**
 * Example class.
 *
 * @since 1.0.8
 */
class Example
{
    /**
     * Class instance.
     *
     * @since 1.0.8
     *
     * @return void
     */
    private static $singleton;

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public static function getInstance()
    {
        return self::$singleton = new self;
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public static function singletonMethod()
    {
        return self::getInstance();
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function meta($title)
    {
        return 'meta-hook';
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function css()
    {
        return 'css-hook';
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function js()
    {
        return 'js-hook';
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function afterBody()
    {
        return 'after-hook';
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function slide()
    {
        return Hook::current();
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function form($input, $select)
    {
        return 'form-hook';
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function article()
    {
        return 'article-hook';
    }

    /**
     * @since 1.0.8
     *
     * @return void
     */
    public function footer()
    {
        return 'footer-hook';
    }
}
