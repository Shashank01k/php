<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   
    /**
     * Summary of getDetailsByCountryId
     * @param mixed $countryId
     * @return \Illuminate\Database\Eloquent\Collection<int, State>|\Illuminate\Support\Collection<int, \stdClass>
     */
    public static function getDetailsByCountryId(?int $countryId = null) : ?Collection
    {
        return self::where("country_id", $countryId)
            ->get();
    }
}
