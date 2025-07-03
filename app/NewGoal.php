<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewGoal extends Model
{
    public function getAllNewGoals()
    {
        return NewGoal::all();

    }
}
