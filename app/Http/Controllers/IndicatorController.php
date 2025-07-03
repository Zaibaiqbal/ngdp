<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IndicatorRequest;
use App\Information;
use App\Indicator;
use App\Qualitative;
use App\TargetName;
use App\NewIndicator;
use App\MainIndicator;
use App\ChildInformation;
use App\ChildSpecific;
use App\HeadSpecific;
use App\Sdg;
use App\RegSdg;
use App\Target;
use App\Province;
use App\Division;
use App\District;
use EF;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;

class IndicatorController extends Controller
{
    
    public function storeIndicator(Request $request)
    {

        try
        {
            $form_collect = $request->input();

            $form_collect['sub_theme'] = decrypt($form_collect['sub_theme']);

            $form_collect['sub_theme_key'] = $form_collect['sub_theme_key'];
            $form_collect['beijing_id'] = decrypt($form_collect['beijing_id']);

            $indicator = new Indicator;
            $curr_indicator = $indicator->storeIndicator($form_collect);
       
        }
        catch(Exception $e)
        {

        }

        Session::flash('success', "Indicator Added Successfully");
        EF::createLogs('Indicator has added successfully');
        Session::put('sub_theme_key', $form_collect['sub_theme_key']);
        return redirect()->back();

    }

    public function storeQualitative(Request $request)
    {

        try
        {
            $form_collect = $request->input();

            $form_collect['indicator_id'] = decrypt($form_collect['indicator_id']);
            $form_collect['sub_theme'] = decrypt($form_collect['sub_theme']);

            $qual = new Qualitative();
            $qual->policy_name = $form_collect['policy_nane'];
            $qual->legal_name = $form_collect['legal_name'];
            $qual->sub_theme_id = $form_collect['sub_theme'];
            $qual->requirement_id = $form_collect['indicator_id'];
            $qual->save();

        }
        catch(Exception $e)
        {

        }

        Session::flash('success', "Indicator Added Successfully");
        EF::createLogs('Indicator has added successfully');

        return redirect()->back();

    }

