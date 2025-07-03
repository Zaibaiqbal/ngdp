<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBeijing extends Model
{
    public function getAllNewBeijings()
    {
        return NewBeijing::all();

    }
}
