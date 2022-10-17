<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Company\{ IndexCompany, ShowCompany, StoreCompany, UpdateCompany, DestroyCompany };
use App\Models\Company;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class CompanyController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the companies.
     *
     * @param  \App\Http\Requests\Api\v1\Company\IndexCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCompany $request)
    {
        $fields = $request->validated();
        $companies = Company::select();

        return $this->filtered($companies, $fields);
    }

    /**
     * Display the specified company.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Http\Requests\Api\v1\Company\ShowCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, ShowCompany $request)
    {
        return $company;
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Company\StoreCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $fields = $request->validated();

        return Company::create($fields);
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Http\Requests\Api\v1\Company\UpdateCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, UpdateCompany $request)
    {
        $fields = $request->validated();

        $company->fill($fields);
        $company->save();

        return $company;
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Http\Requests\Api\v1\Company\DestroyCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, DestroyCompany $request)
    {
        $company->delete();
        return response(null, 204);
    }
}
