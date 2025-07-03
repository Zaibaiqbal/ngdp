<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Goal;

class Target extends Model
{
  public function getTargetsBySdgId($sdg_id){

    return Target::where('sdg_id' , $sdg_id)->get();

  }

  public function goal($id)
  {
    
      $name = Goal::where('target' , $id)->first();
      return $name;
  }
}
