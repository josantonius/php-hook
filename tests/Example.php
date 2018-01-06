<?php
/**
 * Library for handling hooks.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 - 2018 (c) Josantonius - PHP-Hook
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Hook
 * @since     1.0.8
 */
namespace Josantonius\Hook;

/**
 * Example class.
 */
class Example
{
    /**
     * Class instance.
     */
    private static $singleton;

    public static function getInstance()
    {
        return self::$singleton = new self;
    }

    public static function singletonMethod()
    {
        return self::getInstance();
    }

    public function meta($title)
    {
        return 'meta-hook';
    }

    public function css()
    {
        return 'css-hook';
    }

    public function js()
    {
        return 'js-hook';
    }

    public function afterBody()
    {
        return 'after-hook';
    }

    public function slide()
    {
        return Hook::current();
    }

    public function form($input, $select)
    {
        return 'form-hook';
    }

    public function article()
    {
        return 'article-hook';
    }

    public function footer()
    {
        return 'footer-hook';
    }
}
