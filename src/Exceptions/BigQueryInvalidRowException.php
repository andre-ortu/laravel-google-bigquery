<?php

namespace AndreOrtu\LaravelGoogleBigQuery\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class BigQueryInvalidRowException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function report()
    {
        Log::debug($this->message);
    }
}
