<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $http_code;

    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct(string $lang_file, int $http_code)
    {
        parent::__construct(trans($lang_file));

        $this->http_code = $http_code;
    }

    /**
     * 
     * 
     * @return Response
     */
    public function render()
    {
        return response()->json([
            config('croft.responses.key.message') => $this->message
        ], $this->http_code);
    }
}
