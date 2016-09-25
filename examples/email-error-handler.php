<?php
require_once __DIR__ . '/../vendor/autoload.php';

(new Petah\Debug\EmailErrorHandler([
    'server@example.com',
], [
    'developer@example.com',
]))->register();

$callback = function() {
    throw new \Exception();
};

$callback();
