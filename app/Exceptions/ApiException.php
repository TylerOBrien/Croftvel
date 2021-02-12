<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * The HTTP status code to be used in the response.
     * 
     * @var int
     */
    protected $http_code;

    /**
     * Create a new exception.
     * 
     * @return void
     */
    public function __construct(string $lang_file, int $http_code)
    {
        parent::__construct(trans($lang_file));

        $this->http_code = $http_code;
    }

    /**
     * Retrieve the error response.
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
