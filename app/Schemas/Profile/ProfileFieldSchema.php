<?php

namespace App\Schemas\Company;

use App\Schemas\Schema;

class ProfileFieldSchema extends Schema
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string|in:'.join(',', config('enum.profile_field.type')),
            'value' => 'required|'.$this->valueRule(),
        ];
    }

    /**
     * @return string
     */
    public function valueRule(): string
    {
        return match ($this->attributes['type'] ?? null) {
            'string' => 'string',
            'integer' => 'int',
            'float' => 'float',
            'boolean' => 'boolean',
            'date' => 'date',
            'time' => 'time',
            'datetime' => 'datetime',
        };
    }
}
