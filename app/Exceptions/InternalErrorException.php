<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use Exception;

class InternalErrorException extends Exception
{
    /**
     * InternalErrorException constructor.
     *
     * @param  string  $message
     */
    public function __construct(string $message)
    {
        parent::__construct();
        Log::error($message);
    }
    /**
     * @return array
     */
    public function buildError()
    {
        return ['message' => $this->getMessage()?:'Internal server error'];
    }
}
