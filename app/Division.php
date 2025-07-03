<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    public function getDivisionByProvinceId($id)
    {
        return Division::where('province_id',$id)->get();
    }
    public function getAllDivisions()
    {
        return Division::get();
    }
}
