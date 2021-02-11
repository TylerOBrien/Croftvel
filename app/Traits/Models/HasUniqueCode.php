<?php

namespace App\Traits\Models;

trait HasUniqueCode
{
    /**
     * The plaintext verification code that is saved before being hashed.
     * 
     * @var string
     */
    protected $temporary_plaintext_code;

    /**
     * @return string|null
     */
    public function consumePlaintextCode()
    {
        $code = $this->temporary_plaintext_code;
        unset($this->temporary_plaintext_code);
        return $code;
    }

    /**
     * @return void
     */
    public function setCodeAttribute(string $code)
    {
        $this->temporary_plaintext_code = $code;
        $this->attributes['code'] = hash('sha256', $code);
    }
}
