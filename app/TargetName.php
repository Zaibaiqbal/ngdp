<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetName extends Model
{

  public function targetname()
  {
    return $this->belongsTo(Target::class,'target_id')->withDefault();
  }

}
