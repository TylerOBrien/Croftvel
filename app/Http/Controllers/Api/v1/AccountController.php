<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Account\{ IndexAccount, ShowAccount, StoreAccount, UpdateAccount, DestroyAccount };
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the account.
     * 
     * @param IndexAccount $request
     *
     * @return Response
     */
    public function index(IndexAccount $request)
    {
        return Account::all();
    }

    /**
     * Display the specified account.
     * 
     * @param Account $account
     * @param ShowAccount $request
     *
     * @return Response
     */
    public function show(Account $account, ShowAccount $request)
    {
        return $account;
    }

    /**
     * Store a newly created account in storage.
     * 
     * @param StoreAccount $request
     *
     * @return Response
     */
    public function store(StoreAccount $request)
    {
        $fields = $request->validated();
        $accountId = Account::create($fields)->id;

        return Account::find($accountId);
    }

    /**
     * Update the specified account in storage.
     * 
     * @param Account $account
     * @param UpdateAccount $request
     * 
     * @return Response
     */
    public function update(Account $account, UpdateAccount $request)
    {
        $fields = $request->validated();

        $account->fill($fields);
        $account->save();

        return $account->only(array_keys($fields));
    }

    /**
     * Remove the specified account from storage.
     * 
     * @param Account $account
     * @param DestroyAccount $request
     *
     * @return Response
     */
    public function destroy(Account $account, DestroyAccount $request)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}
