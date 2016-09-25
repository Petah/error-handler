<?php

namespace Petah\Debug;

class StackTrace
{
    public static $options = DEBUG_BACKTRACE_IGNORE_ARGS;
    public static $limit = 0;

    public static function isEnabled()
    {
        return true;
    }

    public static function render()
    {
        ob_start();
        debug_print_backtrace(static::$options, static::$limit);
        yield trim(ob_get_clean()).PHP_EOL;
    }
}
