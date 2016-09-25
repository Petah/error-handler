<?php

namespace Petah\Debug;

class EmailErrorHandler extends ErrorHandler
{
    protected $from;
    protected $to;

    public function __construct(array $from, array $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function handleError($code, $message, $file, $line, $context = null)
    {
        if (error_reporting() === 0) {
            return false;
        }

        if (!headers_sent()) {
            http_response_code(500);
        }

        ob_start();
        include ROOT.'/views/error.php';
        $content = ob_get_clean();

        $this->sendEmail($content);
    }

    public function handleException($exception)
    {
        if (!headers_sent()) {
            http_response_code(500);
        }

        $this->sendEmail($this->renderException($exception));
    }

    protected function sendEmail($content)
    {
        if (empty($this->getFrom()) || empty($this->getTo())) {
            return;
        }

        $cssToInlineStyles = new \TijsVerkoyen\CssToInlineStyles\CssToInlineStyles();
        $content = $cssToInlineStyles->convert($content);

        $message = \Swift_Message::newInstance()
            ->setSubject('Error at '.date('Y-m-d h:i:s'))
            ->setFrom($this->getFrom())
            ->setTo($this->getTo())
            // ->setBody($content);
            ->addPart($content, 'text/html');

        $transport = \Swift_MailTransport::newInstance();
        $mailer = \Swift_Mailer::newInstance($transport);
        $result = $mailer->send($message);
    }

    public function renderException($exception)
    {
        ob_start();
        include ROOT.'/views/exception.php';
        if ($exception->getPrevious()) {
            echo $this->renderException($exception->getPrevious());
        }
        return ob_get_clean();
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom(array $from)
    {
        $this->from = $from;
        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo(array $to)
    {
        $this->to = $to;
        return $this;
    }
}
