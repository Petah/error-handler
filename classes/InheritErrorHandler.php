<?php

namespace Petah\Debug;

class InheritErrorHandler extends ErrorHandler
{
    protected $errorHandler;
    protected $previousErrorHandler;
    protected $previousExceptionHandler;
    protected $previousShutdownHandler;

    public function __construct($errorHandler) {
        $this->errorHandler = $errorHandler;
    }

    public function register()
    {
        $this->previousErrorHandler = set_error_handler([$this, 'handleError']);
        $this->previousExceptionHandler = set_exception_handler([$this, 'handleException']);
        $this->previousShutdownHandler = register_shutdown_function([$this, 'handleShutdown']);
    }

    public function handleError($code, $message, $file, $line, $context = null)
    {
        $this->errorHandler->handleError($code, $message, $file, $line, $context);
        if ($this->previousErrorHandler) {
            call_user_func($this->previousErrorHandler, $code, $message, $file, $line, $context);
        }
    }

    public function handleException($exception)
    {
        $this->errorHandler->handleException($exception);
        if ($this->previousExceptionHandler) {
            call_user_func($this->previousExceptionHandler, $exception);
        }
    }

    public function handleShutdown() {
        $this->errorHandler->handleShutdown();
        if ($this->previousShutdownHandler) {
            call_user_func($this->previousShutdownHandler);
        }
    }
}
