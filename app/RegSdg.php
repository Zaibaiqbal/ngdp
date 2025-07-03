<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class RegSdg extends Model
{

  public function storeRegSdg($object,$requirement_id)
  {
      return DB::transaction(function () use ($object,$requirement_id)  {

        foreach($object['sdg'] as $key=>$val)
        {
          $regsdg = new RegSdg;

            $regsdg->sdg_id      = decrypt($val);
            $regsdg->target_id      = decrypt($object['target'][$key]);
            $regsdg->new_indicator_id = decrypt($object['indicator'][$key]);
            $regsdg->requirement_id = $requirement_id;
            $regsdg->sub_theme_id = $object['sub_theme'];
            $regsdg->save();
          
          return with($regsdg);
        }
      });
  }

  public function newindicator()
  {
    return $this->belongsTo(NewIndicator::class,'new_indicator_id')->withDefault();
  }
  public function target($id)
  {
    $targetName = TargetName::where('requirement_id',$id)->get();
    return $targetName;
  }
  public function gettargets($id)
  {
    $targetName = NewTarget::where('id',$id)->first();
    return $targetName;
  }

  public function getgoals($id)
  {
    $target = NewTarget::where('id',$id)->first();
    $goal = NewGoal::where('goal_number',$target->goal_number_id)->first();
    return $goal;
  }

}
