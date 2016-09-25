<?php

namespace Petah\Debug;

trait Renderer
{
    public static function render(...$args)
    {
        foreach ($args as $arg) {
            ob_start();
            static::$method($arg);
            yield trim(ob_get_clean()).PHP_EOL;
        }
    }
}
