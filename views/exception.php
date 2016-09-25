</script>
<!-- <?= $exception->getLine() ? "({$exception->getLine()})" : null; ?> <?= $exception->getFile(); ?> -->
<!-- <?= $exception->getCode() ? "{$exception->getCode()}: " : null; ?> <?= $exception->getMessage(); ?> -->
<style><?= file_get_contents(__DIR__.'/style.css'); ?></style>
<div class="error-container">
    <h1>An unhandled exception has occurred in your application.</h1>
    <p><?= date('Y-m-d H:i:s'); ?></p>
    <p><?= get_class($exception); ?></p>
    <p><?= $exception->getLine() ? "Line {$exception->getLine()} of " : null; ?> <?= $exception->getFile(); ?></p>
    <p><?= $exception->getCode() ? "{$exception->getCode()}: " : null; ?> <?= $exception->getMessage(); ?></p>
    <?php if (method_exists($exception, 'getContext')): ?>
        <pre><?php var_dump($exception->getContext()); ?></pre>
    <?php endif; ?>
    <h2>Post</h2>
    <?php $this->renderData($_POST); ?>
    <h2>Get</h2>
    <?php $this->renderData($_GET); ?>
    <h2>Server</h2>
    <?php $this->renderData($_SERVER, '/^[A-Z_]+$/'); ?>
    <h2>Trace</h2>
    <?php $this->renderTrace($exception->getTrace()); ?>
</div>
