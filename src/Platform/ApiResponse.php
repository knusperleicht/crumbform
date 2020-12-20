<?php

namespace Knusperleicht\CrumbForm\Platform;
class ApiResponse
{
    private $message;
    private $error;

    public function __construct($message = null, $error = null)
    {
        $this->message = $message;
        $this->error = $error;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getError()
    {
        return $this->error;
    }

    public function toJson()
    {
        $json = json_encode(get_object_vars($this));
        return preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', $json);
    }
}
