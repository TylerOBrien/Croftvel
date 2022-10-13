<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasUniqueMaker
{
    /**
     * Generate a new integer value that is guaranteed to be a unique entry in storage.
     *
     * @param  string  $column  The name of the column for the code.
     * @param  int  $digits  The number of digits in the code.
     * @param  string  $hash_algo  The name of the hashing algorithm to use.
     *
     * @return int
     */
    static public function makeUniqueInt(string $column, int $digits = 12, string $hash_algo = null) : int
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
     * Generate a new string value that is guaranteed to be a unique entry in storage.
     *
     * @param  string  $column  The name of the column for the code.
     * @param  int  $length  The number of characters in the code.
     * @param  string  $hash_algo  The name of the hashing algorithm to use.
     *
     * @return string
     */
    static public function makeUniqueString(string $column, int $length = 12, string $hash_algo = null) : string
    {
        do {
            $id = Str::random($length);
            $maybe_hashed = $hash_algo ? hash($hash_algo, $id) : $id;
        } while (self::where([ $column => $maybe_hashed ])->count());

        return $id;
    }
}
