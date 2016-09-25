<?php

namespace Petah\Debug;

class Debug
{
    public static $count = null;

    public static function out(...$arguments)
    {
        echo '<pre>';
        static::output(...$arguments);
        echo '</pre>';
    }

    public static function dump(...$arguments)
    {
        echo '<pre>';
        static::output(...$arguments);
        static::output($_POST);
        static::printStackTrace();
        static::stopExecution();
        echo '</pre>';
    }

    public static function dumpCount($count, ...$arguments)
    {
        if (static::$count === null) {
            static::$count = $count;
        }
        static::$count--;
        if (static::$count <= 0) {
            static::dump(...$arguments);
        }
    }

    public static function output(...$arguments)
    {
        if (count($arguments) > 0) {
            var_dump(...$arguments);
        }
    }

    public static function printStackTrace()
    {
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    }

    public static function stopExecution()
    {
        die(__FILE__);
    }
}
