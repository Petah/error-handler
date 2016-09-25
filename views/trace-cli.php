# Line	File	Function
<?php $trace = isset($trace) ? $trace : (function_exists('xdebug_get_function_stack') ? xdebug_get_function_stack() : debug_backtrace()); ?>
<?php foreach ($trace as $traceLine): ?>
# <?= isset($traceLine['line']) ? $traceLine['line'] : null; ?>	<?= isset($traceLine['file']) ? $traceLine['file'] : null; ?>	<?= isset($traceLine['class']) ? "{$traceLine['class']}::" : null; ?><?= $traceLine['function']; ?>

<?php endforeach; ?>
