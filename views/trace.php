<?php
    $trace = isset($trace) ? $trace : (function_exists('xdebug_get_function_stack') ? xdebug_get_function_stack() : debug_backtrace());
    $classLine = function ($traceLine) {
        if (isset($traceLine['file']) && preg_match('~[/\\\\]petah[/\\\\]debug[/\\\\]~', $traceLine['file'])) {
            return 'petah-debug-muted';
        }
    };
?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Line</th>
            <th>File</th>
            <th>Function</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trace as $traceLine): ?>
            <tr class="<?= $classLine($traceLine); ?>">
                <td><?= isset($traceLine['line']) ? $traceLine['line'] : null; ?></td>
                <td><?= isset($traceLine['file']) ? $traceLine['file'] : null; ?></td>
                <td><?= isset($traceLine['class']) ? "{$traceLine['class']}::" : null; ?><?= isset($traceLine['function']) ? $traceLine['function'] : null; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
