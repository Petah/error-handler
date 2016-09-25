<?php
require_once __DIR__ . '/../vendor/autoload.php';

(new Petah\Debug\DebugErrorHandler())->register();

$callback = function() {
    undefinedFunction();
};

$callback();