    public function updateRequirement(RequirementRequest $request)
    {
        try
        {
            $form_collect = $request->input();

            $form_collect['sub_theme']    = decrypt($form_collect['sub_theme']);

            $form_collect['requirement'] = decrypt($form_collect['requirement']);
            $indicator = new Indicator;
            $indicator->updateRequirement($form_collect);
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function removeIndicator($id)
	{
        try
        {
          $id = decrypt($id);

          $indicator = new Indicator;

          if ($indicator->removeIndicator($id))
          {

          }
        }
        catch (DecryptException $e)
        {

        }

        return redirect()->back();
	}


  public function indicators($id)
  {
    $id = decrypt($id);

    $sdgs = new Sdg;
    $target = new Target;
    $province = new Province;
    $district = new District;
    $indicator = new Indicator;
    $qualitative = new Qualitative;
    $main_indicator = new MainIndicator;
    
    $qualitative_list = $qualitative->getQualitativeByRequirementId($id);

    $indicators = $indicator->getIndicatorById($id);

    if(isset($indicators->id))
    {
      // $info = Information::where('requirement_id',$indicators->id)->get();

      // $info1 = Information::where('requirement_id',$indicators->id)->groupBy('last_updated')->selectRaw('last_updated')->get();
      // $info_temp = Information::where('requirement_id',$indicators->id)->groupBy('data_source_name')->selectRaw('data_source_name')->get();

      $data_sources = $main_indicator->getDataSourceNameByIndicatorId($indicators->id)->pluck('data_source_name');
      $data_source_list = $main_indicator->getDistinctDataSources();

      $myarrdata = [];

      foreach ($data_sources as $iif) {

        if(strpos($iif,"PDHS"))
        {
          array_push($myarrdata , $iif);
        }
      }

      foreach ($data_sources as $iif) {

        if(strpos($iif,"PSLM"))
        {
          array_push($myarrdata , $iif);
        }
      }

      foreach ($data_sources as $iif) {

        if(strpos($iif,"MICS"))
        {
          array_push($myarrdata , $iif);
        }
      }

      foreach ($data_sources as $rows) {

        if(!strpos($rows,"MICS") && !strpos($rows,"PSLM") && !strpos($rows,"PDHS"))
        {
          array_push($myarrdata , $rows);
        }
      }

      $sdg_list = $sdgs->getAllSdgs();
      
      $target_list = $target->getTargetsBySdgId($indicators->sdg_id);
      
      $province_list = $province->getAllProvinces();
      $district_list = $district->getDistrictsByProvinceId(1);


      $years = $main_indicator->getCurrentYears();
   
      return view('indicators.view_indicator_details',
      [
          'data_source_list'         => $data_source_list,
          'indicator'         => $indicators,
   
          'info2' => $myarrdata,
      
          'selected' => null,
          // 'yearsum'  => $yearsum,
          'qualitative' => $qualitative_list,
          'sdgs' => $sdg_list,
          'targets' => $target_list,
          'provinces' => $province_list,
          'districts' => $district_list,
          'years' =>$years,
        
      ]
      );
    }
    else{
      Session::flash('error', "Indicator not found");
      return redirect()->back();
    }

  }

  public function editPolicy(Request $request)
  {
      try
      {
        $id = decrypt($request->indicator_id);

        $form_collect = $request->input();



        $indicator = Indicator::where('id', $id)->first();
        $indicator->data_requirement = $form_collect['data_requirement'];

        $indicator->remarks    = $form_collect['remarks'];

        $indicator->save();


      }
      catch (DecryptException $e)
      {

      }

      return redirect()->back();
}


  public function submitInfo(Request $request)
  {
      try
      {

        $form_collect = $request->input();
        $form_collect['requirement_id'] = decrypt($form_collect['indicator_id']);


        foreach($form_collect['last_updated'] as $df)
        {
        $form_collect['last_updated'] = $df;
        $info = new Information;
        $curr_info = $info->storeinfo($form_collect);
        }

      }
      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Information Added Successfully");
      return redirect()->back();
  }

  public function getinfoheadline(Request $request)
  {


        $form_collect = $request->input();
        $form_collect['headline_id'] = $form_collect['headline_id'];

        $headline = MainIndicator::where('id', $form_collect['headline_id'])->first();


        $provinces = Province::get();
        $districts = District::where('province_id',1)->get();

        $view = view('dashboard.modals.edit_indicator_info',
        [
            'headline'      =>$headline,
            'provinces' => $provinces,
            'districts' => $districts,
        ])->render();

        return $view;
  }

  public function getinfosubchild(Request $request)
  {

        $form_collect = $request->input();
        $form_collect['headline_id'] = decrypt($form_collect['headline_id']);

        $childata = ChildInformation::where('id', $form_collect['childid'])->first();
        $info = Information::get();
        $he = Information::where('id',$form_collect['headline_id'])->first();
        $child_specifics = ChildSpecific::where('child_information_id', $childata->id)->get();
        $provinces = Province::get();
        if($he->survey_level == "National")
        {
          $divisions = Division::where('province_id',$he->province_id)->get();
        }
        else{
          $divisions = Division::where('province_id',0)->get();
        }


        $view = view('dashboard.modals.edit_indicator_child',
        [
            'childata'      =>$childata,
            'provinces' => $provinces,
            'divisions' => $divisions,
            'child_specifics' => $child_specifics,
            'info' => $info,
        ])->render();

        return $view;
  }

  public function submitInfochild(Request $request)
  {
      try
      {

        $form_collect = $request->input();
        $form_collect['information_id'] = decrypt($form_collect['headline_id']);
        if(isset($form_collect['division_id']) && $form_collect['division_id'] != null && $form_collect['division_id'] != "" && $form_collect['division_id'] != "0")
        {

        $form_collect['division_id'] = decrypt($form_collect['division_id']);
      }
      if(isset($form_collect['district_id']) && $form_collect['district_id'] != null && $form_collect['district_id'] != "" && $form_collect['district_id'] != "0")
        {
        $form_collect['district_id'] = decrypt($form_collect['district_id']);
        }
        $info = new ChildInformation;
        $curr_info = $info->storeinfo($form_collect);

        foreach($form_collect['specific_title'] as $key=>$myname)
        {
          if($form_collect['specific_title'] != "")
          {
        $cspec = new ChildSpecific();
        $cspec->child_information_id = $curr_info->id;
        $cspec->specific_title = $myname;
        $cspec->specific_name = $form_collect['specific_name'][$key];
        $cspec->save();
        }
        }


      }
      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Sub Indicator Added Successfully");
      return redirect()->back();
  }

  public function editInfochild(Request $request)
  {
      try
      {

        $form_collect = $request->input();
        $form_collect['information_id'] = decrypt($form_collect['headline_id']);
        $form_collect['subline_id'] = $form_collect['subline_id'];
        if(isset($form_collect['division_id']) && $form_collect['division_id'] != null && $form_collect['division_id'] != "" && $form_collect['division_id'] != "0")
        {

        $form_collect['division_id'] = decrypt($form_collect['division_id']);
      }
      if(isset($form_collect['district_id']) && $form_collect['district_id'] != null && $form_collect['district_id'] != "" && $form_collect['district_id'] != "0")
        {
        $form_collect['district_id'] = decrypt($form_collect['district_id']);
        }
        $info = ChildInformation::where('id', $form_collect['subline_id'])->first();
        $curr_info = $info->editinfo($form_collect);

        $cf = ChildSpecific::where('child_information_id', $curr_info->id)->get();
        foreach($cf as $f)
        {
          $f->delete();
        }
        foreach($form_collect['specific_title'] as $key=>$myname)
        {
          if($form_collect['specific_title'] != "")
          {
        $cspec = new ChildSpecific();
        $cspec->child_information_id = $curr_info->id;
        $cspec->specific_title = $myname;
        $cspec->specific_name = $form_collect['specific_name'][$key];
        $cspec->save();
        }
        }


      }
      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Sub Indicator Edited Successfully");
      return redirect()->back();
  }

  


  public function editInfoheadline(Request $request)
  {
      try
      {

        $form_collect = $request->input();
        $form_collect['indicator_id'] = decrypt($form_collect['indicator_id']);
        $info = MainIndicator::where('id' , $form_collect['indicator_id'])->first();

        $info->data_source_name                 = $form_collect['data_source_name'];
        $info->survey_level                 = $form_collect['survey_level'];
        if($form_collect['survey_level'] != "National")
        {
        $info->province_id                 = $form_collect['province_id'];
        $info->division_id                 = $form_collect['division_id'];
        $info->district_id                 = $form_collect['district_id'];
        }
        $info->sex                 = $form_collect['sex'];
        $info->age_group                 = $form_collect['age'];
        $info->residence                 = $form_collect['residence'];
        $info->unit                 = $form_collect['unit'];
        $info->base_year                 = $form_collect['base_year'];
        $info->base_value                 = $form_collect['base_value'];
        $info->current_year                 = $form_collect['current_year'];
        $info->current_value                 = $form_collect['current_value'];
        $info->footnote                 = $form_collect['footnote'];
        $info->nature                 = $form_collect['nature'];
        $info->lower_year                 = $form_collect['lower_year'];
        $info->upper_year                 = $form_collect['upper_year'];
        $info->specific_name1                 = $form_collect['specific_name1'];
        $info->specific_description1                 = $form_collect['specific_description1'];
        $info->specific_name2                 = $form_collect['specific_name2'];
        $info->specific_description2                 = $form_collect['specific_description2'];
        $info->specific_name3                 = $form_collect['specific_name3'];
        $info->specific_description3                 = $form_collect['specific_description3'];
        $info->source_link                 = $form_collect['source_link'];
        // $info->last_updated                 = $object['last_updated'];
        $info->save();
        }

      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Information Edited Successfully");
      return redirect()->back();
  }


  public function deleteheadinfo(Request $request)
  {
      try
      {

        $form_collect = $request->input();

        $form_collect['head_indi_id'] = $form_collect['head_indi_id'];
        $info = MainIndicator::where('id' , $form_collect['head_indi_id'])->first();

        $info->delete();

        }

      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Information Deleted Successfully");
      return redirect()->back();
  }

  public function deletesubinfo(Request $request)
  {
      try
      {

        $form_collect = $request->input();

        $form_collect['sub_indi_id'] = $form_collect['sub_indi_id'];
        $info = ChildInformation::where('id' , $form_collect['sub_indi_id'])->first();
        $hhh = ChildSpecific::where('child_information_id' , $form_collect['sub_indi_id'])->get();
        foreach ($hhh as $hh) {
          $hh->delete();
        }

        $info->delete();

        }

      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Information Deleted Successfully");
      return redirect()->back();
  }

  public function editinfo(Request $request)
  {
      try
      {

        $form_collect = $request->input();
        $form_collect['requirement_id'] = decrypt($form_collect['indicator_id']);

        $info1 = Information::where('id',$form_collect['info_id'])->first();
        if($info1)
        {
        $info1->delete();
        }

        foreach($form_collect['last_updated'] as $df)
        {
        $form_collect['last_updated'] = $df;
        $info = new Information;
        $curr_info = $info->storeinfo($form_collect);
        }

      }
      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Information Edited Successfully");
      return redirect()->back();
  }

  public function deleteinfo($id)
  {
      try
      {


        $info1 = Information::where('id',$id)->first();
        if($info1)
        {
        $info1->delete();
        }



      }
      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Information Deleted Successfully");
      return redirect()->back();
  }

  public function deleteIndicator(Request $request)
  {
      try
      {

        $form_collect = $request->input();
        $form_collect['indicator_id'] = decrypt($form_collect['indicator_id']);
        $info = MainIndicator::where('indicator_id', $form_collect['indicator_id'])->get();
        foreach ($info as $data) {
         
          $data->delete();
        }

        $qualitative = Qualitative::where('requirement_id', $form_collect['indicator_id'])->get();
        foreach ($qualitative as $data) {
          $data->delete();
        }

        $indi = Indicator::where('id',$form_collect['indicator_id'])->first();
        $indi->delete();

      }
      catch (DecryptException $e)
      {

      }
      Session::flash('success', "Indicator deleted Successfully");
      return redirect()->route('home');
  }





  public function policydelete($id)
  {
      try
      {
        $qq = Qualitative::where('id', $id)->first();
        $qq->policy_name = "";
        $qq->update();

        $q = Qualitative::where('id' , $id)->first();
        if($q->policy_name == ""  && $q->legal_name == "")
        {
          $q->delete();
        }
        Session::flash('success', "Deleted Successfully");
        return redirect()->back();

      }
      catch (DecryptException $e)
      {
        Session::flash('error', "something went wrong ");
        return redirect()->back();
      }

  }


  public function legaldelete($id)
  {
      try
      {
        $qq = Qualitative::where('id', $id)->first();
        $qq->legal_name = "";
        $qq->update();

        $q = Qualitative::where('id' , $id)->first();
        if($q->policy_name == ""  && $q->legal_name == "")
        {
          $q->delete();
        }
        Session::flash('success', "Deleted Successfully");
        return redirect()->back();

      }
      catch (DecryptException $e)
      {
        Session::flash('error', "something went wrong ");
        return redirect()->back();
      }

  }

  public function getIndividualIndicatorGraph(Request $request)
  {
    try{

      $data = ['data1' => '', 'national_data' => ''];

      $indicator_id = decrypt($request->curr_indicator_id);

      $main_indicator = new MainIndicator;
      $indicator = new Indicator;

      $curr_indicator = $indicator->getIndicatorById($indicator_id);
      $ages = $main_indicator->getDistinctAgeGroup();
      $specific_dissaggregation = $main_indicator->getDistinctSpecificDis();
      // dd($specific_dissaggregation);
      if(isset($curr_indicator->id))
      {
      
        $indicator_info = $main_indicator->getIndicatorInfo($curr_indicator->id);
        $gender_info = $main_indicator->getGenderIndicator($curr_indicator->id);

        $gender_info_demo = $main_indicator->getGenderIndicatorforDemographics($curr_indicator->id);
        

        $specific_info1 = $main_indicator->getSpecificIndicator($curr_indicator->id);

        $specific_info2 = $main_indicator->getSpecificColumnIndicator($curr_indicator->id,'sex');

        $main_info = $main_indicator->getIndicatorAttr($curr_indicator->id);

        $residence_info = $main_indicator->getResidenceIndicator($curr_indicator->id);

        $age_specific_info = $main_indicator->getAgeSpecificInfoIndicator($curr_indicator->id);

        $age_info = $main_indicator->getAgeGroupIndicator($curr_indicator->id);

        if(sizeof($gender_info) > 0)
        {
          $gender_info_national = $gender_info->where('survey_level',"National");

          $national_info = $main_info->where("survey_level","National")->first();
          // dd($gender_info_national);

          if($national_info == null)
          {
          $national_info = $gender_info->where("survey_level","National")->first();
          }
  
          $data1 = [];
          $count = 0;
          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;
            $data1[$count]['unit'] = $national_info->unit;

            $info1 = $gender_info_national->where("sex","Male")->first();
            $info2 = $gender_info_national->where("sex","Female")->first();
            $info3 = $gender_info_national->where("sex","Transgender")->first();

            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }
            $data1[$count]['info1'] = $current_value;
            $data1[$count]['label1'] = 'Male';

            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
            if(isset($info2->current_value))
            {
              if($info2->unit == "Number")
              {
               $current_value = str_replace(',', '', $info2->current_value);
              }
              else{
                $current_value = $info2->current_value;
              }
            $data1[$count]['info2'] = $current_value;

            $data1[$count]['label2'] = 'Female';
  
            }
            else{
  
              $data1[$count]['info2'] = 0;
            $data1[$count]['label2'] = '';  
            }

            if(isset($info3->current_value))
            {
              if($info3->unit == "Number")
              {
               $current_value = str_replace(',', '', $info3->current_value);
              }
              else{
                $current_value = $info3->current_value;
              }
            $data1[$count]['info3'] = $current_value;

            $data1[$count]['label3'] = 'Transgender';
  
            }
            else{
  
              $data1[$count]['info3'] = 0;
            $data1[$count]['label3'] = '';  
            }
         
          $count++;
          }

        
        }
        else if(sizeof($gender_info_demo) > 0)
        {
          $gender_info_national = $gender_info_demo->where('survey_level',"National");
          $national_info = $main_info->where("survey_level","National")->first();
          if($national_info == null)
          {
          $national_info = $gender_info_demo->where("survey_level","National")->first();
          }
  
          $data1 = [];
          $count = 0;
          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;
            $data1[$count]['unit'] = $national_info->unit;

            $info1 = $gender_info_national->where("sex","Male")->first();
            $info2 = $gender_info_national->where("sex","Female")->first();

            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }
            $data1[$count]['info1'] = $current_value;
            $data1[$count]['label1'] = 'Male';

            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
            if(isset($info2->current_value))
            {
              if($info2->unit == "Number")
              {
               $current_value = str_replace(',', '', $info2->current_value);
              }
              else{
                $current_value = $info2->current_value;
              }
            $data1[$count]['info2'] = $current_value;

            $data1[$count]['label2'] = 'Female';
  
  
            }
            else{
  
              $data1[$count]['info2'] = 0;
            $data1[$count]['label2'] = '';
  
            
            }
         
          $count++;
          }

        
        }
        else if(sizeof($residence_info) > 0){

          $residence_info_national = $residence_info->where('survey_level',"National");

          $pslm_residence_info_national = $residence_info->where('survey_level',"National")->where('da');

          $national_info = $main_info->where("survey_level","National")->first();

          if($national_info == null)
          {
          $national_info = $residence_info->where("survey_level","National")->first();
          }
  
          $data1 = [];
          $count = 0;
          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;
            $info1 = $residence_info_national->where("residence","Urban")->first();
            $info2 = $residence_info_national->where("residence","Rural")->first();
            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }
              $data1[$count]['info1'] = $current_value;

            $data1[$count]['label1'] = 'Urban';
            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
            if(isset($info2->current_value))
            {
              if($info2->unit == "Number")
              {
               $current_value = str_replace(',', '', $info2->current_value);
              }
              else{
                $current_value = $info2->current_value;
              }
            $data1[$count]['info2'] = $current_value;

            $data1[$count]['label2'] = 'Rural';
  
  
            }
            else{
  
              $data1[$count]['info2'] = 0;
            $data1[$count]['label2'] = '';
  
            
            }
         
          $count++;
          }



        }
        else if(sizeof($specific_info1) > 0 && $specific_info1->contains('survey_level' , "National")){

          $specific_info_national = $specific_info1->where('survey_level',"National");

          $national_info = $main_info->where("survey_level","National")->first();
          if($national_info == null)
          {
          $national_info = $specific_info_national->first();
          }
          $data1 = [];
          $count = 0;

          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;

            $info1 = $specific_info_national->whereIn("specific_description1",$specific_dissaggregation)->first();
        
            $info2 = $specific_info_national->where('residence' , 'Urban' || 'residence' , 'Rural')->first();

            if(!isset($info2->id))
            {
            $info2 = $specific_info_national->where("specific_description1","National Assembly")->first();

            }
        
            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }

              $data1[$count]['info1'] = $current_value;
              if($data1[$count]['info1'] > 0){
                $data1[$count]['label1'] = $info1->specific_description1;

              }

            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
            if(isset($info2->current_value))
            {
              $data1[$count]['info2'] = $info2->current_value;

                if(isset($info2->specific_description1)){
                  $data1[$count]['label2'] = $info2->specific_description1;

                }
                else{
                  $data1[$count]['label2'] = $info2->residence;

                }
  
            }
            else{
  
              $data1[$count]['info2'] = 0;
              $data1[$count]['label2'] = '';
    
            
            }
         
          $count++;
          }
         

        }
        else if(sizeof($specific_info1) > 0){
          $specific_info_national = $specific_info1->where('survey_level',"National");

          $national_info = $main_info->where("survey_level","National")->first();
          if($national_info == null)
          {
          $national_info = $specific_info_national->first();
          }
          $data1 = [];
          $count = 0;

          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;

            $info1 = $specific_info_national->whereIn("specific_description1",$specific_dissaggregation)->first();
            $info2 = $specific_info_national->where('residence' , 'Urban' || 'residence' , 'Rural')->first();

            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }

              $data1[$count]['info1'] = $current_value;
              if($data1[$count]['info1'] > 0){
                $data1[$count]['label1'] = $info1->specific_description1;

              }

            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
            if(isset($info2->current_value))
            {
    
              if($data1[$count]['info2'] > 0){

              $data1[$count]['info2'] = $info2->current_value;

              $data1[$count]['label2'] = $info2->residence;
            }
  
            }
            else{
  
              $data1[$count]['info2'] = 0;
              $data1[$count]['label2'] = '';
    
            
            }
         
          $count++;
          }
         

        }
        else if(sizeof($specific_info2) > 0){

          $specific_info_national = $specific_info2->where('survey_level',"National");

          $national_info = $main_info->where("survey_level","National")->first();
          if($national_info == null)
          {
          $national_info = $specific_info2->where("survey_level","National")->first();
          }

          $data1 = [];
          $count = 0;

          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;
            $info1 = $specific_info_national->whereIn("specific_description2",$specific_dissaggregation)->first();
            $info2 = $specific_info_national->where('sex' , 'Male' || 'sex' , 'Female')->first();
            
            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }
            $data1[$count]['info1'] = $current_value;

            $data1[$count]['label1'] = $info1->specific_description2;

            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
            if(isset($info2->current_value))
            {
  
              if($info2->unit == "Number")
              {
               $current_value = str_replace(',', '', $info2->current_value);
              }
              else{
                $current_value = $info2->current_value;
              }
              $data1[$count]['info2'] = $current_value;
          
              $data1[$count]['label2'] = $info2->sex;
            }
            else{
  
              $data1[$count]['info2'] = 0;
            $data1[$count]['label2'] = '';
       
            }
         
          $count++;
          }
        }
        else if(sizeof($age_specific_info) > 0 ){

          $age_specific_info_national = $age_specific_info->where('survey_level',"National");
          $national_info = $main_info->where("survey_level","National")->first();
          if($national_info == null)
          {
          $national_info = $age_specific_info_national->where("survey_level","National")->first();
          }
  
          $data1 = [];
          $count = 0;

          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;
            $info1 = $age_specific_info_national->whereIn("specific_description1",$specific_dissaggregation)->first();

            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }
              $data1[$count]['info1'] = $current_value;

            $data1[$count]['label1'] = $info1->specific_description1;
            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
        
         
          $count++;
          }
         
        }
        else if(sizeof($age_info) > 0 ){

          $age_info_national = $age_info->where('survey_level',"National");
          $national_info = $main_info->where("survey_level","National")->first();
          if($national_info == null)
          {
          $national_info = $age_info->where("survey_level","National")->first();
          }
  
          $data1 = [];
          $count = 0;

          if(isset($national_info->id))
          {
            $data1[$count]['province'] = "National";
            $data1[$count]['current_value'] = $national_info->current_value;
            $info1 = $age_info_national->whereIn("age_group",$ages)->first();

            if(isset($info1->current_value))
            {
              if($info1->unit == "Number")
              {
               $current_value = str_replace(',', '', $info1->current_value);
              }
              else{
                $current_value = $info1->current_value;
              }
              $data1[$count]['info1'] = $current_value;

            $data1[$count]['label1'] = $info1->age_group;
            }
            else{
              $data1[$count]['info1'] = 0;
              $data1[$count]['label1'] = '';
  
            }
         
          $count++;
          }
         
        }
       

        $data = ['data1' => $data1,'national_info' => $national_info,'data_depiction' => $curr_indicator->data_depiction,'indicator_id' => $curr_indicator->id];
// dd($data);
      return $data;

      }

    }
    catch(DecryptException $e){


    }

  }

  public function getIndividualIndicatorMap(Request $request)
  {
    try{
      $indicator_id = decrypt($request->curr_indicator_id);
      
      $main_indicator = new MainIndicator;
      $national = $main_indicator->getNationalLevelIndicator($indicator_id);
      if(isset($national->id))
      {

        $data['survey']             = $national->survey_level;
        $data['current_value']      = $national->current_value;
        $data['current_year']       = $national->current_year;
        $data['data_source_name']   = $national->data_source_name;
        $data['unit']               = $national->unit;

      return $data;

      }
    
    }
    catch(DecryptException $e)
    {

    }

  }
}
