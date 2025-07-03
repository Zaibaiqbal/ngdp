<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    public function getAllSdgs()
    {
        return Sdg::all();

    }
    
}
