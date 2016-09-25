
################################################################################
# An unhandled error has occurred in your application.
# <?= $line ? "({$line})" : null; ?> <?= $file; ?>

# <?= $code ? static::getErrorType($code) : null; ?> <?= $message; ?>

#
<?php $trace = $trace = isset($trace) ? $trace : (function_exists('xdebug_get_function_stack') ? xdebug_get_function_stack() : debug_backtrace()); ?>
<?php include __DIR__.'/trace-cli.php'; ?>
################################################################################
