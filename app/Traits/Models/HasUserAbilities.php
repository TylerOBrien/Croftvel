<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait HasUserAbilities
{
    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the user instance has the given ability.
     *
     * @param  string  $ability  The ability to check for the existence of.
     * @param  string  $model_type  The string version of the model class name the ability will apply to.
     * @param  int|null  $model_id  The primary key of the model instance the ability will apply to.
     *
     * @return bool
     */
    public function hasAbility(string $ability, string $model_type, int|null $model_id = null): bool
    {
        return $this->hasTokenAbility($ability, $model_type, $model_id) &&
               $this->hasDatabaseAbility($ability, $model_type, $model_id);
    }

    /**
     * Check if the user instance has the given ability.
     *
     * @param  string  $ability  The ability to check for the existence of.
     * @param  string  $model_type  The string version of the model class name the ability will apply to.
     * @param  int|null  $model_id  The primary key of the model instance the ability will apply to.
     *
     * @return bool
     */
    protected function hasTokenAbility(string $ability, string $model_type, int|null $model_id = null): bool
    {
        return true; // Currently not implemented so just return true.
    }

    /**
     * Check if the user instance has the given ability defined in storage.
     *
     * @param  string  $ability  The ability to check for the existence of.
     * @param  string  $model_type  The string version of the model class name the ability will apply to.
     * @param  int|null  $model_id  The primary key of the model instance the ability will apply to.
     *
     * @return bool
     */
    protected function hasDatabaseAbility(string $ability, string $model_type, int|null $model_id = null): bool
    {
        $model_type = Str::start($model_type, config('models.namespace'));
        $bindings = [
            'ability' => $ability,
            'model_type' => $model_type,
            'user_id' => $this->id,
        ];

        if (is_null($model_id)) {
            $model_id_clause = 'abilities.model_id IS NULL';
        } else {
            $bindings['model_id'] = $model_id;
            $model_id_clause = '(abilities.model_id IS NULL OR abilities.model_id = :model_id)';
        }

        $query = DB::raw("
            SELECT EXISTS(
                SELECT *
                FROM abilities
                JOIN privileges ON privileges.id = abilities.privilege_id
                JOIN privilege_user ON privileges.id = privilege_user.privilege_id
                WHERE privilege_user.user_id = :user_id AND
                    (abilities.name = '*' OR abilities.name = :ability) AND
                    (abilities.model_type = '*' OR abilities.model_type = :model_type) AND
                    $model_id_clause
                LIMIT 1
            ) as `exists`;");

        return (bool) DB::select($query, $bindings)[0]->exists ?? false;
    }
}
