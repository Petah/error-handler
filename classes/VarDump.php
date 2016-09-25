<?php

namespace Petah\Debug;

class VarDump
{
    public static function isEnabled()
    {
        return true;
    }

    public static function render(...$args)
    {
        foreach ($args as $arg) {
            ob_start();
            var_dump($arg);
            yield trim(ob_get_clean()).PHP_EOL;
        }
    }
}
