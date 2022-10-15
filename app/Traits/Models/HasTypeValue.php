<?php

namespace App\Traits\Models;

trait HasTypeValue
{
    /**
     * Returns an array with keys for this model's type and value.
     *
     * @return array<string, mixed>
     */
    public function toTypeValue(): array
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
