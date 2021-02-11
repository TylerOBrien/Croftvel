<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasUniqueMaker
{
    /**
     * @param  string  $column
     * @param  int  $digits
     * 
     * @return int
     */
    static public function makeUniqueInt(string $column, int $digits=12):int
    {
        $model = self::class;
        $min = intval(str_repeat('1', $digits));
        $max = intval(str_repeat('9', $digits));

        do {
            $id = random_int($min, $max);
        } while ($model::where([ $column => $id ])->count());

        return $id;
    }

    /**
     * @param  string  $column
     * @param  int  $length
     * @param  string  $hash_algo
     * 
     * @return array|string
     */
    static public function makeUniqueString(string $column, int $length=12, string $hash_algo=null):string
    {
        $model = self::class;

        do {
            $id = Str::random($length);
            $maybe_hashed = $hash_algo ? hash($hash_algo, $id) : $id;
        } while ($model::where([ $column => $maybe_hashed ])->count());

        return $id;
    }
}
