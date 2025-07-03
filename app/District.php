<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    public function getDistrictsByProvinceId($id)
    {
        return District::where('province_id',$id)->get();
    }

    public function getDistrictsByDivisionId($id)
    {
        return District::where('division_id',$id)->get();
    }

    public function getAllDistricts() {
        
        return District::get();

    }

}
