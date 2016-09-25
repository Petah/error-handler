<?php

namespace Petah\Debug;

class XdebugStackTrace
{
    /**
     * Allows you to replace the message in the header with your own.
     *
     * @var string|null
     */
    public static $message = null;

    /**
     * Checks if the xdebug_print_function_stack function exists.
     *
     * @return bool
     */
    public static function isEnabled()
    {
        return function_exists('xdebug_print_function_stack');
    }

    public static function render()
    {
        ob_start();
        if (static::$message) {
            xdebug_print_function_stack(static::$message);
        } else {
            xdebug_print_function_stack();
        }
        yield trim(ob_get_clean()).PHP_EOL;
    }
}
