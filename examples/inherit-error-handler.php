<?php
require_once __DIR__ . '/../vendor/autoload.php';

$emailErrorHandler = new Petah\Debug\EmailErrorHandler([
    'server@example.com',
], [
    'developer@example.com',
]);

(new Petah\Debug\DebugErrorHandler())->register();

(new Petah\Debug\InheritErrorHandler($emailErrorHandler))->register();

$callback = function() {
    throw new \Exception();
};

$callback();
