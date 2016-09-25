</script>
<!-- <?= $line ? $line . ':' : null; ?> <?= $file; ?> -->
<!-- <?= $code ? static::getErrorType($code) : null; ?> <?= $message; ?> -->
<style><?= file_get_contents(__DIR__.'/style.css'); ?></style>
<div class="error-container">
    <h1>An unhandled error has occurred in your application.</h1>
    <p><?= date('Y-m-d H:i:s'); ?></p>
    <p><?= $line ? "Line {$line} of " : null; ?> <?= $file; ?></p>
    <p><?= $code ? static::getErrorType($code) : null; ?> <?= $message; ?></p>
    <h2>Post</h2>
    <?php $this->renderData($_POST); ?>
    <h2>Get</h2>
    <?php $this->renderData($_GET); ?>
    <h2>Server</h2>
    <?php $this->renderData($_SERVER, '/^[A-Z_]+$/'); ?>
    <h2>Trace</h2>
    <?php $trace = isset($trace) ? $trace : (function_exists('xdebug_get_function_stack') ? xdebug_get_function_stack() : debug_backtrace()); ?>
    <?php include __DIR__.'/trace.php'; ?>
</div>
