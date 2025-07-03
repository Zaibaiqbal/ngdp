<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Indicator extends Model
{
  public function getIndicatorCount()
  {
 
  return Indicator::count();
  }

  public function getIndicatorById($id)
  {
      return  Indicator::where('id',$id)->first();
  }

  public function getIndicatorBySubTheme($id,$depiction,$theme_id)
  {
    

      return Indicator::where('sub_theme_id',$id)->whereIn('indicators.data_depiction',$depiction)->get();
  }
  public function getNationalLevelIndicator($id){

    return MainIndicator::where('indicator_id',$id)->where('survey_level',"National")
    ->where("residence","")->where("age_group","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->where('sex', "")->first();


  }
  public function getIndicatorCountByThemeId($theme_id){

   return Indicator::join('sub_themes','sub_themes.id','=','indicators.sub_theme_id')
        ->where('sub_themes.theme_id',$theme_id)
        ->count();

  }

  public function getLandingPageIndicatorList($theme_id){

    return Indicator::join('sub_themes as st','st.id','=','indicators.sub_theme_id')
    ->where('st.theme_id',$theme_id)
    ->whereIn('indicators.data_depiction',['Bar Chart','Pie Chart'])
    ->select('indicators.id','indicators.data_requirement','indicators.sub_theme_id','st.theme_id','indicators.data_depiction')
    ->orderBy('indicators.data_order' , 'ASC')->get();
    
  }
  public function getEconomicLandingPageIndicatorList($theme_id){

    return Indicator::join('sub_themes as st','st.id','=','indicators.sub_theme_id')
    ->where('st.theme_id',$theme_id)
    ->where('indicators.data_depiction','Bar Chart')
    ->select('indicators.id','indicators.data_requirement','indicators.sub_theme_id','st.theme_id')
    ->get();
    
  }
  

  public function getLandingPageMapIndicator($theme_id){

    return Indicator::join('sub_themes as st','st.id','=','indicators.sub_theme_id')
    ->join('main_indicators as mi','indicators.id','=','mi.indicator_id')
    ->where('st.theme_id',$theme_id)
    ->where('indicators.data_depiction','Map')
    ->where('survey_level',"National")
    ->select('indicators.id','indicators.data_requirement','indicators.sub_theme_id','st.theme_id','mi.current_year','mi.data_source_name')
    ->first();
    
  }

  public function getIndicatorInfoByIndicatorId($id)
  {

    return MainIndicator::where('indicator_id' , $id)->get();
  }



  public function search_indicator($search)
  {
    return Indicator::where('data_requirement','iLIKE','%'.$search."%")->get();
  }

  public function storeIndicator($object)
  {
      return DB::transaction(function () use ($object)  {

          $indicator            =  new Indicator;

          $indicator->sub_theme_id = $object['sub_theme'];
          
          if(isset($object['beijing_id']))
          {
            $indicator->beijing_id      = $object['beijing_id'];

          }
          $indicator->data_requirement = $object['data_requirement'];

          $indicator->save();

          $qualitative = new Qualitative;
          $curr_qualitative = $qualitative->storeQualtitativeInfo($object,$indicator->id); 

          $regsdg = new RegSdg;
          $curr_regsdg = $regsdg->storeRegSdg($object,$indicator->id); 
          
          return with($indicator);
      });
  }

 public function updateRequirement($object)
  {
      return \DB::transaction(function () use ($object) {

      $indicator = Indicator::find($object['requirement']);

      if (isset($indicator->id))
      {
          $indicator->sub_theme_id = $object['sub_theme'];
          $indicator->type         = $object['type'];

          if($indicator->type == "Qualitative")
          {
              $indicator->data_requirement = $object['data_requirement'];

              $indicator->constitutional_and_legal_provisions = $object['constitutional_and_legal_provisions'];

              $indicator->policy_issues_and_institutional_arrangements = $object['policy_issues_and_institutional_arrangements'];

              $indicator->constitutional_and_legal_provisions = $object['constitutional_and_legal_provisions'];

              $indicator->programmer= $object['programmer'];
          }
          else if($indicator->type == "Quantitative")
          {
              $indicator->sdgs       = $object['sdgs'];
              $indicator->beijeing   = $object['beijeing'];
              $indicator->cedaw      = $object['cedaw'];
          }

          // $requirement->remarks    = $object['remarks'];

          $indicator->update();
      }

      return with($indicator);

  });
}

public function removeIndicator($id)
{
   return \DB::transaction(function () use ($id)
   {
        $flag = false;

        $indicator = Indicator::find($id);

        if (isset($indicator->id))
        {
            $indicator->delete();

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

    public function mainindicators()
    {
    	return $this->hasMany(MainIndicator::class,'indicator_id');
    }

    public function qualitative()
    {
    	return $this->hasOne(Qualitative::class,'requirement_id')->withDefault();
    }

    public function qualitativemany($id)
    {
      return Qualitative::where('requirement_id' , $id)->get();
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
      return RegSdg::where('requirement_id',$id)->get();
    }
}
