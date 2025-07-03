<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewIndicator extends Model
{

    public function getNewIndicatorByTargetNo($target_no)
{
    return NewIndicator::where('target_name',$target_no)->get();
}

}
