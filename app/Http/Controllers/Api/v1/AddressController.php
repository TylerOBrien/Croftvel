<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\Address;
use App\Traits\Controllers\Api\v1\HasQueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Address\{ IndexAddress, ShowAddress, StoreAddress, UpdateAddress, DestroyAddress };

class AddressController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the addresses.
     * 
     * @param IndexAddress $request
     *
     * @return Response
     */
    public function index(IndexAddress $request)
    {
        $fields = $request->validated();
        $addresses = Address::select();

        return $this->filtered($addresses, $fields)
                    ->with(config('croft.relationships.address.index'))
                    ->get()
                    ->each->append(config('croft.attributes.address.index'));
    }

    /**
     * Display the specified address.
     * 
     * @param Address $address
     * @param ShowAddress $request
     *
     * @return Response
     */
    public function show(Address $address, ShowAddress $request)
    {
        return $address->load(config('croft.relationships.address.show'))
                       ->append(config('croft.attributes.address.show'));
    }

    /**
     * Store a newly created address in storage.
     * 
     * @param StoreAddress $request
     *
     * @return Response
     */
    public function store(StoreAddress $request)
    {
        return Address::create($request->validated())
                      ->load(config('croft.relationships.address.show'))
                      ->append(config('croft.attributes.address.show'));
    }

    /**
     * Update the specified address in storage.
     * 
     * @param Address $address
     * @param UpdateAddress $request
     * 
     * @return Response
     */
    public function update(Address $address, UpdateAddress $request)
    {
        $fields = $request->validated();

        $address->fill($fields);
        $address->save();

        return $address->only(array_keys($fields));
    }

    /**
     * Remove the specified address from storage.
     * 
     * @param Address $address
     * @param DestroyAddress $request
     * 
     * @return Response
     */
    public function destroy(Address $address, DestroyAddress $request)
    {
        $address->delete();
    }
}
