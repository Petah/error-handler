<?php

namespace Petah\Debug;

class ErrorHandler
{
    public function handleError($code, $message, $file, $line, $context = null)
    {
        if (error_reporting() === 0) {
            return false;
        }

        if (!headers_sent()) {
            http_response_code(500);
        }

        ob_start();
        if (PHP_SAPI == 'cli') {
            include ROOT.'/views/error-cli.php';
        } else {
            include ROOT.'/views/error.php';
        }
        echo ob_get_clean();
    }

    public function handleException($exception)
    {
        if (!headers_sent()) {
            http_response_code(500);
        }

        echo $this->renderException($exception);
    }

    public function handleShutdown() {
        $error = error_get_last();
        if ($error) {
            $this->handleError($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    public function renderException($exception)
    {
        ob_start();
        if (PHP_SAPI == 'cli') {
            include ROOT.'/views/exception-cli.php';
        } else {
            include ROOT.'/views/exception.php';
        }
        if ($exception->getPrevious()) {
            echo $this->renderException($exception->getPrevious());
        }
        return ob_get_clean();
    }

    public function render(string $view, array $data = [])
    {
        extract(get_object_vars($this), EXTR_SKIP);
        extract($data, EXTR_SKIP);
        ob_start();
        include ROOT.'/views/'.$view.'.php';
        return ob_get_clean();
    }

    public function renderTrace($trace)
    {
        include ROOT.'/views/trace.php';
    }

    public function renderData($data, $match = null)
    {
        if (!is_array($data) && !is_object($data)) {
            echo $data;
            return;
        }
        if (empty($data)) {
            var_dump($data);
            return;
        }
        echo '<table>';
        foreach ($data as $key => $value) {
            if (is_array($value) || is_object($value)) {
                echo '<tr><th>'.$key.'</th><td>';
                $this->renderData($value, $match);
                echo '</td></tr>';
            } else {
                if ($match && !preg_match($match, $key)) {
                    $value = '********';
                }
                echo '<tr><th>'.htmlspecialchars($key).'</th><td>'.htmlspecialchars($value).'</td></tr>';
            }
        }
        echo '</table>';
    }

    public function register()
    {
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
        register_shutdown_function([$this, 'handleShutdown']);
    }

    public static function getErrorType($code)
    {
        switch ($code) {
            case E_ERROR: return 'E_ERROR';
            case E_WARNING: return 'E_WARNING';
            case E_PARSE: return 'E_PARSE';
            case E_NOTICE: return 'E_NOTICE';
            case E_CORE_ERROR: return 'E_CORE_ERROR';
            case E_CORE_WARNING: return 'E_CORE_WARNING';
            case E_COMPILE_ERROR: return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING: return 'E_COMPILE_WARNING';
            case E_USER_ERROR: return 'E_USER_ERROR';
            case E_USER_WARNING: return 'E_USER_WARNING';
            case E_USER_NOTICE: return 'E_USER_NOTICE';
            case E_STRICT: return 'E_STRICT';
            case E_RECOVERABLE_ERROR: return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: return 'E_DEPRECATED';
            case E_USER_DEPRECATED: return 'E_USER_DEPRECATED';
            case E_ALL: return 'E_ALL';
        }

        return $code;
    }
}
