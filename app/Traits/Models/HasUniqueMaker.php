<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasUniqueMaker
{
    /**
     * @param  string  $column
     * @param  int  $digits
     * @param  string  $hash_algo
     * 
     * @return int
     */
    static public function makeUniqueInt(string $column, int $digits = 12, string $hash_algo = null):int
    {
        $min = intval(str_repeat('1', $digits));
        $max = intval(str_repeat('9', $digits));

        do {
            $id = random_int($min, $max);
            $maybe_hashed = $hash_algo ? hash($hash_algo, $id) : $id;
        } while (self::where([ $column => $maybe_hashed ])->count());

        return $id;
    }

    /**
     * @param  string  $column
     * @param  int  $length
     * @param  string  $hash_algo
     * 
     * @return string
     */
    static public function makeUniqueString(string $column, int $length = 12, string $hash_algo = null):string
    {
        do {
            $id = Str::random($length);
            $maybe_hashed = $hash_algo ? hash($hash_algo, $id) : $id;
        } while (self::where([ $column => $maybe_hashed ])->count());

        return $id;
    }
}
