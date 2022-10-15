<?php

namespace App\Schemas\Company;

use App\Schemas\Schema;

class CompanySchema extends Schema
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
