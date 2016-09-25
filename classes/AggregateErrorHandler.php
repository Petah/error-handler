<?php

namespace Petah\Debug;

class AggregateErrorHandler extends ErrorHandler
{
    protected $errorHandlers = [];

    public function handleError($code, $message, $file, $line, $context = null)
    {
        foreach ($this->errorHandlers as $errorHandler) {
            $errorHandler->handleError($code, $message, $file, $line, $context);
        }
    }

    public function handleException($exception)
    {
        foreach ($this->errorHandlers as $errorHandler) {
            $errorHandler->handleException($exception);
        }
    }

    public function getErrorHandlers()
    {
        return $this->errorHandlers;
    }

    public function setErrorHandlers(array $errorHandlers)
    {
        $this->errorHandlers = $errorHandlers;
        return $this;
    }

    public function addErrorHandler(ErrorHandler $errorHandler)
    {
        $this->errorHandlers[] = $errorHandler;
        return $this;
    }
}
