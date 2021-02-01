<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasUniqueStringMaker
{
    /**
     * @param string $column
     * @param int    $length
     * 
     * @return string
     */
    static public function makeUniqueString(string $column, int $length=12)
    {
        $where = self::class . "::where";

        do {
            $id = Str::random($length);
        } while (call_user_func($where, [ $column => $id ])->count());

        return $id;
    }
}
