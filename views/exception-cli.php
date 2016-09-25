
################################################################################
# An unhandled exception has occurred in your application.
# <?= date('Y-m-d H:i:s'); ?>

# <?= get_class($exception); ?>

# <?= $exception->getLine() ? "({$exception->getLine()})" : null; ?> <?= $exception->getFile(); ?>

#
# <?= $exception->getCode() ? "{$exception->getCode()}: " : null; ?> <?= $exception->getMessage(); ?>

#
<?php $trace = $exception->getTrace(); ?>

<?php include __DIR__.'/trace-cli.php'; ?>

################################################################################
