<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Address\{ IndexAddress, ShowAddress, StoreAddress, UpdateAddress, DestroyAddress };
use App\Models\Address;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class AddressController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the addresses.
     *
     * @param  \App\Http\Requests\Api\v1\Address\IndexAddress  $request
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(IndexAddress $request)
    {
        $fields = $request->validated();
        $addresses = Address::select();

        return $this->filtered($addresses, $fields);
    }

    /**
     * Display the specified address.
     *
     * @param  \App\Models\Address  $address
     * @param  \App\Http\Requests\Api\v1\Address\ShowAddress  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address, ShowAddress $request)
    {
        return $address;
    }

    /**
     * Store a newly created address in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Address\StoreAddress  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddress $request)
    {
        $fields = $request->validated();

        return Address::create($fields);
    }

    /**
     * Update the specified address in storage.
     *
     * @param  \App\Models\Address  $address
     * @param  \App\Http\Requests\Api\v1\Address\UpdateAddress  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Address $address, UpdateAddress $request)
    {
        $fields = $request->validated();

        $address->fill($fields);
        $address->save();

        return $address;
    }

    /**
     * Remove the specified address from storage.
     *
     * @param  \App\Models\Address  $address
     * @param  \App\Http\Requests\Api\v1\Address\DestroyAddress  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address, DestroyAddress $request)
    {
        $address->delete();
        return response(null, 204);
    }
}
