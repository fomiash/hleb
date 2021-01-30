<?php

declare(strict_types=1);

/*
 * Forming singleton trait.
 *
 * Трейт формирующий синглетон.
 */

trait DeterminantStaticUncreated
{
    private static $instance;

    protected function __construct() { }

    protected function __clone() { }

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        if(self::$instance instanceof Closure) {
            return self::$instance->call(new static);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public function __wakeup() {
        throw new \Exception("Cannot unserialize class");
    }
}

