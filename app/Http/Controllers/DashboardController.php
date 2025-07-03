<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ThemeRepository;
use App\Theme;
use App\SubTheme;
use App\Indicator;
use App\Information;
use App\ChildInformation;
use App\HeadSpecific;
use App\ChildSpecific;
use App\RegSdg;
use App\Qualitative;
use App\Sdg;
use App\NewGoal;
use App\NewTarget;
use App\NewIndicator;
use App\MainIndicator;
use App\NewBeijing;
use App\Target;
use App\Province;
use App\Division;
use App\District;
use Auth;
use Mail;
use App\User;
use App\TargetName;
use Response;
use Session;
use DB;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth', ['except' => 'reguser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home($id=null)
    {
      // dd("csd");
        $theme = new Theme;
        $sdg = new Sdg;
        $new_goal = new NewGoal;
        $new_beijing = new NewBeijing;
        $sub_theme = new SubTheme;
        $qualitative = new Qualitative;
        $indicator = new Indicator;
     
        // $theme_repo = new ThemeRepository($theme);
        $all_themes = $theme->getAllTheme();

        $themecount = $theme->getThemeCount();
        $subthemecount = $sub_theme->getSubThemeCount();
        $qualitativecount_policy= $qualitative->getDistinctPloicyNameCount();
        $qualitativecount_legal= $qualitative->getDistinctLegalNameCount();
        $qualitativecount = $qualitativecount_policy+$qualitativecount_legal;
        $quantitativecount = $indicator->getIndicatorCount();
        $sdg_list = $sdg->getAllSdgs();
        $new_goals_list = $new_goal->getAllNewGoals();
        $new_beijing_list = $new_beijing->getAllNewBeijings();

          return view('gender_statistics.home',
          [
              'themes'                => $all_themes,
              'themecount'            => $themecount,
              'subthemecount'         => $subthemecount,
              'qualitativecount'      => $qualitativecount,
              'quantitativecount'     => $quantitativecount,
              'sdgs'                  => $sdg_list,
              'new_goals'             =>$new_goals_list,
              'new_beijings'          =>$new_beijing_list,
              'id'                    =>$id,
          ]
          );
    }


    public function getdashboardcounts(Request $request)
    {

        $sub_theme = new SubTheme;
        $qualitative = new Qualitative;
        $indicator = new Indicator;

        $subthemecount = $sub_theme->getSubThemeByThemeIdCount($request->id);

        $qualitativecount_policy= $qualitative->getDistinctPolicyNameByThemeIdCount($request->id);

        $qualitativecount_legal= $qualitative->getDistinctLegalNameByThemeIdCount($request->id);

        $qualitativecount = $qualitativecount_policy+$qualitativecount_legal;

        $quantitativecount = $indicator->getIndicatorCountByThemeId($request->id);


                    return response()->JSON(
                    [
                        'subthemecount'  => $subthemecount,
                        'qualitativecount'  => $qualitativecount,
                        'quantitativecount'  => $quantitativecount,
                    ]
                    );
    }



    public function genderStatistics()
    {
        $theme = new Theme;
        $sdg = new Sdg;
        $new_goal = new NewGoal;
        $new_beijing = new NewBeijing;
        $sub_theme = new SubTheme;
        $qualitative = new Qualitative;
        $indicator = new Indicator;

        $all_themes = $theme->getAllTheme();


        $themecount = $theme->getThemeCount();
        $subthemecount = $sub_theme->getSubThemeCount();
        $qualitativecount_policy= $qualitative->getDistinctPloicyNameCount();
        $qualitativecount_legal= $qualitative->getDistinctLegalNameCount();
        $qualitativecount = $qualitativecount_policy+$qualitativecount_legal;
        $quantitativecount = $indicator->getIndicatorCount();
        $sdg_list = $sdg->getAllSdgs();
        $new_goals_list = $new_goal->getAllNewGoals();
        $new_beijing_list = $new_beijing->getAllNewBeijings();

                    return view('gender_statistics.dashboard',
                    [
                        'themes'         => $all_themes,
                        'themecount'     => $themecount,
                        'subthemecount'  => $subthemecount,
                        'qualitativecount'  => $qualitativecount,
                        'quantitativecount'  => $quantitativecount,
                        'sdgs' => $sdg_list,
                        'new_goals'=>$new_goals_list,
                        'new_beijings'=>$new_beijing_list,
                    ]
                    );
    }


    public function filterindicators(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $value = $request->value;
      $indicators = $indicator->getIndicatorById($id);
      $unit = '%';
      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
     
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
        $gender_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","");

        $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");

        $gender_info_survey_level= $info->where("residence","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level",$value);

      $gender_info_district = $info->where("residence","")->where("age_group","")->where("specific_name1","")
      ->where("specific_name2","")->where("specific_name3","")->where("survey_level","District");

      $gender_info_division= $info->where("residence","")->where("age_group","")->where("specific_name1","")
      ->where("specific_name2","")->where("specific_name3","")->where("survey_level","Division");

        $national_info = $main_info->where("survey_level",$value)->first();
        if($national_info == null)
        {
        $national_info = $gender_info->where("survey_level",$value)->first();
        }

        $provinces = $province->getAllProvinces();
        $pro_arry = [];
        $ii = 0;

        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;
          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();
          if($provincial_info_new == null)
          {
          $provincial_info_new = $gender_info_survey_level->where('province_id', $pp->id)->first();
          }
          if(isset($provincial_info_new->id))
          {
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
          }
          else{
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }

        $grapharr = [];
        $yy = 0;
        if(isset($national_info->id))
        {
          $grapharr[$yy]['province'] = $value;
          $grapharr[$yy]['current_value'] = $national_info->current_value;
          $cinfo = $gender_info_survey_level->where("sex","Male")->first();
          $cinfo_female = $gender_info_survey_level->where("sex","Female")->first();
          $cinfo_trans = $gender_info_survey_level->where("sex","Transgender")->first();
          if(isset($cinfo->current_value))
          {
          $grapharr[$yy]['male'] = $cinfo->current_value;
          }
          else{
            $grapharr[$yy]['male'] = 0;
          }
          if(isset($cinfo_female->current_value))
          {
          $grapharr[$yy]['female'] = $cinfo_female->current_value;
          }
          else{
            $grapharr[$yy]['female'] = 0;
          }
          if(isset($cinfo_trans->current_value))
          {
          $grapharr[$yy]['trans'] = $cinfo_trans->current_value;
          }
          else{
            $grapharr[$yy]['trans'] = 0;
          }
        $yy++;
        }

        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];
            $grapharr[$yy]['current_value'] = $aap['current_value'];
            $cinfo = $gender_info_survey_level->where('province_id', $aap['province_id'])->where("sex","Male")->first();
            $cinfo_female = $gender_info_survey_level->where('province_id', $aap['province_id'])->where("sex","Female")->first();
            $cinfo_trans = $gender_info_survey_level->where('province_id', $aap['province_id'])->where("sex","Transgender")->first();
            if(isset($cinfo->current_value))
            {
            $grapharr[$yy]['male'] = $cinfo->current_value;
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }
            if(isset($cinfo_female->current_value))
            {
            $grapharr[$yy]['female'] = $cinfo_female->current_value;
            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
            if(isset($cinfo_trans->current_value))
            {
            $grapharr[$yy]['trans'] = $cinfo_trans->current_value;
            }
            else{
              $grapharr[$yy]['trans'] = 0;
            }
          }
          $yy++;

        }

      }

      // ---------
      else{

        $resiset = 0;
        $gender_info = $info->where("sex","!=","")->where("residence","")->where("age_group","")->where("specific_name1","")->where("specific_name2","")->where("specific_name3","");

        if(sizeof($gender_info) > 0){
          $gender_info = $gender_info;
        }
        else{
          $gender_info = $info;

        }
            $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");
  
            $gender_info_survey_level =  $gender_info->where("survey_level",$value);


            $gender_info_survey_resi = $info->where("residence",'!=',"")->where("sex",'!=',"")->where("age_group","")->where("specific_name1","")
                        ->where("specific_name2","")->where("specific_name3","")->where("survey_level",$value);

            $gender_info_survey_resi = $info->where("age_group",'!=',"")->where("sex",'!=',"")->where("residence","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where("survey_level",$value);

            $gender_info_provincial_resi = $info->where("residence",'!=',"")->where("sex",'!=',"")->where("age_group","")->where("specific_name1","")
                        ->where("specific_name2","")->where("specific_name3","")->where("survey_level",$value);
              
            $chkarr = $request->arr;

        if(in_array(0,$chkarr))
        {
          if($gender_info_survey_resi->count() != 0)
          {
            $resiset = 1;
          }
          $national_info = $main_info->where("survey_level",$value)->first();

          if($national_info == null)
          {
            $national_info = $gender_info->where("survey_level",$value)->first();
          }

          if(isset($national_info->id))
          {
            $unit = $national_info->unit;
            
          }

        }
        else
        {
          $national_info = null;
        }

        $provinces = $province->getAllProvinces();
        $pro_arry = [];
        $ii = 0;
        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;

          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();

          if($provincial_info_new == null)
          {
          $provincial_info_new = $gender_info_survey_level->where('province_id', $pp->id)->first();

          }

          if(isset($provincial_info_new->id))
          {
            $unit = $provincial_info_new->unit;

            if(in_array($pp->id,$chkarr))
            {
              if($gender_info_provincial_resi->where('province_id', $pp->id)->count() != 0)
              {
                $resiset = 1;
              }
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['information_id'] = $provincial_info_new->id;
            }
            else
            {
              $pro_arry[$ii]['current_value'] = 0;
              $pro_arry[$ii]['information_id'] = 0;
            }
          }
          else
          {
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }
        $grapharr = [];
        $yy = 0;

        if(isset($national_info->id))
        {

          $grapharr[$yy]['province'] = $value;

          if(isset($main_info->id))
          {
            if($national_info->unit == "Number")
            {
              $grapharr[$yy]['current_value'] = str_replace(',', '', $main_info->current_value);
              
            }
            else{
              $grapharr[$yy]['current_value'] = $main_info->current_value;

            }
          $unit = $main_info->unit;
          
        }
        else{
          $grapharr[$yy]['current_value'] = 0;

        }
          $cinfo = $gender_info_survey_level->where("sex","Male")->first();
          $cinfo_female = $gender_info_survey_level->where("sex","Female")->first();
          $cinfo_trans = $gender_info_survey_level->where("sex","Transgender")->first();
          if(isset($cinfo->current_value))
          {
            if($cinfo->unit == "Number")
            {
              $grapharr[$yy]['male'] = str_replace(',', '', $cinfo->current_value);
              
            }
            else{
              $grapharr[$yy]['male'] = $cinfo->current_value;

            }
          $unit = $cinfo->unit;
          
        }
          else{
            $grapharr[$yy]['male'] = 0;
          }
          if(isset($cinfo_female->current_value))
          {
            if($cinfo_female->unit == "Number")
            {
              $grapharr[$yy]['female'] = str_replace(',', '', $cinfo_female->current_value);
              
            }
            else{
              $grapharr[$yy]['female'] = $cinfo_female->current_value;

            }
            $unit = $cinfo_female->unit;

          }
          else{
            $grapharr[$yy]['female'] = 0;
          }
          if(isset($cinfo_trans->current_value))
          {
            if($cinfo_trans->unit == "Number")
            {
              $grapharr[$yy]['trans'] = str_replace(',', '', $cinfo_trans->current_value);
              
            }
            else{
              $grapharr[$yy]['trans'] = $cinfo_trans->current_value;

            }
          
          $unit = $cinfo_trans->unit;

          }
          else{
            $grapharr[$yy]['trans'] = 0;
          }
        $yy++;

        }
        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];

            if(isset($app['current_value']))
            {
              if($unit == "Number")
              {
                $grapharr[$yy]['current_value'] = str_replace(',', '', $aap['current_value']);
              
              }
              else{
              $grapharr[$yy]['current_value'] = $aap['current_value'];

              }
            }
            else{
              $grapharr[$yy]['current_value'] = 0;

            }

            $cinfo = $gender_info_survey_level->where('province_id', $aap['province_id'])->where("sex","Male")->first();
            $cinfo_female = $gender_info_survey_level->where('province_id', $aap['province_id'])->where("sex","Female")->first();
            $cinfo_trans = $gender_info_survey_level->where('province_id', $aap['province_id'])->where("sex","Transgender")->first();

            if(isset($cinfo->current_value))
            {
              if( $cinfo->unit == "Number"){

                $grapharr[$yy]['male'] = str_replace(',', '', $cinfo->current_value);

              }
              else{
                $grapharr[$yy]['male'] = $cinfo->current_value;

              }
            $unit = $cinfo->unit;

            }
            else{
              $grapharr[$yy]['male'] = 0;
            }

            if(isset($cinfo_female->current_value))
            {
              if( $cinfo_female->unit == "Number"){

                $grapharr[$yy]['female'] = str_replace(',', '',  $cinfo_female->current_value);

              }
              else{
                $grapharr[$yy]['female'] = $cinfo_female->current_value;


              }
            $unit = $cinfo_female->unit;

            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
            if(isset($cinfo_trans->current_value))
            {
              if( $cinfo_trans->unit == "Number"){

                $grapharr[$yy]['trans'] = str_replace(',', '',  $cinfo_trans->current_value);

              }
              else{
                $grapharr[$yy]['trans'] = $cinfo_trans->current_value;
              }
           
            $unit = $cinfo_trans->unit;

            }
            else{
              $grapharr[$yy]['trans'] = 0;
            }

          }
          $yy++;

        }

        }
        if(sizeof($grapharr) == 1)
        {
          $yy++;
          $grapharr[$yy]['province'] = ".";
          $grapharr[$yy]['current_value'] = "0";
          $grapharr[$yy]['female'] = 0;
          $grapharr[$yy]['male'] = 0;
          $grapharr[$yy]['trans'] = 0;
        }
        $mycount = count($grapharr);
        $view = view('dashboard.graphview',
        [
            'pro_array'      =>$pro_arry,
            'national_info'  =>$national_info,
            'grapharr'       => $grapharr,
            'resiset'        => $resiset,
            'unit'           => $unit
        ])->render();


        return response()->JSON(['view'=>$view,'mycount'=>$mycount]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }


    public function filterindicatorsresi(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $value = $request->value;
      $indicators = $indicator->getIndicatorById($id);

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
 
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }


        if($request->chk == 0)
        {

        $gender_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","");

        $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");


       $gender_info_national = $info->where("sex","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level","National");

       $gender_info_provincial = $info->where("sex","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level","Province");


        $national_info = $main_info->where("survey_level","National")->first();
        if($national_info == null)
        {
        $national_info = $gender_info->where("survey_level","National")->first();
        }

        $provinces = $province->getAllProvinces();

        $pro_arry = [];
        $ii = 0;
        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;
          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();
          if($provincial_info_new == null)
          {
          $provincial_info_new = $gender_info_provincial->where('province_id', $pp->id)->first();
          }
          if(isset($provincial_info_new->id))
          {
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
          }
          else{
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }

        $grapharr = [];
        $yy = 0;
        if(isset($national_info->id))
        {
          $grapharr[$yy]['province'] = "National";
          $grapharr[$yy]['current_value'] = $national_info->current_value;
          $cinfo = $gender_info_national->where("residence","Urban")->first();
          $cinfo_female = $gender_info_national->where("residence","Rural")->first();
          if(isset($cinfo->current_value))
          {
          $grapharr[$yy]['male'] = $cinfo->current_value;
          }
          else{
            $grapharr[$yy]['male'] = 0;
          }
          if(isset($cinfo_female->current_value))
          {
          $grapharr[$yy]['female'] = $cinfo_female->current_value;
          }
          else{
            $grapharr[$yy]['female'] = 0;
          }
        $yy++;
        }

        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];
            $grapharr[$yy]['current_value'] = $aap['current_value'];
            $cinfo = $gender_info_provincial->where('province_id', $aap['province_id'])->where("residence","Urban")->first();
            $cinfo_female = $gender_info_provincial->where('province_id', $aap['province_id'])->where("residence","Rural")->first();
            if(isset($cinfo->current_value))
            {
            $grapharr[$yy]['male'] = $cinfo->current_value;
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }
            if(isset($cinfo_female->current_value))
            {
            $grapharr[$yy]['female'] = $cinfo_female->current_value;
            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
          }
          $yy++;

        }

      }
        // ---------
      else{

     
        $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");

     
        $resi_info = $info->where("residence" , '!=' , "")->where("survey_level",$value);

        $chkarr = $request->arr;
        $unit = $info->pluck('unit')->unique('unit')->toArray();

        if(in_array(0,$chkarr) && $value == "National")
        {
          $national_info = $main_info->where("survey_level","National")->first();

          if($national_info == null)
          {
          $national_info = $resi_info->where("survey_level","National")->first();
          }

        }
        elseif(in_array(0,$chkarr) && $value == "Federal"){

          $national_info = $main_info->where("survey_level","Federal")->first();

          if($national_info == null)
          {
          $national_info = $resi_info->where("survey_level","Federal")->first();
          }

        }
        else
        {
          $national_info = null;
        }

        $grapharr = [];
        $yy = 0;
        if(isset($national_info->id))
        {
          $grapharr[$yy]['province'] = $value;

          if(isset($main_info->id))
          {
            if($main_info->unit == "Number")
            {
              $grapharr[$yy]['current_value'] = str_replace(',', '', $main_info->current_value);
              
            }
            else{
              $grapharr[$yy]['current_value'] = $main_info->current_value;

            }
          }
          else{
            $grapharr[$yy]['current_value'] = 0;

          }
    
            
            $cinfo = $resi_info->where("residence","Urban")->first();
            $cinfo_female = $resi_info->where("residence","Rural")->first();

            if(isset($cinfo->current_value))
            {
              if($cinfo->unit == "Number")
              {
                $grapharr[$yy]['male'] = str_replace(',', '', $cinfo->current_value);
                
              }
              else{
                $grapharr[$yy]['male'] = $cinfo->current_value;

              }
            
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }

            if(isset($cinfo_female->current_value))
            {

            if($cinfo_female->unit == "Number")
              {
                $grapharr[$yy]['female'] = str_replace(',', '', $cinfo_female->current_value);
                
              }
              else{
                $grapharr[$yy]['female'] = $cinfo_female->current_value;

              }

            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
          $yy++;
        }
        $provinces = $province->getAllProvinces();

        $pro_arry = [];
        $ii = 0;
        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;
          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();

          if($provincial_info_new == null)
          {
          $provincial_info_new = $resi_info->where('province_id', $pp->id)->first();
        
          }

          if(isset($provincial_info_new->id))
          {

            if(in_array($pp->id,$chkarr))
            {
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['information_id'] = $provincial_info_new->id;
            }
            else
            {
              $pro_arry[$ii]['current_value'] = 0;
              $pro_arry[$ii]['information_id'] = 0;
            }
          }
          else
          {
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }
        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];
          
              if($unit[0] == "Number")
              {
                $grapharr[$yy]['current_value'] = str_replace(',', '', $aap['current_value']);
              
              }
              else{
              $grapharr[$yy]['current_value'] = $aap['current_value'];

              }

            $cinfo = $resi_info->where('province_id', $aap['province_id'])->where("residence","Urban")->first();

            $cinfo_female = $resi_info->where('province_id', $aap['province_id'])->where("residence","Rural")->first();

            if(isset($cinfo->current_value))
            {
              if($unit[0] == "Number")
              {
                $grapharr[$yy]['male'] = str_replace(',', '', $cinfo->current_value);

              }
              else{
                $grapharr[$yy]['male'] = $cinfo->current_value;

              }
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }

            if(isset($cinfo_female->current_value))
            {
              if($unit[0] == "Number")
              {
                $grapharr[$yy]['female'] = str_replace(',', '', $cinfo_female->current_value);

              }
              else{
                $grapharr[$yy]['female'] = $cinfo_female->current_value;

              }
            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
          }
          $yy++;

        }


      }
        if(sizeof($grapharr) == 1)
        {$yy++;
          $grapharr[$yy]['province'] = ".";
          $grapharr[$yy]['current_value'] = "0";
          $grapharr[$yy]['female'] = 0;
          $grapharr[$yy]['male'] = 0;
        }
        $mycount = count($grapharr);
        $view = view('dashboard.graphviewresi',
        [
            'pro_array'       =>$pro_arry,
            'national_info'   =>$national_info,
            'grapharr'        => $grapharr,
            'unit'            => $unit[0]
        ])->render();

        return response()->JSON(['view'=>$view,'mycount'=>$mycount]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function filterindicatorsspecific1(Request $request)
    {
      $id = decrypt($request->indicator_id);
      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;
      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
       
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }

        if($request->chk == 0)
        {

        $specific_name1_info = $info->where("residence","")->where("age_group","")->where("sex","")
                          ->where("specific_name2","")->where("specific_name3","");

        $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");

      $survey_level_info = $info->where("sex","")->where("age_group","")->where("specific_name1","")
      ->where("specific_name2","")->where("specific_name3","")->where("survey_level",$value);



        $national_info = $main_info->where("survey_level",$value)->first();
        if($national_info == null)
        {
        $national_info = $specific_name1_info->where("survey_level",$value)->first();
        }

        $provinces = $province->getAllProvinces();

        $pro_arry = [];
        $ii = 0;
        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;
          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();
          if($provincial_info_new == null)
          {
          $provincial_info_new = $survey_level_info->where('province_id', $pp->id)->first();
          }
          if(isset($provincial_info_new->id))
          {
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
          }
          else{
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }

        $grapharr = [];
        $yy = 0;
        if(isset($national_info->id))
        {
          $grapharr[$yy]['province'] = $value;
          $grapharr[$yy]['current_value'] = $national_info->current_value;
          $cinfo = $survey_level_info->where("residence","Urban")->first();
          $cinfo_female = $survey_level_info->where("residence","Rural")->first();
          if(isset($cinfo->current_value))
          {
          $grapharr[$yy]['male'] = $cinfo->current_value;
          }
          else{
            $grapharr[$yy]['male'] = 0;
          }
          if(isset($cinfo_female->current_value))
          {
          $grapharr[$yy]['female'] = $cinfo_female->current_value;
          }
          else{
            $grapharr[$yy]['female'] = 0;
          }
        $yy++;
        }

        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];
            $grapharr[$yy]['current_value'] = $aap['current_value'];
            $cinfo = $survey_level_info->where('province_id', $aap['province_id'])->where("residence","Urban")->first();
            $cinfo_female = $survey_level_info->where('province_id', $aap['province_id'])->where("residence","Rural")->first();
            if(isset($cinfo->current_value))
            {
            $grapharr[$yy]['male'] = $cinfo->current_value;
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }
            if(isset($cinfo_female->current_value))
            {
            $grapharr[$yy]['female'] = $cinfo_female->current_value;
            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
          }
          $yy++;

        }

      }
      // ---------
      else{

        $my_info = $info->where('specific_name1','!=',"");
        $unit = $my_info->pluck('unit')->unique('unit');
        $chkarr = $request->arr;
        if(in_array(0,$chkarr) && $value == "National")
        {
          $speicific_info = $my_info->where("survey_level","National");
          $view = view('dashboard.graphviewspecific',
          [
              'label'           =>  $value,
              'speicific_info'  => $speicific_info,
              'unit'            => $unit[0]

          ])->render();
        }
        elseif(in_array(0,$chkarr) && $value == "Federal"){
          $speicific_info = $my_info->where("survey_level","Federal");
          $view = view('dashboard.graphviewspecific',
          [
              'label'           =>  $value,

              'speicific_info'  => $speicific_info,
              'unit'            => $unit[0]
          ])->render();


        }
        else
        {
          $speicific_info = $my_info->where("survey_level","Province");

          $speicific_info = $speicific_info->whereIn('province_id',$chkarr);
          $myArr = [];
          foreach($speicific_info as $oo)
          {

            if(!in_array($oo->specific_description1,$myArr))
            {
            array_push($myArr, $oo->specific_description1);
            }

          }
          $myArrpro = [];

          foreach($speicific_info as $ooo)
          {
            if(!in_array($oo->province_id,$myArrpro))
            {
            array_push($myArrpro, $ooo->province_id);
            }
          }

          $provinces = Province::whereIn('id',$chkarr)->get();
          $view = view('dashboard.graphviewspecificprovince',
          [

              'label'           =>  $value,
              'provinces'       =>  $provinces,
              'speicific_info'  =>  $speicific_info,
              'unit'            => $unit[0],
              'myArr'           => $myArr
          ])->render();
        }

      }


        $mycount = $speicific_info->count();
        // dd($speicific_info);


        return response()->JSON(['view'=>$view,'mycount'=>$mycount]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }




    public function filterindicatorsspecific2(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);

        $info = $info->where('nature' , $request->type);
        
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }

        if($request->chk == 0)
        {

        $gender_info = $info->where("residence","")->where("age_group","")->where("sex","")
                          ->where("specific_name1","")->where("specific_name3","");

        $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");


       $gender_info_national = $info->where("sex","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level","National");

       $gender_info_provincial = $info->where("sex","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level","Province");


        $national_info = $main_info->where("survey_level","National")->first();
        if($national_info == null)
        {
        $national_info = $gender_info->where("survey_level","National")->first();
        }

        $provinces = $province->getAllProvinces();

        $pro_arry = [];
        $ii = 0;
        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;
          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();
          if($provincial_info_new == null)
          {
          $provincial_info_new = $gender_info_provincial->where('province_id', $pp->id)->first();
          }
          if(isset($provincial_info_new->id))
          {
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
          }
          else{
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }

        $grapharr = [];
        $yy = 0;
        if(isset($national_info->id))
        {
          $grapharr[$yy]['province'] = "National";
          $grapharr[$yy]['current_value'] = $national_info->current_value;
          $cinfo = $gender_info_national->where("residence","Urban")->first();
          $cinfo_female = $gender_info_national->where("residence","Rural")->first();
          if(isset($cinfo->current_value))
          {
          $grapharr[$yy]['male'] = $cinfo->current_value;
          }
          else{
            $grapharr[$yy]['male'] = 0;
          }
          if(isset($cinfo_female->current_value))
          {
          $grapharr[$yy]['female'] = $cinfo_female->current_value;
          }
          else{
            $grapharr[$yy]['female'] = 0;
          }
        $yy++;
        }

        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];
            $grapharr[$yy]['current_value'] = $aap['current_value'];
            $cinfo = $gender_info_provincial->where('province_id', $aap['province_id'])->where("residence","Urban")->first();
            $cinfo_female = $gender_info_provincial->where('province_id', $aap['province_id'])->where("residence","Rural")->first();
            if(isset($cinfo->current_value))
            {
            $grapharr[$yy]['male'] = $cinfo->current_value;
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }
            if(isset($cinfo_female->current_value))
            {
            $grapharr[$yy]['female'] = $cinfo_female->current_value;
            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
          }
          $yy++;

        }

      }
      else{
            $gender_info = $info->where("specific_name2","!=","");
            $unit = $gender_info->pluck('unit')->unique('unit');
            $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where('sex', "");


            $gender_info_national = $info->where("sex","")->where("age_group","")->where("specific_name1","")
              ->where("specific_name2","")->where("specific_name3","")->where("survey_level","National");

            $gender_info_provincial = $info->where("sex","")->where("age_group","")->where("specific_name1","")
              ->where("specific_name2","")->where("specific_name3","")->where("survey_level","Province");


            $national_info = $main_info->where("survey_level",$value)->first();
            if($national_info == null)
            {
            $national_info = $gender_info->where("survey_level",$value)->first();
            }
       
            $chkarr = $request->arr;
            if(in_array(0,$chkarr))
            {

              $specific_info_current = $national_info->current_value;
              $speicific_info = $gender_info->where("survey_level",$value);
              $view = view('dashboard.graphviewspecific2',
              [
                  'speicific_info'          =>       $speicific_info,
                  'value'                   =>       $value,
                  'specific_info_current'   =>       $specific_info_current,
                  'unit'                    => $unit[0],
              ])->render();
            }
            else
            {
              $speicific_info = $gender_info->where("survey_level","Province");

              $speicific_info = $speicific_info->whereIn('province_id',$chkarr)->sortBy("province_id");

              $unique_dissagregation = $speicific_info->groupby('specific_description2','province_id');
              $myArr = $unique_dissagregation;
          
              $myArrpro = $speicific_info->pluck('province_id')->unique()->toArray();
              
              $provinces = Province::whereIn('id',$myArrpro)->get();

              $view = view('dashboard.graphviewspecificprovince2',
              [
                  'provinces'         =>$provinces,
                  'myArrpro'          =>$myArrpro,
                  'speicific_info'    =>$speicific_info,
                  'myArr'             => $myArr,
                  'unit'              => $unit[0],
              ])->render();
            }

      }


        $mycount = $speicific_info->count();
        // dd($speicific_info);


        return response()->JSON(['view'=>$view,'mycount'=>$mycount]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }



    public function filterindicatorsspecific3(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
       
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {

        $gender_info = $info->where("residence","")->where("age_group","")->where("sex","")
                          ->where("specific_name2","")->where("specific_name3","");

        $main_info = $info->where("residence","")->where("age_group","")->where("specific_name1","")
                          ->where("specific_name2","")->where("specific_name3","")->where('sex', "");


       $gender_info_national = $info->where("sex","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level","National");

       $gender_info_provincial = $info->where("sex","")->where("age_group","")->where("specific_name1","")
                    ->where("specific_name2","")->where("specific_name3","")->where("survey_level","Province");


        $national_info = $main_info->where("survey_level","National")->first();
        if($national_info == null)
        {
        $national_info = $gender_info->where("survey_level","National")->first();
        }

        $provinces = $province->getAllProvinces();

        $pro_arry = [];
        $ii = 0;
        foreach($provinces as $pp)
        {
          $pro_arry[$ii]['province'] = $pp->title;
          $pro_arry[$ii]['province_id'] = $pp->id;
          $provincial_info_new = $main_info->where('province_id', $pp->id)->first();
          if($provincial_info_new == null)
          {
          $provincial_info_new = $gender_info_provincial->where('province_id', $pp->id)->first();
          }
          if(isset($provincial_info_new->id))
          {
            $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
            $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
          }
          else{
            $pro_arry[$ii]['current_value'] = 0;
            $pro_arry[$ii]['information_id'] = 0;
          }
          $ii++;
        }

        $grapharr = [];
        $yy = 0;
        if(isset($national_info->id))
        {
          $grapharr[$yy]['province'] = "National";
          $grapharr[$yy]['current_value'] = $national_info->current_value;
          $cinfo = $gender_info_national->where("residence","Urban")->first();
          $cinfo_female = $gender_info_national->where("residence","Rural")->first();
          if(isset($cinfo->current_value))
          {
          $grapharr[$yy]['male'] = $cinfo->current_value;
          }
          else{
            $grapharr[$yy]['male'] = 0;
          }
          if(isset($cinfo_female->current_value))
          {
          $grapharr[$yy]['female'] = $cinfo_female->current_value;
          }
          else{
            $grapharr[$yy]['female'] = 0;
          }
        $yy++;
        }

        foreach($pro_arry as $aap)
        {
          if($aap['current_value'] != 0)
          {
            $grapharr[$yy]['province'] = $aap['province'];
            $grapharr[$yy]['current_value'] = $aap['current_value'];
            $cinfo = $gender_info_provincial->where('province_id', $aap['province_id'])->where("residence","Urban")->first();
            $cinfo_female = $gender_info_provincial->where('province_id', $aap['province_id'])->where("residence","Rural")->first();
            if(isset($cinfo->current_value))
            {
            $grapharr[$yy]['male'] = $cinfo->current_value;
            }
            else{
              $grapharr[$yy]['male'] = 0;
            }
            if(isset($cinfo_female->current_value))
            {
            $grapharr[$yy]['female'] = $cinfo_female->current_value;
            }
            else{
              $grapharr[$yy]['female'] = 0;
            }
          }
          $yy++;

        }

      }
      // ---------
      else{
        $my_info = $info->where("specific_name3",'!=',"");

        $unit = $my_info->pluck('unit')->unique('unit');
// dd($my_info);
        $chkarr = $request->arr;
        if(in_array(0,$chkarr))
        {
          $speicific_info = $my_info->where("survey_level","National");
          $view = view('dashboard.graphviewspecific3',
          [
              'speicific_info'  =>$speicific_info,
          ])->render();
        }
        else
        {
          $speicific_info = $my_info->where("survey_level","Province");
          $speicific_info = $speicific_info->whereIn('province_id',$chkarr)->sortBy("province_id");
          $myArr = [];

          foreach($speicific_info as $oo)
          {
            if(!in_array($oo->specific_description3,$myArr))
            {
            array_push($myArr, $oo->specific_description3);
            }
          }

          $myArrpro = [];
          foreach($speicific_info as $ooo)
          {
            if(!in_array($oo->province_id,$myArrpro))
            {
            array_push($myArrpro, $ooo->province_id);
            }
          }

          $provinces = Province::whereIn('id',$myArrpro)->get();

          $view = view('dashboard.graphviewspecificprovince3',
          [
              'provinces'         =>$provinces,
              'speicific_info'    =>$speicific_info,
              'myArr'             => $myArr,
              'unit'              =>   $unit[0]
          ])->render();
        }

      }


        $mycount = $speicific_info->count();
        // dd($speicific_info);


        return response()->JSON(['view'=>$view,'mycount'=>$mycount]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }
    public function filterindicatorsage(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $data = [];
      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;
      $view1 = [];

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);

        $info = $info->where('nature' , $request->type);
     
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
          $info = $info->where("age_group","!=","");
          $provinces = $province->getAllProvinces();

        }
      // ---------
      else{

        $provinces = $province->getAllProvinces();
        $chkarr = $request->arr;
        
        if(in_array(0,$chkarr) && $value == "National")
        {
        $info = $info->where("age_group","!=","")->where('survey_level', "National");
        }
        else if(in_array(0,$chkarr) && $value == "Federal")
        {
        $info = $info->where("age_group","!=","")->where('survey_level', "Federal");
        }
        else
        {
          $provinces = $province->getAllProvinces();

          $info = $info->where("age_group","!=","")->where('survey_level', "Province");
          $info = $info->whereIn('province_id', $chkarr);
        }

        }


        if($request->value == 'National')
        {
          $ageGroups = $info->groupBy('age_group')->map(function ($group) {
            return $group->pluck('current_value')->toArray(); // Assuming you want the current value
            });
        
            // Prepare data for the graph
            $data = [
                'age_groups' => $ageGroups->keys(), // The age groups
                'current_value' => $ageGroups->values(), // The percentage values for each age group
            ];
   
            // You would typically pass this data to a view or use it to generate the graph
            $view1 = view('dashboard.graphviewage',
            [
                'info'     => $info,
                'chkarr'  => $chkarr,
                'provinces' =>$provinces,
                'data'      =>  $data
            ])->render();
        }

        $view = view('dashboard.tableviewage',
        [
            'info'     => $info,
            'chkarr'  => $chkarr,
            'provinces' =>$provinces,
            'data'      =>  $data
        ])->render();

        return response()->JSON(['view'=>$view , 'view1' => $view1]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }
    
    

    public function filterindicatorsspecific2table(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
       
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
        $info = $info->where("specific_name1","!=","");
        $provinces = $province->getAllProvinces();

        }
      // ---------
      else{
        $provinces = $province->getAllProvinces();

        $chkarr = $request->arr;

        if(in_array(0,$chkarr) && $value == "National")
        {
        $info = $info->where("specific_name1","!=","" )->where('survey_level', $value);
        }
        elseif(in_array(0,$chkarr) && $value == "Federal" )
        {
        $info = $info->where("specific_name1","!=","" )->where('survey_level', $value);

        }
        else
        {
          $provinces = $province->getAllProvinces();

          $info = $info->where("specific_name1","!=","")->where('survey_level', "Province");
          $info = $info->whereIn('province_id', $chkarr);
        }

        }

        $view = view('dashboard.graphviewresiadva',
        [
            'info'     => $info,
            'chkarr'  => $chkarr,
            'provinces' =>$provinces
        ])->render();

        return response()->JSON(['view'=>$view]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function filterindicatorsspecificadva(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
     
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
        $info = $info->where("specific_name2","!=","");
        $provinces = $province->getAllProvinces();

        }
      // ---------
      else{
        $provinces = $province->getAllProvinces();

        $chkarr = $request->arr;

        if(in_array(0,$chkarr) && $value == "National")
        {
        $info = $info->where("specific_name2","!=","" )->where('survey_level', $value);
        }
        elseif(in_array(0,$chkarr) && $value == "Federal" )
        {
        $info = $info->where("specific_name2","!=","" )->where('survey_level', $value);

        }
        else
        {
          $provinces = $province->getAllProvinces();

          $info = $info->where("specific_name2","!=","")->where('survey_level', "Province");
          $info = $info->whereIn('province_id', $chkarr);
        }

        }

        $view = view('dashboard.graphviewresiadva',
        [
            'info'     => $info,
            'chkarr'  => $chkarr,
            'provinces' =>$provinces
        ])->render();

        return response()->JSON(['view'=>$view]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function filterindicatorsspecific3table(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
        
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
        $info = $info->where("specific_name3","!=","");
        $provinces = $province->getAllProvinces();

        }
      // ---------
      else{
        $provinces = $province->getAllProvinces();

        $chkarr = $request->arr;

        if(in_array(0,$chkarr) && $value == "National")
        {
        $info = $info->where("specific_name3","!=","" )->where('survey_level', $value);
        }
        elseif(in_array(0,$chkarr) && $value == "Federal" )
        {
        $info = $info->where("specific_name3","!=","" )->where('survey_level', $value);

        }
        else
        {
          $provinces = $province->getAllProvinces();

          $info = $info->where("specific_name3","!=","")->where('survey_level', "Province");
          $info = $info->whereIn('province_id', $chkarr);
        }

        }

        $view = view('dashboard.graphviewresiadva',
        [
            'info'     => $info,
            'chkarr'  => $chkarr,
            'provinces' =>$provinces
        ])->render();

        return response()->JSON(['view'=>$view]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function filterindicatorsresiadva(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
     
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
        $info = $info->where("residence","!=","");
        $provinces = $province->getAllProvinces();

        }
      // ---------
      else{
        $provinces = $province->getAllProvinces();

        $chkarr = $request->arr;

        if(in_array(0,$chkarr) && $value == "National")
        {
        $info = $info->where("residence","!=","" )->where('survey_level', $value);
        }
        elseif(in_array(0,$chkarr) && $value == "Federal" )
        {
        $info = $info->where("residence","!=","" )->where('survey_level', $value);

        }
        else
        {
          $provinces = $province->getAllProvinces();

          $info = $info->where("residence","!=","")->where('survey_level', "Province");
          $info = $info->whereIn('province_id', $chkarr);
        }

        }

        $view = view('dashboard.graphviewresiadva',
        [
            'info'     => $info,
            'chkarr'  => $chkarr,
            'provinces' =>$provinces
        ])->render();

        return response()->JSON(['view'=>$view]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function filterindicatorsadva(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;
      
      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        $info = $info->where('nature' , $request->type);
       
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {

          $info = $info->where("sex","!=","");
          $provinces = $province->getAllProvinces();

        }
        // ---------
      else{
          $provinces = $province->getAllProvinces();

          $chkarr = $request->arr;
          if(in_array(0,$chkarr) && $value == "National")
          {
          $info = $info->where("sex","!=","")->where('survey_level', "National");
          }

          elseif(in_array(0,$chkarr) && $value == "Federal")
          {
          $info = $info->where("sex","!=","")->where('survey_level', "Federal");
          }

          else
          {

            $info = $info->where("sex","!=","")->where('survey_level', "Province");
            $info = $info->whereIn('province_id', $chkarr);
          }

        }

        $view = view('dashboard.graphviewsexadva',
        [
            'info'     => $info,
            'chkarr'  => $chkarr,
            'provinces' =>$provinces
        ])->render();

        return response()->JSON(['view'=>$view ]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }


    public function filterindicatorsadvaall(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $division = new Division;
      $district = new District;
      $indicators = $indicator->getIndicatorById($id);
      $value = $request->value;
      $view1 = [];

      if(isset($indicators->id))
      {

        $data = [];
        $survey_level = $request->value;

        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);

        $info = $info->where('nature' , $request->type);
     
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->chk == 0)
        {
        $info = $info;
        $chkarr = $request->arr;
        $provinces = $province->getAllProvinces();
        }

        elseif($request->chk == 2)
        {
          // division
          // dd($info);
      
          $provinces = $division->getAllDivisions();
          $pro_arry = [];
          $ii = 0;

          foreach($provinces as $pp)
          {
            $pro_arry[$ii]['division'] = $pp->title;
            $pro_arry[$ii]['division_id'] = $pp->id;
            $provincial_info_new = $info->where('division_id', $pp->id)->first();
          
            if(isset($provincial_info_new->id))
            {
              $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
              $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
            }
            else{
              $pro_arry[$ii]['current_value'] = 0;
              $pro_arry[$ii]['information_id'] = 0;
            }
            $ii++;
          }
          $grapharr = [];
          $yy = 0;
          foreach($pro_arry as $aap)
          {
            if($aap['current_value'] != 0)
            {
              $grapharr[$yy]['division'] = $aap['division'];
              $grapharr[$yy]['current_value'] = $aap['current_value'];
              
            }
            $yy++;
  
          }

          $info = $info->whereNotNull('division_id');
          $data['graph_info'] = $info;
          $unit_row      = $data['graph_info']->first();

          if(isset($unit_row->id))
          {
            $unit = $unit_row->unit;

          }
          else{
            $unit = '%';
          }


        }

        elseif($request->chk == 3)
        {
          // district

          $provinces = $district->getAllDistricts();
          $pro_arry = [];
          $ii = 0;

          foreach($provinces as $pp)
          {
            $pro_arry[$ii]['district'] = $pp->title;
            $pro_arry[$ii]['district_id'] = $pp->id;
            $provincial_info_new = $info->where('district_id', $pp->id)->first();
          
            if(isset($provincial_info_new->id))
            {
              $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
              $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
            }
            else{
              $pro_arry[$ii]['current_value'] = 0;
              $pro_arry[$ii]['information_id'] = 0;
            }
            $ii++;
          }
          $grapharr = [];
          $yy = 0;
          foreach($pro_arry as $aap)
          {
            if($aap['current_value'] != 0)
            {
              $grapharr[$yy]['district'] = $aap['district'];
              $grapharr[$yy]['current_value'] = $aap['current_value'];
              
            }
            $yy++;
  
          }


          $chkarr = $request->arr;
          $info = $info->where('district_id', "!=",null);
          $data['graph_info'] = $info->first();

          if(isset($data['graph_info']->id))
          {
            $unit = $data['graph_info']->unit;

          }
          else{
            $unit = '%';
          }


        }
      // ---------
      else{

        $provinces = $province->getAllProvinces();
        $chkarr = $request->arr;


        if(in_array(0,$chkarr) && $survey_level == "National")
        {
          $info = $info->where('survey_level', "National");
         
          $data['graph_info'] = $info->first();
          $unit      = $data['graph_info']->unit;

        }
        elseif(in_array(0,$chkarr) && $survey_level == "Federal"){

          $info = $info->where('survey_level', "Federal");
           $data['graph_info'] = $info->first();

          $unit      = $data['graph_info']->unit;


        }
        else
        {
          $provinces = $province->getAllProvinces();
          $pro_arry = [];
          $ii = 0;
  
          foreach($provinces as $pp)
          {
            $pro_arry[$ii]['province'] = $pp->title;
            $pro_arry[$ii]['province_id'] = $pp->id;
            $provincial_info_new = $info->where('province_id', $pp->id)->first();
          
            if(isset($provincial_info_new->id))
            {
              $pro_arry[$ii]['current_value'] = $provincial_info_new->current_value;
              $pro_arry[$ii]['indicator_id'] = $provincial_info_new->id;
            }
            else{
              $pro_arry[$ii]['current_value'] = 0;
              $pro_arry[$ii]['information_id'] = 0;
            }
            $ii++;
          }
          $grapharr = [];
          $yy = 0;
          foreach($pro_arry as $aap)
          {
            if($aap['current_value'] != 0)
            {
              $grapharr[$yy]['province'] = $aap['province'];
              $grapharr[$yy]['current_value'] = $aap['current_value'];
              
            }
            $yy++;
  
          }

          $info = $info->where('survey_level', "Province");
        
          $info = $info->whereIn('province_id', $chkarr);
        
           $data['graph_info'] = $info;
          $unit      = $data['graph_info']->first()->unit;


        }
      }
        $view = view('dashboard.graphviewsexadva',
        [
            'info'     => $info,
            // 'chkarr'  => $chkarr,
            'provinces' =>$provinces
        ])->render();


        if($survey_level == "Province")
        {
          $view1 = view('dashboard.graphviewnewpro',
          [
              'grapharr'          =>  $grapharr,
              'data1'             => $data,
              'info'              => $info,
              'chkarr'            => $chkarr,
              'provinces'         =>$provinces,
              'unit'              =>$unit,
              'survey_level'      =>$survey_level
  
          ])->render();
  
        }
        else if($survey_level == 'Division')
        {
          $view1 = view('dashboard.graphviewdivision',
          [
              'data1'             =>  $data,
              'grapharr'          =>  $grapharr,

              'info'              => $info,
              // 'chkarr'            => $chkarr,
              'provinces'         =>  $provinces,
              'unit'              =>  $unit,
  
          ])->render();
        }

        else if($survey_level == 'District')
        {
          $view1 = view('dashboard.graphviewdistrict',
          [
              'data1'             =>  $data,
              'grapharr'          =>  $grapharr,

              'info'              =>  $info,
              // 'chkarr'            => $chkarr,
              'provinces'         =>  $provinces,
              'unit'              =>  $unit,
  
          ])->render();
        }
        else if($survey_level != "District"){
          $view1 = view('dashboard.graphviewnew',
          [
              'data1'             => $data,
              'info'              => $info,
              // 'chkarr'            => $chkarr,
              'provinces'         =>  $provinces,
              'unit'              =>  $unit,
  
          ])->render();
        }
        return response()->JSON(['view'=>$view , 'view1'=>$view1 ]);
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function filterindicatorssearch(Request $request)
    {
      $id = decrypt($request->indicator_id);

      $indicator = new Indicator;
      $main_indicator = new MainIndicator;
      $province = new Province;
      $indicators = $indicator->getIndicatorById($id);

      if(isset($indicators->id))
      {
        $info = $main_indicator->getIndicatorInfoByIndicatorId($indicators->id);
        // $info = Information::where('requirement_id',$indicators->id)->get();
        
        if($request->data_source != "all")
        {
          $info = $info->where('data_source_name' , $request->data_source);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->year != "all")
        {
          $info = $info->where('current_year' , $request->year);
        }
        if($request->type != "all")
        {
          if($request->type == "national")
          {
            $info = $info->where('survey_level' , "National");
          }
          else
          {
          $info = $info->where('province_id' , $request->type);
          }
        }

        if($request->filtersex != "All")
        {
          $info = $info->where('sex' , $request->filtersex);
        }
        if($request->filterage != "All")
        {
          $info = $info->where('age_group' , $request->filterage);
        }
        if($request->filterresidence != "All")
        {
          $info = $info->where('residence' , $request->filterresidence);
        }

        if($request->filtername1 != "All" && isset($request->filtername1))
        {
          $getname = HeadSpecific::where('specific_title', $request->filtername1)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filtername2 != "All" && isset($request->filtername2))
        {
          $getname = HeadSpecific::where('specific_title', $request->filtername2)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filtername3 != "All" && isset($request->filtername3))
        {
          $getname = HeadSpecific::where('specific_title', $request->filtername3)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filtername4 != "All" && isset($request->filtername4))
        {
          $getname = HeadSpecific::where('specific_title', $request->filtername4)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filtername5 != "All" && isset($request->filtername5))
        {
          $getname = HeadSpecific::where('specific_title', $request->filtername5)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filterdescription1 != "All" && isset($request->filterdescription1))
        {
          $getname = HeadSpecific::where('specific_name', $request->filterdescription1)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filterdescription2 != "All" && isset($request->filterdescription2))
        {
          $getname = HeadSpecific::where('specific_name', $request->filterdescription2)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filterdescription3 != "All" && isset($request->filterdescription3))
        {
          $getname = HeadSpecific::where('specific_name', $request->filterdescription3)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filterdescription4 != "All" && isset($request->filterdescription4))
        {
          $getname = HeadSpecific::where('specific_name', $request->filterdescription4)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }
        if($request->filterdescription5 != "All" && isset($request->filterdescription5))
        {
          $getname = HeadSpecific::where('specific_name', $request->filterdescription5)->get();
          $getname = $getname->pluck('information_id')->toArray();
          $info = $info->whereIn('id' , $getname);
        }


        $view = "<option value='0'>Select Source</option>" ;
        foreach($info as $in)
        {
        $value = Crypt::encrypt($in->id);
        $name = $in->data_source_name;
        if($in->survey_level == "Provincial")
        {
        $pro = $in->province->title;
        }
        else{
        $pro = "National";
        }
        $year = $in->current_year;
        // $view.= '<option value="'.$value.'">'.$name.'-'.$pro.'-'.$year.'</option>';

        if($in->year_two == null && $in->year_one != null)
        {
          $view.= '<option value="'.$value.'">'.$name.'-'.$pro.'-'.$in->year_one.'</option>';
        }
        elseif($in->year_one == null && $in->year_two != null)
        {
          $view.= '<option value="'.$value.'">'.$name.'-'.$pro.'-'.$in->year_two.'</option>';
        }
        elseif($in->year_two != null && $in->year_one != null)
        {
          $view.= '<option value="'.$value.'">'.$name.'-'.$pro.'- ('.$in->year_two.'-'.$in->year_one.')</option>';
        }
        else{
          $view.= '<option value="'.$value.'">'.$name.'-'.$pro.'</option>';
        }

        }


        return $view;
      }
      else{
        // Session::flash('error', "Indicator not found");

      }

    }

    public function map()
    {
        return view('dashboard.map');
    }

  
    public function search_indicator(Request $request)
    {
      if($request->ajax())
      {
        $output="";
        $search = strtolower($request->search);
        $indicator = new Indicator;
        $indicators = $indicator->search_indicator($request->search);
        if($indicators->count() == 0)
        {
          $output.=
          '<li class="list-group-item"> No Data Found</li>';
        }
        if($indicators)
        {
        foreach ($indicators as $key => $indicators) {
          $myroute = route('indicators', Crypt::encrypt($indicators->id));
        $output.=
        '<li class="list-group-item"><a href="'.$myroute.'" target=_blank>'.$indicators->data_requirement.'</a></li>';
        }
        return Response($output);
      }
      }
    }

    public function getdivisions(Request $request)
    {
      if($request->ajax())
      {
        $output="";
        $id = $request->id;

        $division = new Division;
        $divisions = $division->getDivisionByProvinceId($id);
        $output.= '<option value="">Select Division</option>';
        foreach ($divisions as $division) {
        $value = $division->id;
        $output.= '<option value="'.$value.'">'.$division->title.'</option>';
        }
        }

        return Response($output);

      }
    public function getdistricts(Request $request)
    {
      if($request->ajax())
      {
        $output="";
        $id = $request->id;
        $district = new District;
        $districts = $district->getDistrictsByDivisionId($id);
        
        if($districts->count() == 0)
        {
          $output=0;
        }
        else{
          $output.= '<option value="">Select District</option>';
        foreach ($districts as $district) {
        $value = $district->id;
        $output.= '<option value="'.$value.'">'.$district->title.'</option>';
        }
        }
        return Response($output);
      }
    }

    public function gettargets(Request $request)
    {
      if($request->ajax())
      {
        $output="";
        $id = decrypt($request->id);
        $target = new Target;
        $targets = $target->getTargetsBySdgId($id);

        if($targets->count() == 0)
        {
          $output=0;
        }
        else{
        foreach ($targets as $key => $target) {
          $value = Crypt::encrypt($target->id);
          if(isset($target->goal($target->name)->id))
          {
            $tgoalname = $target->goal($target->name)->name;
          }
          else{
            $tgoalname = "";
          }
        $output.=
        '<option value="'.$value.'">'.$target->name.' ('.$tgoalname.') </option>';
        }
      }
        return Response($output);

      }
    }


    public function getindicatorsnew(Request $request)
    {
      if($request->ajax())
      {
        $output="";
        $id = decrypt($request->id);

        $target = new NewTarget;
        $indicator = new NewIndicator;

        $curr_target = $target->getNewTargetById($id);

        $indicators = $indicator->getNewIndicatorByTargetNo($curr_target->target_number);
        if($indicators->count() == 0)
        {
          $output=0;
        }
        else{
        foreach ($indicators as $key => $indicator) {
          $value = Crypt::encrypt($indicator->id);

        $output.=
        '<option value="'.$value.'">'.$indicator->indicator_number.' ('.$indicator->indicator_name.') </option>';
        }
      }
        return Response($output);

      }
    }
    public function gettargetsnew(Request $request)
    {
      if($request->ajax())
      {
        $output="";
        $id = decrypt($request->id);
        $target= new NewTarget;
        $targets = $target->getTargetByGoalId($id);
        if($targets->count() == 0)
        {
          $output=0;
        }
        else{
        foreach ($targets as $key => $target) {
          $value = Crypt::encrypt($target->id);

        $output.=
        '<option value="'.$value.'">'.$target->target_number.' ('.$target->target_name.') </option>';
        }
      }
        return Response($output);

      }
    }


    public function getsurveyyear(Request $request)
    {
      $data_source = $request->data_source;

      $id = decrypt($request->indicator_id);
      $main_indicator = new MainIndicator;
      $years = $main_indicator->getCurrentYearByIndicatorId($id,$data_source);
      // $view = "<option value='all'>Select Year</option>" ;
      $view = "" ;
      foreach($years as $y)
      {
        $view.= "<option value='$y->current_year'>$y->current_year</option>";
      }

      return $view;
    }

    public function myfiltercheck(Request $request)
    {
      $data_source = $request->data_source;

      $id = decrypt($request->indicator_id);
      $year = $request->year;

      $main_indicator = new MainIndicator;

      if($year == "all")
      {
        $national = $main_indicator->getIndicatorInfoBySurveyLevelCount($data_source,$id,["National"]);

        $province = $main_indicator->getIndicatorInfoBySurveyLevelCount($data_source,$id,["Province"]);

        $federal = $main_indicator->getIndicatorInfoBySurveyLevelCount($data_source,$id,["Federal"]);
        
        $division =  $main_indicator->getIndicatorCountByDivisionNotNull($id,$data_source);

        $district = $main_indicator->getIndicatorCountByDistrictNotNull($id,$data_source);

        $provinces =  $main_indicator->getIndicatorInfoByDataSource($id,$data_source);
       
        $syn = $main_indicator->getIndicatorInfoByNature($data_source,$id,["Syntax"]);

        $sec = $main_indicator->getIndicatorInfoByNature($data_source,$id,["Secondary"]);

      }
      else{
        $national = $main_indicator->getIndicatorCountBySurveyAndYear($data_source,$id,["National"],$request->year);

        $province = $main_indicator->getIndicatorCountBySurveyAndYear($data_source,$id,["Province"],$request->year);
        
        $federal = $main_indicator->getIndicatorCountBySurveyAndYear($data_source,$id,["Federal"],$request->year);

           
        $district = $main_indicator->getYearlyIndicatorCountByDistrictNotNull($data_source,$id,$request->year);

        $division = $main_indicator->getYearlyIndicatorCountByDivisionNotNull($data_source,$id,$request->year);



        $provinces = DB::table('main_indicators')
        ->join('provinces','provinces.id','=','main_indicators.province_id')
        ->where('main_indicators.data_source_name',$data_source)
        ->where('main_indicators.indicator_id',$id)
        ->where('main_indicators.current_year', $request->year)
        ->selectRaw('provinces.id')
        ->groupBy('provinces.id')->get();

        $syn = $main_indicator->getYearlyIndicatorCountByNature($data_source,$id,["Syntax"],$request->year);

        $sec = $main_indicator->getYearlyIndicatorCountByNature($data_source,$id,["Secondary"],$request->year);
  
      }

      $view = view('dashboard.myfilters',
      [
          'national'      =>$national,
          'province'  =>$province,
          'federal'  =>$federal,
          'division'  =>$division,
          'district'  =>$district,
          'provinces' => $provinces,
          'syn' => $syn,
          'sec' => $sec
          
      ])->render();

      return $view;
    }


    public function myfiltercheckthird(Request $request)
    {
      $data_source = $request->data_source;

      $id = decrypt($request->indicator_id);
      $valuee = $request->valuee;
      $main_indicator = new MainIndicator;
      if($valuee == "National")
      {
        if($request->year == "all")
        {

          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'sex');
          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'age_group');

          $syn = $main_indicator->getIndicatorCountBySurveyAndNature($data_source,$id,["National"],["Syntax"]);

          $sec = $main_indicator->getIndicatorCountBySurveyAndNature($data_source,$id,["National"],["Secondary"]);

      }
      else{

        $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'sex');

        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'residence');

        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'age_group');


        $syn = $main_indicator->getYearlyIndicatorCountBySurveyAndNature($data_source,$id,["National"],["Syntax"],$request->year);

        $sec = $main_indicator->getYearlyIndicatorCountBySurveyAndNature($data_source,$id,["National"],["Secondary"],$request->year);
      }

      }
      if($valuee == "Federal")
      {
        if($request->year == "all")
        {

          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Federal"],'sex');
          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Federal"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Federal"],'age_group');
          $syn = $main_indicator->getIndicatorCountBySurveyAndNature($data_source,$id,["Federal"],["Syntax"]);
          $sec = $main_indicator->getIndicatorCountBySurveyAndNature($data_source,$id,["Federal"],["Secondary"]);

      }
      else{
        $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Federal"],$request->year,'sex');
        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Federal"],$request->year,'residence');
        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Federal"],$request->year,'age_group');
        $syn = $main_indicator->getYearlyIndicatorCountBySurveyAndNature($data_source,$id,["Federal"],["Syntax"],$request->year);
        $sec = $main_indicator->getYearlyIndicatorCountBySurveyAndNature($data_source,$id,["Federal"],["Secondary"],$request->year);
      
      
      }

      }
      if($valuee == "Province"){
        if($request->year == "all")
        {
          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'sex');
          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'age_group');
    
          $syn = $main_indicator->getIndicatorCountBySurveyAndNature($data_source,$id,["Province"],["Syntax"]);
    
          $sec = $main_indicator->getIndicatorCountBySurveyAndNature($data_source,$id,["Province"],["Secondary"]);

        }
        else{
          $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'sex');

        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'residence');

        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'age_group');
  
          $syn = $main_indicator->getYearlyIndicatorCountBySurveyAndNature($data_source,$id,["Province"],["Syntax"],$request->year);
  
          $sec = $main_indicator->getYearlyIndicatorCountBySurveyAndNature($data_source,$id,["Province"],["Secondary"],$request->year);
        }


      }

      if($valuee == "Division"){
        if($request->year == "all")
        {
          $sex = $main_indicator->getIndicatorCountByDivisionSexNull($data_source,$id);

          $resi = $main_indicator->getIndicatorCountByDivisionResidenceNull($data_source,$id);
    
          $age = $main_indicator->getIndicatorCountByDivisionAgeNull($data_source,$id);
    
          $syn = $main_indicator->getIndicatorCountByNatureDivision($data_source,$id,["Syntax"]);
    
          $sec = $main_indicator->getIndicatorCountByNatureDivision($data_source,$id,["Secondary"]);

     
        }
        else{

          $sex = $main_indicator->getYearlyIndicatorCountByDivisionSexNull($data_source,$id,$request->year);

          $resi = $main_indicator->getYearlyIndicatorCountByDivisionResidenceNull($data_source,$id,$request->year);
    
          $age = $main_indicator->getYearlyIndicatorCountByDivisionAgeNull($data_source,$id,$request->year);
    
          $syn = $main_indicator->getYearlyIndicatorCountByNatureDivisionNull($data_source,$id,$request->year,["Syntax"]);
    
          $sec = $main_indicator->getYearlyIndicatorCountByNatureDivisionNull($data_source,$id,$request->year,["Secondary"]);

        }


      }
      if($valuee == "District"){
        if($request->year == "all")
        {

          $sex = $main_indicator->getIndicatorCountByDistrictSexNull($data_source,$id);

          $resi = $main_indicator->getIndicatorCountByDistrictResidenceNull($data_source,$id);
    
          $age = $main_indicator->getIndicatorCountByDistrictAgeNull($data_source,$id);
    
          $syn = $main_indicator->getIndicatorCountByNatureDistrict($data_source,$id,["Syntax"]);
    
          $sec = $main_indicator->getIndicatorCountByNatureDistrict($data_source,$id,["Secondary"]);

     
        }
        else{
          
          $sex = $main_indicator->getYearlyIndicatorCountByDistrictSexNull($data_source,$id,$request->year);

          $resi = $main_indicator->getYearlyIndicatorCountByDistrictResidenceNull($data_source,$id,$request->year);
    
          $age = $main_indicator->getYearlyIndicatorCountByDistrictAgeNull($data_source,$id,$request->year);
    
          $syn = $main_indicator->getYearlyIndicatorCountByNatureDistrictNull($data_source,$id,$request->year,["Syntax"]);
    
          $sec = $main_indicator->getYearlyIndicatorCountByNatureDistrictNull($data_source,$id,$request->year,["Secondary"]);
  
        }


      }


      $view = view('dashboard.myfiltersthird',
      [
          'syn'      =>$syn,
          'sec'  =>$sec,
      ])->render();

      return $view;
    }

    public function myfilterchecksecond(Request $request)
    {
      $data_source = $request->data_source;
      $id = decrypt($request->indicator_id);
      $valuee = $request->valuee;

      $main_indicator = new MainIndicator;
  
      if($valuee == "National")
      {
        if($request->year == "all")
        {
          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'sex');
          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'age_group');

          $specific1_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name1');
          $specific2_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name2');

          $specific3_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name3');

          $specific1 = $specific1_list->count();
          $specific1_name = $specific1_list->pluck('specific_name1')->unique();

          $specific2 = $specific2_list->count();
          $specific2_name = $specific2_list->pluck('specific_name2')->unique();

          $specific3 = $specific3_list->count();
          $specific3_name = $specific3_list->pluck('specific_name3')->unique();

   
      }
      else{
        $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'sex');

        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'residence');

        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'age_group');

        $specific1_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name1',$request->year);
        $specific2_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name2',$request->year);

        $specific3_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name3',$request->year);

        $specific1 = $specific1_list->count();
        $specific1_name = $specific1_list->pluck('specific_name1')->unique();

        $specific2 = $specific2_list->count();
        $specific2_name = $specific2_list->pluck('specific_name2')->unique();

        $specific3 = $specific3_list->count();
        $specific3_name = $specific3_list->pluck('specific_name3')->unique();
      }

      }

      if($valuee == "Federal")
      {
        if($request->year == "all")
        {
          // $sex = $main_indicator->getIndicatorCountBySexNull($data_source,$id,["Federal"]);
          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Federal"],'sex');
          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Federal"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Federal"],'age_group');

          $specific1_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Federal"],'specific_name1');
        $specific2_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Federal"],'specific_name2');

        $specific3_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Federal"],'specific_name3');

        $specific1 = $specific1_list->count();
        $specific1_name = $specific1_list->pluck('specific_name1')->unique();

        $specific2 = $specific2_list->count();
        $specific2_name = $specific2_list->pluck('specific_name2')->unique();

        $specific3 = $specific3_list->count();
        $specific3_name = $specific3_list->pluck('specific_name3')->unique();

      }
      else{
        $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Federal"],$request->year,'sex');

        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Federal"],$request->year,'residence');

        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Federal"],$request->year,'age_group');

        $specific1_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Federal"],'specific_name1',$request->year);

        $specific2_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Federal"],'specific_name2',$request->year);

        $specific3_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Federal"],'specific_name3',$request->year);

        $specific1 = $specific1_list->count();
        $specific1_name = $specific1_list->pluck('specific_name1')->unique();

        $specific2 = $specific2_list->count();
        $specific2_name = $specific2_list->pluck('specific_name2')->unique();

        $specific3 = $specific3_list->count();
        $specific3_name = $specific3_list->pluck('specific_name3')->unique();
      }
      }

       if($valuee == "Province"){
        if($request->year == "all")
        {
          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'sex');

          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'age_group');

          $specific1_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name1');
          $specific2_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name2');

          $specific3_list = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name3');

          $specific1 = $specific1_list->count();
          $specific1_name = $specific1_list->pluck('specific_name1')->unique();

          $specific2 = $specific2_list->count();
          $specific2_name = $specific2_list->pluck('specific_name2')->unique();

          $specific3 = $specific3_list->count();
          $specific3_name = $specific3_list->pluck('specific_name3')->unique();
          
        }
        else{
          $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'sex');

        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'residence');

        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'age_group');


        $specific1_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name1',$request->year);
        $specific2_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name2',$request->year);

        $specific3_list = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name3',$request->year);

        $specific1 = $specific1_list->count();
        $specific1_name = $specific1_list->pluck('specific_name1')->unique();

        $specific2 = $specific2_list->count();
        $specific2_name = $specific2_list->pluck('specific_name2')->unique();

        $specific3 = $specific3_list->count();
        $specific3_name = $specific3_list->pluck('specific_name3')->unique();
    

        }

      }


      if($valuee == "Division"){
       if($request->year == "all")
       {

       $sex = $main_indicator->getIndicatorCountByDivisionSexNull($data_source,$id);

       $resi = $main_indicator->getIndicatorCountByDivisionResidenceNull($data_source,$id);
       
       $age = $main_indicator->getIndicatorCountByDivisionAgeNull($data_source,$id);

        $specific1_list = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name1');

        $specific2_list = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name2');

        $specific3_list = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name3');

        $specific1 = $specific1_list->count();
        $specific1_name = $specific1_list->pluck('specific_name1')->unique();

        $specific2 = $specific2_list->count();
        $specific2_name = $specific2_list->pluck('specific_name2')->unique();

        $specific3 = $specific3_list->count();
        $specific3_name = $specific3_list->pluck('specific_name3')->unique();
   
       }
       else{


        $sex = $main_indicator->getYearlyIndicatorCountByDivisionSexNull($data_source,$id,$request->year);

        $resi = $main_indicator->getYearlyIndicatorCountByDivisionResidenceNull($data_source,$id,$request->year);
  
        $age = $main_indicator->getYearlyIndicatorCountByDivisionAgeNull($data_source,$id,$request->year);
       
        $specific1_list = $main_indicator->getYearlyIndicatorCountByDivSpecificName($data_source,$id,'specific_name1',$request->year);

        $specific2_list = $main_indicator->getYearlyIndicatorCountByDivSpecificName($data_source,$id,'specific_name2',$request->year);

        $specific3_list = $main_indicator->getYearlyIndicatorCountByDivSpecificName($data_source,$id,'specific_name3',$request->year);

        $specific1 = $specific1_list->count();
        $specific1_name = $specific1_list->pluck('specific_name1')->unique();

        $specific2 = $specific2_list->count();
        $specific2_name = $specific2_list->pluck('specific_name2')->unique();

        $specific3 = $specific3_list->count();
        $specific3_name = $specific3_list->pluck('specific_name3')->unique();

    }


     }


     if($valuee == "District"){
      if($request->year == "all")
      {
     
      $sex = $main_indicator->getIndicatorCountByDistrictSexNull($data_source,$id);

      $resi = $main_indicator->getIndicatorCountByDistrictResidenceNull($data_source,$id);
      
      $age = $main_indicator->getIndicatorCountByDistrictAgeNull($data_source,$id);

      $specific1_list =  $main_indicator->getIndicatorCountByDistSpecificName($data_source,$id,'specific_name1');

      $specific2_list =  $main_indicator->getIndicatorCountByDistSpecificName($data_source,$id,'specific_name1');
       
      $specific3_list = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name3');

      $specific1 = $specific1_list->count();
      $specific1_name = $specific1_list->pluck('specific_name1')->unique();

      $specific2 = $specific2_list->count();
      $specific2_name = $specific2_list->pluck('specific_name2')->unique();

      $specific3 = $specific3_list->count();
      $specific3_name = $specific3_list->pluck('specific_name3')->unique();

      }
      else{

        $sex = $main_indicator->getYearlyIndicatorCountByDistrictSexNull($data_source,$id,$request->year);

        $resi = $main_indicator->getYearlyIndicatorCountByDistrictResidenceNull($data_source,$id,$request->year);
  
        $age = $main_indicator->getYearlyIndicatorCountByDistrictAgeNull($data_source,$id,$request->year);

      $specific1_list = $main_indicator->getYearlyIndicatorCountByDistSpecificName($data_source,$id,'specific_name1',$request->year);

      $specific2_list = $main_indicator->getYearlyIndicatorCountByDistSpecificName($data_source,$id,'specific_name2',$request->year);

      $specific3_list = $main_indicator->getYearlyIndicatorCountByDistSpecificName($data_source,$id,'specific_name3',$request->year);

      $specific1 = $specific1_list->count();
      $specific1_name = $specific1_list->pluck('specific_name1')->unique();

      $specific2 = $specific2_list->count();
      $specific2_name = $specific2_list->pluck('specific_name2')->unique();

      $specific3 = $specific3_list->count();
      $specific3_name = $specific3_list->pluck('specific_name3')->unique();
      }
      }
        $view = view('dashboard.myfilterssecond',
        [
            'sex'     => $sex,
            'resi'  =>$resi,
            'age' => $age,
            'specific1' => $specific1,
            'specific2' => $specific2,
            'specific3' => $specific3,
            'specific1_name' => $specific1_name,
            'specific2_name' => $specific2_name,
            'specific3_name' => $specific3_name,

        ])->render();

        return response()->JSON(['view'=>$view,'sex'=>$sex,'resi'=>$resi,'age'=>$age,'specific1' => $specific1,
          'specific2' => $specific2,
          'specific3' => $specific3,]);
    }


    public function getsurveyarea(Request $request)
    {
      $data_source = $request->data_source;
      $year = $request->year;
      if($year == "all")
      {
        $provinces = DB::table('informations')
        ->groupBy('informations.province_id')->selectRaw('informations.province_id')->get();
      }
      else{
      $provinces = DB::table('informations')->where('data_source_name',$data_source)->where('current_year',$year)
      ->groupBy('informations.province_id')->selectRaw('informations.province_id')->get();
      }

        $view = "<option value='all'>All</option>" ;
        foreach($provinces as $prop)
        {
          if($prop->province_id != null)
          {
          $ppx = Province::where('id', $prop->province_id)->first();
          $view.= "<option value='$prop->province_id'>$ppx->title</option>";
          }
          else{
            $view.= "<option value='national'>National/Pakistan</option>";
          }
        }

        return $view;
    }


    public function testshift(Request $request)
    {

      $indicators = Indicator::all();
      foreach($indicators as $i)
      {
        $target = new TargetName();
        $target->requirement_id = $i->id;
        $target->target_id = $i->target_id;
        $target->save();

      }

      dd("Done ! do NOT Reload");

    }


    public function getcustomgraphoptionreq(Request $request)
    {
      $data_source = $request->data_source;
      $id = decrypt($request->indicator_id);
      $valuee = $request->valuee;
      $year = $request->year;
      $main_indicator = new MainIndicator;

      if($valuee == "National")
      {
        if($request->year == "all")
        {
          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'sex');

          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["National"],'age_group');

      $specific1 = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name1');

      $specific2 = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name2');

      $specific3 = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name3');

      }
      else{

        $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'sex');

        $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'residence');

        $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["National"],$request->year,'age_group');

        $specific1 = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name1',$request->year);

        $specific2 = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name2',$request->year);

        $specific3 = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["National"],'specific_name3',$request->year);

      }

      }
       if($valuee == "Province"){
        if($request->year == "all")
        {
          $sex = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'sex');

          $resi = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'residence');
    
          $age = $main_indicator->getIndicatorCountByColumnNotNull($data_source,$id,["Province"],'age_group');

        $specific1 = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name1');

        $specific2 = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name2');

        $specific3 = $main_indicator->getIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name3');
     
        }
        else{
          $sex = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'sex');

          $resi = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'residence');
  
          $age = $main_indicator->getYearlyIndicatorCountByColumnNotNull($data_source,$id,["Province"],$request->year,'age_group');

        $specific1 = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name1',$request->year);

        $specific2 = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name2',$request->year);

        $specific3 = $main_indicator->getYearlyIndicatorCountBySpecificName($data_source,$id,["Province"],'specific_name3',$request->year);

        }


      }


      if($valuee == "Division"){
       if($request->year == "all")
       {
     
        $sex = $main_indicator->getIndicatorCountByDivisionSexNull($data_source,$id);

        $resi = $main_indicator->getIndicatorCountByDivisionResidenceNull($data_source,$id);
  
        $age = $main_indicator->getIndicatorCountByDivisionAgeNull($data_source,$id);

        $specific1 = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name1');
       
        $specific2 = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name2');
       
        $specific3 = $main_indicator->getIndicatorCountByDivSpecificName($data_source,$id,'specific_name3');
       }
       else{

          $sex = $main_indicator->getYearlyIndicatorCountByDivisionSexNull($data_source,$id,$request->year);

          $resi = $main_indicator->getYearlyIndicatorCountByDivisionResidenceNull($data_source,$id,$request->year);
    
          $age = $main_indicator->getYearlyIndicatorCountByDivisionAgeNull($data_source,$id,$request->year);
    
          $specific1 = $main_indicator->getYearlyIndicatorCountByDivSpecificName($data_source,$id,'specific_name1',$request->year);

          $specific2 = $main_indicator->getYearlyIndicatorCountByDivSpecificName($data_source,$id,'specific_name2',$request->year);

          $specific3 = $main_indicator->getYearlyIndicatorCountByDivSpecificName($data_source,$id,'specific_name3',$request->year);


       }


     }


     if($valuee == "District"){
      if($request->year == "all")
      {
        $sex = $main_indicator->getIndicatorCountByDistrictSexNull($data_source,$id);

        $resi = $main_indicator->getIndicatorCountByDistrictResidenceNull($data_source,$id);
        
        $age = $main_indicator->getIndicatorCountByDistrictAgeNull($data_source,$id);
  
        $specific1 = $main_indicator->getIndicatorCountByDistSpecificName($data_source,$id,'specific_name1');
         
        $specific2 = $main_indicator->getIndicatorCountByDistSpecificName($data_source,$id,'specific_name2');
         
        $specific3 = $main_indicator->getIndicatorCountByDistSpecificName($data_source,$id,'specific_name3');

      }
      else{
        $sex = $main_indicator->getYearlyIndicatorCountByDistrictSexNull($data_source,$id,$request->year);

        $resi = $main_indicator->getYearlyIndicatorCountByDistrictResidenceNull($data_source,$id,$request->year);
  
        $age = $main_indicator->getYearlyIndicatorCountByDistrictAgeNull($data_source,$id,$request->year);
  
       $specific1 = $main_indicator->getYearlyIndicatorCountByDistSpecificName($data_source,$id,'specific_name1',$request->year);

       $specific2 = $main_indicator->getYearlyIndicatorCountByDistSpecificName($data_source,$id,'specific_name2',$request->year);

       $specific3 = $main_indicator->getYearlyIndicatorCountByDistSpecificName($data_source,$id,'specific_name3',$request->year);
 
      }


    }
      $view = view('dashboard.mycustomgraph',
      [
          'sex'      =>$sex,
          'resi'  =>$resi,
          'age' => $age,
          'specific1' => $specific1,
          'specific2' => $specific2,
          'specific3' => $specific3,
          'data_source' => $data_source,
          'indicator_id'  => $id,
          'year'  => $year,
          'type'  => $valuee
      ])->render();

      return response()->JSON(['view'=>$view,'sex'=>$sex,'resi'=>$resi,'age'=>$age,'specific1' => $specific1,
        'specific2' => $specific2,
        'specific3' => $specific3,]);
    }




    public function getcustomgraphoption2(Request $request)
    {
      $data_source = $request->data_source;
      $indicator_id = $request->indicator_id;
      $type = $request->type;
      $year = $request->year;
      $option = $request->option;

      $main_indicator = new MainIndicator;

      if($type == "National")
      {
        $indicator = $main_indicator->getIndicatorBySurveyAndYear($data_source,$indicator_id,["National"],$request->year);

      }
      if($type == "Province")
      {
        $indicator = $main_indicator->getIndicatorBySurveyAndYear($data_source,$indicator_id,["Province"],$request->year);

      }
      if($type == "District")
      {
        $indicator = $main_indicator->getYearlyIndicatorByDistrictNotNull($data_source,$indicator_id,$request->year);

      }
      if($type == "Division")
      {
        $indicator = $main_indicator->getYearlyIndicatorByDivisionNotNull($data_source,$indicator_id,$request->year);

      }
    // sorting out the options \

    if($option == "sex")
    {
      $indicator = $indicator->select("main_indicators.sex as type")->groupBy('sex')->get();
    }

    if($option == "residence")
    {
      $indicator = $indicator->select("main_indicators.residence as type")->groupBy('residence')->get();
    }

    if($option == "age_group")
    {
      $indicator = $indicator->select("main_indicators.age_group as type")->groupBy('age_group')->get();
    }

    if($option == "specific_name1")
    {
      $indicator = $indicator->select("main_indicators.specific_name1 as type")->groupBy('specific_name1')->get();
    }

    if($option == "specific_name2")
    {
      $indicator = $indicator->select("main_indicators.specific_name2 as type")->groupBy('specific_name2')->get();
    }

    if($option == "specific_name3")
    {
      $indicator = $indicator->select("main_indicators.specific_name3 as type")->groupBy('specific_name3')->get();
    }

    $view = "";
    foreach($indicator as $i)
    {
      if($i->type != null && $i->type != "")
      {
      $view .= "<option>$i->type</option>";
      }
    }
      return response()->JSON(['view'=>$view]);
    }



    public function getcustomgraphoption3(Request $request)
    {
      $data_source = $request->data_source;
      $indicator_id = $request->indicator_id;
      $type = $request->type;
      $year = $request->year;
      $option = $request->option;
      $option2 = $request->option2;
      $option3 = $request->option3;
      $main_indicator = new MainIndicator;

      if($type == "National")
      {
        $indicator = $main_indicator->getIndicatorBySurveyAndYear($data_source,$indicator_id,["National"],$request->year);

      }
      if($type == "Province")
      {
        $indicator = $main_indicator->getIndicatorBySurveyAndYear($data_source,$indicator_id,["Province"],$request->year);

      }
      if($type == "District")
      {
        $indicator = $main_indicator->getYearlyIndicatorByDistrictNotNull($data_source,$indicator_id,$request->year);

      }
      if($type == "Division")
      {
        $indicator = $main_indicator->getYearlyIndicatorByDivisionNotNull($data_source,$indicator_id,$request->year);

      }
    // sorting out the options \

    $indicator = $indicator->where($option,$option2)->where($option3,"!=", "");
    $labels = $option."/".$option2;


    if($option3 == "sex")
    {
      $indicator = $indicator->select("main_indicators.sex as mynames","main_indicators.*")->get();
    }

    if($option3 == "residence")
    {
      $indicator = $indicator->select("main_indicators.residence as mynames","main_indicators.*")->get();
    }

    if($option3 == "age_group")
    {
      $indicator = $indicator->select("main_indicators.age_group as mynames","main_indicators.*")->get();
    }

    if($option3 == "specific_name1")
    {
      $indicator = $indicator->select("main_indicators.specific_description1 as mynames","main_indicators.*")->get();
    }

    if($option3 == "specific_name2")
    {
      $indicator = $indicator->select("main_indicators.specific_description2 as mynames","main_indicators.*")->get();
    }

    if($option3 == "specific_name3")
    {
      $indicator = $indicator->select("main_indicators.specific_description3 as mynames","main_indicators.*")->get();
    }

  $view = view('dashboard.mynewgraph',
  [
      'indicators'      =>$indicator,
      'labels'          => $labels,

  ])->render();

        return response()->JSON(['view'=>$view]);
      }

    public function viewTheme($id)
    {
    $data = ['view' => ''];

      try{
        $theme = new Theme;
        $indicator = new Indicator;
        $theme_id = decrypt($id);
  
        if($theme_id != 5)
        {
          $indicator_list = $indicator->getLandingPageIndicatorList($theme_id);
          $map_indicator = $indicator->getLandingPageMapIndicator($theme_id);
          $all_themes = $theme->getAllTheme();
          $curr_theme = $theme->getThemeById($theme_id);
      
          $view  = view('dashboard.viewtheme',[
            'themes'            =>  $all_themes,
            'curr_theme'        =>  $curr_theme,
            'indicator_list'    =>  $indicator_list,
            'map_indicator'     =>  $map_indicator,
      
          ]);
        }
     else{
  
      $indicator_list = $indicator->getEconomicLandingPageIndicatorList($theme_id);
          $sub_theme_ids = $indicator_list->pluck('sub_theme_id');

          $sub_theme_indicator1 = $indicator->getIndicatorBySubTheme($sub_theme_ids[0],["Bar Chart"],$theme_id);

          $sub_theme_indicator2 = $indicator->getIndicatorBySubTheme($sub_theme_ids[2],["Bar Chart"],$theme_id);
  
          $map_indicator1 = $indicator->getIndicatorBySubTheme($sub_theme_ids[0],["Map"],$theme_id);
          $map_indicator2 = $indicator->getIndicatorBySubTheme($sub_theme_ids[1],["Map"],$theme_id);
        
          $all_themes = $theme->getAllTheme();
          $curr_theme = $theme->getThemeById($theme_id);
  
          $view = view('dashboard.vieweconomictheme',[
            'themes'            =>  $all_themes,
            'curr_theme'        =>  $curr_theme,
            'sub_theme_indicator1'    =>  $sub_theme_indicator1,
            'sub_theme_indicator2'    =>  $sub_theme_indicator2,
            'map_indicator1'     =>  $map_indicator1,
            'map_indicator2'     =>  $map_indicator2,
    
          ]);

     }
       

      }
      catch(DecryptException $e){


      }
      return $view;

 

    }



    

}
