<?php

namespace App\Exceptions\Api;

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
     * @param  string  $lang_file  Name of the lang file to use for the error message.
     * @param  int  $http_code  The HTTP status code.
     * @param  array  $attributes  The attributes to pass to the lang file.
     *
     * @return void
     */
    public function __construct(string $lang_file, int $http_code, array $attributes = [])
    {
        $this->message = trans($lang_file, $attributes);
        $this->http_code = $http_code;
    }

    /**
     * Retrieve the error response.
     *
     * @return Response
     */
    public function render()
    {
        return response(
            [
                config('response.key.message') => $this->message,
            ],
            $this->http_code,
        );
    }
}
