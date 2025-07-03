<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewTarget extends Model
{
    public function getNewTargetById($id)
    {
        return NewTarget::where('id',$id)->first();

    }

public function getTargetByGoalId($goal_id)
{
    return NewTarget::where('goal_number_id',$goal_id)->get();
}

}
