<?php

namespace App\Observers\Api\v1;

use App\Models\Company;
use App\Schemas\Company\CompanySchema;

class CompanyObserver
{
    /**
     * Handle the company "updating" event.
     *
     * @param  \App\Models\Company  $company
     *
     * @return void
     */
    public function updating(Company $company): void
    {
        (new CompanySchema)->validate($company->getDirty());
    }
}
