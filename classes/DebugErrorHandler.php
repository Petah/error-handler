<?php

namespace Petah\Debug;

class DebugErrorHandler extends ErrorHandler
{
    public function handleException($exception)
    {
        parent::handleException($exception);
    }

    public function render(string $view, array $data = [])
    {
        extract(get_object_vars($this), EXTR_SKIP);
        extract($data, EXTR_SKIP);
        ob_start();
        include ROOT.'/views/'.$view.'.php';
        $body = ob_get_clean();
        include ROOT.'/views/layout.php';
    }
}
