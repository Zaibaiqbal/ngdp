<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ThemeRepository;
use Illuminate\Support\Facades\Validator;
use App\Theme;
use App\SubTheme;
use App\Requirement;
use App\Indicator;
use App\Information;
use App\ChildInformation;
use App\HeadSpecific;
use App\ChildSpecific;
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
use App\RegSdg;
use Auth;
use Mail;
use App\User;
use App\CustomRole;
use App\Registration;
use App\TargetName;
use Response;
use Session;
use DB;
use Crypt;
use Illuminate\Support\Str;
use App\Imports\QuantitativeImport;
use Maatwebsite\Excel\Facades\Excel;

class ApisController extends Controller
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


    public function getIndicatorsList(Request $request)
    {

      // $quantitative_indicators = Requirement::get(['id','data_requirement']);

      $validator = Validator::make($request->all(), [
           'theme_id' => 'required',
      ]);

      $quantitative_indicators = DB::table('indicators')
      ->join('sub_themes','sub_themes.id','=','indicators.sub_theme_id')
      ->where('sub_themes.theme_id',$request->theme_id)->select('indicators.*')->get();

      return response()->JSON([
        'quantitative_indicators' => $quantitative_indicators,
      ]);

    }


    public function getThemes(Request $request)
    {

      $themes = Theme::get(['id','name']);

      return response()->JSON([
        'themes' => $themes,
      ]);

    }

    public function getAllIndicators(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'theme_id' => 'required',
      ]);
      $headline_indicators = DB::table('indicators')
      ->join('sub_themes','sub_themes.id','=','indicators.sub_theme_id')
      ->where('sub_themes.theme_id',$request->theme_id)
      ->selectRaw('indicators.*,sub_themes.theme_id')->get();



      return response()->JSON([
        'headline_indicators' => $headline_indicators,
      ]);

    }

    public function getAllIndicatorsDetail(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'indicator_id' => 'required',
      ]);

    $headline_indicators =   DB::table('main_indicators')
      ->leftjoin('provinces','provinces.id','=','main_indicators.province_id')
      ->leftjoin('districts','districts.id','=','main_indicators.district_id')
      ->leftjoin('divisions','divisions.id','=','main_indicators.division_id')
      ->where('main_indicators.indicator_id',$request->indicator_id)
      ->selectRaw('main_indicators.*,provinces.title as province,districts.title as district,divisions.title as division')->get();



      return response()->JSON([
        'indicators' => $headline_indicators,
      ]);

    }


    public function getHeadlineIndicator(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'indicator_id' => 'required',
           'source_name' => 'required',
           'year' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->messages());
      }

      $headline_indicators = DB::table('informations')
      ->leftjoin('provinces','provinces.id','=','informations.province_id')
      ->where('informations.requirement_id', $request->indicator_id)
      ->where('informations.data_source_name', $request->source_name)
      ->where('informations.current_year', $request->year)
      ->selectRaw('informations.id,informations.survey_level,informations.current_value,informations.base_value,informations.unit,informations.sex,informations.age_group,informations.residence,
      provinces.title as province_name,provinces.id as province_id')->get();


      return response()->JSON([
        'headline_indicators' => $headline_indicators,
        // 'child_indicators'  => $child_indicators,
      ]);

    }


    public function getSourceName(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'indicator_id' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->messages());
      }

      // $headline_indicators = DB::table('informations')
      // ->leftjoin('provinces','provinces.id','=','informations.province_id')
      // ->where('informations.requirement_id', $request->indicator_id)
      // ->selectRaw('informations.data_source_name')
      // ->groupBy('informations.data_source_name')->get();

      $headline_indicators = Information::where('requirement_id', $request->indicator_id)
      ->groupBy('data_source_name')->get(['data_source_name']);


      return response()->JSON([
        'source_name' => $headline_indicators,
        // 'child_indicators'  => $child_indicators,
      ]);

    }


    public function getSourceyear(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'source_name' => 'required',
           'indicator_id' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->messages());
      }


      $headline_indicators = Information::where('data_source_name', $request->source_name)
      ->where('requirement_id', $request->indicator_id)
      ->groupBy('current_year')->get(['current_year']);



      return response()->JSON([
        'headline_indicators' => $headline_indicators,
        // 'child_indicators'  => $child_indicators,
      ]);

    }


    public function getChildIndicator(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'headline_indicator_id' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->messages());
      }


      $child_indicators = DB::table('child_informations')
      ->leftjoin('districts','districts.id','=','child_informations.district_id')
      ->leftjoin('divisions','divisions.id','=','child_informations.division_id')
      ->where('child_informations.information_id', $request->headline_indicator_id)
      ->selectRaw('child_informations.*,districts.title as district,divisions.title as division')->get();

      foreach($child_indicators as $ci)
      {
        $i = ChildSpecific::where('child_information_id' , $ci->id)->get();
        $ci->child_specifics = $i;
      }

      return response()->JSON([
        'child_indicators' => $child_indicators,
      ]);

    }


    public function getHeadlineSpecific(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'headline_indicator_id' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->messages());
      }


       $disaggregations = HeadSpecific::where('information_id', $request->headline_indicator_id)->get();

      return response()->JSON([
        'disaggregations' => $disaggregations,
      ]);

    }



    public function getChildIndicatorByDistrict(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'headline_indicator_id' => 'required',
           'division_id' => 'required',
           'source_name' => 'required',
           'year' => 'required'
      ]);

      if ($validator->fails()) {
        return response()->json($validator->messages());
      }


      $child_indicators = DB::table('child_informations')
      ->leftjoin('districts','districts.id','=','child_informations.district_id')
      ->join('informations','informations.id','=','child_informations.information_id')
      ->where('child_informations.information_id', $request->headline_indicator_id)
      ->where('districts.division_id', $request->division_id)
      ->where('informations.data_source_name', $request->source_name)
      ->where('informations.current_year', $request->year)
      ->selectRaw('child_informations.*,districts.title as district')
      ->get();

      return response()->JSON([
        'child_indicators' => $child_indicators,
      ]);

    }


    public function getChildIndicatorByDivision(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'headline_indicator_id' => 'required',
           'province_id' => 'required',
           'source_name' => 'required',
           'year' => 'required'
      ]);


      if ($validator->fails()) {
        return response()->json($validator->messages());
      }

      $child_indicators = DB::table('child_informations')
      ->leftjoin('divisions','divisions.id','=','child_informations.division_id')
      ->join('informations','informations.id','=','child_informations.information_id')
      ->where('informations.id', $request->headline_indicator_id)
      ->where('informations.province_id', $request->province_id)
      ->where('informations.data_source_name', $request->source_name)
      ->where('informations.current_year', $request->year)
      ->selectRaw('child_informations.*,divisions.title as division')
      ->get();

      return response()->JSON([
        'child_indicators' => $child_indicators,
      ]);

    }



    public function getChildSpecifics(Request $request)
    {

      $validator = Validator::make($request->all(), [
           'child_indicator_id' => 'required',
      ]);


      if ($validator->fails()) {
        return response()->json($validator->messages());
      }

      $child_indicators = ChildSpecific::where('child_information_id', $request->child_indicator_id)->get();

      return response()->JSON([
        'child_specifics' => $child_indicators,
      ]);

    }


    public function filetoupload(Request $request)
    {
      return view('web.filetoupload');
    }


    public function uploadmyfileqit(Request $request)
    {
      $path = $request->file('file')->getRealPath();

      if($request->type == "QIT")
      {
      if ($request->has('header')) {
        $data = Excel::load($path, function($reader) {})->get()->toArray();
      }
      else {
        $data = array_map('str_getcsv', file($path));
      }

      if (count($data) > 0)
      {
          foreach($data as $i=>$d)
          {
            if($i != 0)
            {
              if(!isset($d[3]))
              {
                dd($d);
              }
              // $new_indicator = NewIndicator::where('id' , $d[3])->first();
              // $new_target = NewTarget::where('target_number', $new_indicator->target_name)->first();
              $indicator = new Indicator();
              $indicator->id = $d[0];
              $indicator->sub_theme_id = $d[2];
              $indicator->data_requirement = $d[1];
              $indicator->data_depiction = $d[5];
              $indicator->data_order = $d[6];
              // $requirement->sdg_id = $new_target->goal_number_id;
              // $requirement->target_id = $new_target->id;
              // $requirement->new_indicator_id = $d[3];
              if($d[4] != null && $d[4] != ''){
              $indicator->beijing_id = $d[4];
            }
              $indicator->save();
            }
          }

      }
      echo "done";
      return redirect()->back();
      }


      if($request->type == "MST")
      {
      if ($request->has('header')) {
        $data = Excel::load($path, function($reader) {})->get()->toArray();
      }
      else {
        $data = array_map('str_getcsv', file($path));
      }

      if (count($data) > 0)
      {
          foreach($data as $i=>$d)
          {
            if($i != 0)
            {
              if(!isset($d[3]))
              {
                dd($d);
              }
              $new_indicator = NewIndicator::where('id' , $d[1])->first();
              $new_target = NewTarget::where('target_number', $new_indicator->target_name)->first();
              $sdg = new RegSdg();
              $sdg->id = $d[0];
              $sdg->sub_theme_id = $d[2];
              $sdg->requirement_id = $d[3];
              $sdg->sdg_id = $new_target->goal_number_id;
              $sdg->target_id = $new_target->id;
              $sdg->new_indicator_id = $d[1];
              $sdg->save();
            }
          }

      }
      echo "done";
      return redirect()->back();
      }

      if($request->type == "MIT")
      {

        if ($request->has('header')) {
          $data = Excel::load($path, function($reader) {})->get()->toArray();
        }
        else {
          $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0)
        {
            foreach($data as $i=>$d)
            {
              if($i != 0)
              {

                $information = new Information();
                $information->id = $d[0];
                $information->requirement_id = $d[1];
                $information->survey_level = $d[2];
                if($d[3] != null && $d[3] != ''){
                $information->province_id = $d[3];}
                $information->sex = $d[4];
                $information->age_group = $d[5];
                $information->residence = $d[6];
                $information->data_source_name = $d[7];
                $information->source_link = $d[9];
                $information->nature = $d[8];
                $information->base_year = $d[11];
                $information->base_value = $d[12];
                $information->current_year = $d[13];
                $information->current_value = $d[14];
                $information->unit = $d[10];
                $information->year_one = $d[16];
                $information->year_two = $d[15];
                $information->footnote = $d[17];
                $information->save();
              }
            }

        }
        echo "done";
        return redirect()->back();
        }


        if($request->type == "CIT")
        {

          if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
          }
          else {
            $data = array_map('str_getcsv', file($path));
          }

          if (count($data) > 0)
          {
              foreach($data as $i=>$d)
              {
                if($i != 0)
                {
                  $information = new ChildInformation();
                  if(!isset($d[1]))
                  {
                    dd($d[0]);
                  }
                  $information->id = $d[0];
                  $information->information_id = $d[1];
                  $information->base_value = $d[10];
                  $information->current_value = $d[9];
                  $information->footnote = $d[11];
                  if($d[2] != null && $d[2] != ''){
                  $information->division_id = $d[2];}
                  if($d[3] != null && $d[3] != ''){
                  $information->district_id = $d[3];}
                  $information->sex = $d[5];
                  $information->age_group = $d[4];
                  $information->residence = $d[6];
                  $information->nature = $d[7];
                  $information->current_year = $d[8];
                  $information->save();
                }
              }

          }
          echo "done";
          return redirect()->back();
          }


          if($request->type == "CSD")
          {

            if ($request->has('header')) {
              $data = Excel::load($path, function($reader) {})->get()->toArray();
            }
            else {
              $data = array_map('str_getcsv', file($path));
            }

            if (count($data) > 0)
            {
                foreach($data as $i=>$d)
                {
                  if($i != 0)
                  {
                    $information = new ChildSpecific();
                    $information->id = $d[0];
                    $information->child_information_id = $d[1];
                    $information->specific_name = $d[3];
                    $information->specific_title = $d[2];
                    $information->save();
                  }
                }

            }
            echo "done";
            return redirect()->back();
            }


            if($request->type == "HSD")
            {

              if ($request->has('header')) {
                $data = Excel::load($path, function($reader) {})->get()->toArray();
              }
              else {
                $data = array_map('str_getcsv', file($path));
              }

              if (count($data) > 0)
              {
                  foreach($data as $i=>$d)
                  {
                    if($i != 0)
                    {
                      $information = new HeadSpecific();
                      $information->id = $d[0];
                      $information->information_id = $d[1];
                      $information->specific_name = $d[2];
                      $information->specific_title = $d[3];
                      $information->save();
                    }
                  }

              }
              echo "done";
              return redirect()->back();
              }


              if($request->type == "QUAL")
              {

                if ($request->has('header')) {
                  $data = Excel::load($path, function($reader) {})->get()->toArray();
                }
                else {
                  $data = array_map('str_getcsv', file($path));
                }

                if (count($data) > 0)
                {
                    foreach($data as $i=>$d)
                    {
                      if($i != 0)
                      {
                        $information = new Qualitative();
                        $information->id = $d[0];
                        $information->sub_theme_id = $d[1];
                        $information->requirement_id = $d[2];
                        $information->policy_name = $d[4];
                        $information->links = $d[3];
                        $information->legal_name = $d[5];

                        $information->save();
                      }
                    }

                }
                echo "done";
                return redirect()->back();
                }


                if($request->type == "NEWINDI")
                {

                  if($request->has('header')) {
                    $data = Excel::load($path, function($reader) {})->get()->toArray();
                  
                  }
                  else {

                    $data = array_map('str_getcsv', file($path));
                 
                  }

                  if(count($data) > 0)
                  {
                      foreach($data as $i=>$d)
                      {
                        if($i != 0)
                        {

                          $information = new MainIndicator();
                          $information->id = $d[0];
                          $information->indicator_id = $d[1];
                          $information->survey_level = trim($d[2]);

                          if($d[3] != "NULL" && $d[3] != "")
                          {
                          $information->province_id = $d[3];
                          }
                          if($d[4] != "NULL" && $d[4] != "")
                          {
                          $information->district_id = $d[4];
                          }
                          if($d[5] != "NULL" && $d[5] != "")
                          {
                          $information->division_id = $d[5];
                          }
                          
                          $information->nature = trim($d[6]);
                          $information->data_source_name = $d[7];
                          $information->source_link = $d[8];
                          $information->unit = $d[9];
                          $information->base_year = $d[10];
                          $information->base_value = $d[11];
                          $information->current_year = $d[12];
                          $information->current_value = $d[13];
                          $information->footnote = $d[14];
                          $information->lower_year = $d[15];
                          $information->upper_year = $d[16];
                          $information->sex = $d[17];
                          $information->age_group = $d[18];
                          $information->residence = $d[19];
                          $information->specific_name1 = $d[20];
                          $information->specific_description1 = $d[21];
                          $information->specific_name2 = $d[22];
                          $information->specific_description2 = $d[23];
                          $information->specific_name3 = $d[24];
                          $information->specific_description3 = $d[25];

                          $information->save();

                        }
                      }

                  }
                  echo "done";
                  return redirect()->back();
                  }

      }


}
