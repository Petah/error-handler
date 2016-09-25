<?php

namespace Petah\Debug;

class XdebugVarDump
{
    public static function isEnabled()
    {
        return function_exists('xdebug_var_dump');
    }

    public static function render(...$args)
    {
        foreach ($args as $arg) {
            ob_start();
            xdebug_var_dump($arg);
            yield trim(ob_get_clean()).PHP_EOL;
        }
    }
}
