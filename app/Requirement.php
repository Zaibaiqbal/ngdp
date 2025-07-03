<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Requirement extends Model
{
  public function getRequirementCount()
  {
 
  return Requirement::count();
  }

  public function getRequirementById($id)
  {
      return  Requirement::where('id',$id)->first();
  }

  public function getRequirementCountByThemeId($theme_id){

   return Requirement::join('sub_themes','sub_themes.id','=','requirements.sub_theme_id')
        ->where('sub_themes.theme_id',$theme_id)
        ->count();

  }

  public function search_indicator($search)
  {
    return Requirement::where('data_requirement','iLIKE','%'.$search."%")->get();
  }

  public function storeIndicator($object)
  {
      return DB::transaction(function () use ($object)  {

          $requirement            =  new Requirement;

          $requirement->sub_theme_id = $object['sub_theme'];
          $requirement->beijing_id      = $object['beijing_id'];
          $requirement->data_requirement = $object['data_requirement'];

          $requirement->save();

          $qualitative = new Qualitative;
          $curr_qualitative = $qualitative->storeQualtitativeInfo($object,$requirement->id); 

          $regsdg = new RegSdg;
          $curr_regsdg = $regsdg->storeRegSdg($object,$requirement->id); 
          
          return with($requirement);
      });
  }

 public function updateRequirement($object)
  {
      return \DB::transaction(function () use ($object) {

      $requirement = Requirement::find($object['requirement']);

      if (isset($requirement->id))
      {
          $requirement->sub_theme_id = $object['sub_theme'];
          $requirement->type         = $object['type'];

          if($requirement->type == "Qualitative")
          {
              $requirement->data_requirement = $object['data_requirement'];

              $requirement->constitutional_and_legal_provisions = $object['constitutional_and_legal_provisions'];

              $requirement->policy_issues_and_institutional_arrangements = $object['policy_issues_and_institutional_arrangements'];

              $requirement->constitutional_and_legal_provisions = $object['constitutional_and_legal_provisions'];

              $requirement->programmer= $object['programmer'];
          }
          else if($requirement->type == "Quantitative")
          {
              $requirement->sdgs       = $object['sdgs'];
              $requirement->beijeing   = $object['beijeing'];
              $requirement->cedaw      = $object['cedaw'];
          }

          // $requirement->remarks    = $object['remarks'];

          $requirement->update();
      }

      return with($requirement);

  });
}

public function removeRequirement($id)
{
   return \DB::transaction(function () use ($id)
   {
        $flag = false;

        $requirement = Requirement::find($id);

        if (isset($requirement->id))
        {
            $requirement->delete();

            $flag = true;
        }

        return with($flag);

   });

}
    public function subTheme()
    {
    	return $this->belongsTo(SubTheme::class,'sub_theme_id')->with(['theme'])->withDefault();
    }

    public function information()
    {
    	return $this->belongsTo(Information::class,'requirement_id')->withDefault();
    }

    public function qualitative()
    {
    	return $this->hasOne(Qualitative::class,'requirement_id')->withDefault();
    }

    public function qualitativemany($id)
    {
      return Qualitative::where('requirement_id' , $id)->get();
    	// return $this->hasOne(Qualitative::class,'requirement_id')->withDefault();
    }

    public function sdg()
    {
    	return $this->belongsTo(Sdg::class,'sdg_id')->withDefault();
    }
    public function beijing()
    {
    	return $this->belongsTo(NewBeijing::class,'beijing_id')->withDefault();
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

    public function getregsdg($id)
    {
      $target = RegSdg::where('requirement_id',$id)->get();
    	return $target;
    }
}
