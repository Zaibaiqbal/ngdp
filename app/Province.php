<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    public function getAllProvinces()
    {
        return Province::all();
    }
}
