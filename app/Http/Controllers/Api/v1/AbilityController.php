<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Ability\{ IndexAbility, ShowAbility, StoreAbility, UpdateAbility, DestroyAbility };
use App\Models\Ability;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class AbilityController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the abilities.
     * 
     * @param  \App\Http\Requests\Api\v1\Ability\IndexAbility  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexAbility $request)
    {
        $fields = $request->validated();
        $abilities = Ability::select();

        return $this->filtered($abilities, $fields);
    }

    /**
     * Display the specified ability.
     * 
     * @param  \App\Models\Ability  $ability
     * @param  \App\Http\Requests\Api\v1\Ability\ShowAbility  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Ability $ability, ShowAbility $request)
    {
        return $ability;
    }

    /**
     * Store a newly created ability in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\Ability\StoreAbility  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbility $request)
    {
        $fields = $request->validated();

        return Ability::create($fields)->fresh();
    }

    /**
     * Update the specified ability in storage.
     * 
     * @param  \App\Models\Ability  $ability
     * @param  \App\Http\Requests\Api\v1\Ability\UpdateAbility  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Ability $ability, UpdateAbility $request)
    {
        $fields = $request->validated();

        $ability->fill($fields);
        $ability->save();

        return $ability;
    }

    /**
     * Remove the specified ability from storage.
     * 
     * @param  \App\Models\Ability  $ability
     * @param  \App\Http\Requests\Api\v1\Ability\DestroyAbility  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ability $ability, DestroyAbility $request)
    {
        $ability->delete();
        return response()->json(null, 204);
    }
}
