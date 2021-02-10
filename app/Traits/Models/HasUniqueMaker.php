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
     * 
     * @return string
     */
    static public function makeUniqueString(string $column, int $length=12):string
    {
        $model = self::class;

        do {
            $id = Str::random($length);
        } while ($model::where([ $column => $id ])->count());

        return $id;
    }
}
