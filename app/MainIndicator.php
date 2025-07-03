<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class MainIndicator extends Model
{

  public function getIndicatorInfoBySurveyLevelCount($data_source,$id,$survey){

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('survey_level', $survey)->count();

  }

  public function getIndicatorCountBySurveyAndYear($data_source,$id,$survey,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('survey_level',$survey)->where('current_year', $year)->count();

  }

  public function getYearlyIndicatorCountByDivisionNotNull($data_source,$id,$year){

    return MainIndicator::where('data_source_name',$data_source)
        ->where('indicator_id',$id)->where('division_id',"!=",null)->where('current_year', $year)->count();
  
  }

  public function getYearlyIndicatorCountByDistrictNotNull($data_source,$id,$year){

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('current_year', $year)->count();

  }

  public function getCurrentYearByIndicatorId($id,$data_source)
  {

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->groupBy('current_year')
    ->select('current_year')->get();
  }

  public function getIndicatorCountByDivisionNotNull($data_source,$id)
  {
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->count();
  }
  public function getIndicatorCountByDistrictNotNull($data_source,$id)
  {
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->count();
  }

  public function getIndicatorInfoByNature($data_source,$id,$nature)
  {
return MainIndicator::where('data_source_name',$data_source)
->where('indicator_id',$id)->whereIn('nature' , $nature)->count();

  }

  public function getIndicatorInfoByDataSource($id,$data_source)
  {
    return MainIndicator::join('provinces','provinces.id','=','main_indicators.province_id')
    ->where('main_indicators.data_source_name',$data_source)
    ->where('main_indicators.indicator_id',$id)
    ->selectRaw('provinces.id')
    ->groupBy('provinces.id')->get();
  }

  public function getYearlyIndicatorCountByNature($data_source,$id,$nature,$year)
  {
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->whereIn('nature' ,$nature)->where('current_year', $year)->count();
  }

  public function getIndicatorInfoByIndicatorId($id){

    return MainIndicator::where('indicator_id',$id)->orderBy('id', 'asc')->get();

  }
  public function getDataSourceNameByIndicatorId($indicator_id){

    return MainIndicator::where('indicator_id',$indicator_id)->groupBy('data_source_name')->selectRaw('data_source_name')->get();
  }

  public function getCurrentYears()
  {
    return MainIndicator::groupBy('main_indicators.current_year')->selectRaw('main_indicators.current_year')->get();
  }

  public function getProvinces()
  {
    return MainIndicator::groupBy('main_indicators.province_id')->selectRaw('main_indicators.province_id')->get();
  }
  
  public function getIndicatorCountByDColumnsNotNull($data_source,$id,$column1,$column2){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where($column1,"!=",null)->where($column2,"!=", "")->count();
   
  }
  public function getIndicatorCountByDivisionSexNull($data_source,$id){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where('sex',"!=", "")->count();
   
  }

  public function getIndicatorCountByDivisionResidenceNull($data_source,$id){

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where('residence',"!=", "")->count();
    
  }


  public function getIndicatorCountByDivisionAgeNull($data_source,$id){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where('age_group',"!=", "")->count();
    }
  public function getIndicatorCountByNatureDivision($data_source,$id,$nature){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('nature' , $nature)->where('division_id',"!=",null)->count();
  
  }

  public function getYearlyIndicatorCountByDivisionSexNull($data_source,$id,$year){

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where('current_year', $year)->where('sex',"!=", "")->count();
    
  }

  public function getYearlyIndicatorCountByDivisionResidenceNull($data_source,$id,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where('current_year', $year)->where('residence',"!=", "")->count();

  }

  public function getYearlyIndicatorCountByDivisionAgeNull($data_source,$id,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where('current_year', $year)->where('age_group',"!=", "")->count();

  }

  public function getYearlyIndicatorCountByNatureDivisionNull($data_source,$id,$year,$nature){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('nature' , $nature)->where('division_id',"!=",null)->where('current_year', $year)->count();
  }


  public function getIndicatorCountByColumnNotNull($data_source,$id,$survey,$column){

    return MainIndicator::where('data_source_name',$data_source)
  ->where('indicator_id',$id)->where('survey_level', $survey)->where($column ,"!=", "")->count();
  }



  public function getIndicatorCountBySurveyAndNature($data_source,$id,$survey,$nature){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('nature' , $nature)->where('survey_level', $survey)->count();
    
  }

  public function getYearlyIndicatorCountByColumnNotNull($data_source,$id,$survey,$year,$column){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('survey_level', $survey)->where('current_year', $year)->where($column,"!=", "")->count();

  }


  public function getYearlyIndicatorCountBySurveyAndNature($data_source,$id,$survey,$nature,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->whereIn(trim('nature') , $nature)->whereIn('survey_level', $survey)->where('current_year', $year)->count();
    

  }

  
  public function getIndicatorCountByDivSpecificName($data_source,$id,$column){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('division_id',"!=",null)->where($column,"!=", "")->count();

  }
  public function getIndicatorCountBySpecificName($data_source,$id,$survey,$column){
    
    return MainIndicator::where('data_source_name',$data_source)
  ->where('indicator_id',$id)->whereIn('survey_level', $survey)->where($column,"!=", "")->get();

  }

  public function getYearlyIndicatorCountBySpecificName($data_source,$id,$survey,$column,$year){
    
      return MainIndicator::where('data_source_name',$data_source)
      ->where('indicator_id',$id)->whereIn('survey_level', $survey)->where($column,"!=", "")->where('current_year', $year)->get();

  }

  public function getYearlyIndicatorCountByDivSpecificName($data_source,$id,$column,$year){

    return MainIndicator::where('data_source_name',$data_source)
         ->where('indicator_id',$id)->where('division_id',"!=",null)->where('current_year', $year)->where($column,"!=", "")->get();

  }

  // DISTRICT

    
  public function getIndicatorCountByDistrictSexNull($data_source,$id){
  
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('sex',"!=", "")->count();
   
  }

  public function getIndicatorCountByNatureDistrict($data_source,$id,$nature){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('nature' , $nature)->where('district_id',"!=",null)->count();
  
  }

  public function getYearlyIndicatorCountByNatureDistrictNull($data_source,$id,$year,$nature){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('nature' , $nature)->where('district_id',"!=",null)->where('current_year', $year)->count();
  }

  public function getIndicatorCountByDistrictResidenceNull($data_source,$id){

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('residence',"!=", "")->count();
    
  }

  public function getIndicatorCountByDistrictAgeNull($data_source,$id){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('age_group',"!=", "")->count();
    }

  public function getIndicatorCountByDistSpecificName($data_source,$id,$column){
   
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where($column,"!=", "")->count();

  }

  public function getYearlyIndicatorCountByDistrictSexNull($data_source,$id,$year){
   
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('current_year', $year)->where('sex',"!=", "")->count();

  }

  public function getYearlyIndicatorCountByDistrictResidenceNull($data_source,$id,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('current_year', $year)->where('residence',"!=", "")->count();

  }

  public function getYearlyIndicatorCountByDistrictAgeNull($data_source,$id,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('current_year', $year)->where('age_group',"!=", "")->count();

  }

  public function getYearlyIndicatorCountByDistSpecificName($data_source,$id,$column,$year){

    return MainIndicator::where('data_source_name',$data_source)
         ->where('indicator_id',$id)->where('district_id',"!=",null)->where('current_year', $year)->where($column,"!=", "")->get();

  }

  // INDICATOR OPTION

  
  public function getIndicatorBySurveyAndYear($data_source,$id, $survey,$year){
    
    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->whereIn('survey_level', $survey)->where('current_year', $year);

  }


  public function getYearlyIndicatorByDistrictNotNull($data_source,$id,$year){

    return MainIndicator::where('data_source_name',$data_source)
    ->where('indicator_id',$id)->where('district_id',"!=",null)->where('current_year', $year);

  }

  public function getYearlyIndicatorByDivisionNotNull($data_source,$id,$year){

    return MainIndicator::where('data_source_name',$data_source)
        ->where('indicator_id',$id)->where('division_id',"!=",null)->where('current_year', $year);
  
  }

  public function getIndicatorInfoBySurveyAndId($id, $survey){

    return MainIndicator::where('indicator_id',$id)->whereIn('survey_level', $survey)->first();

  }

  
  public function getNationalLevelIndicator($id){

    return MainIndicator::where('indicator_id',$id)->where('survey_level',"National")
    ->where("residence","")->where("age_group","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->where('sex', "")->first();


  }
  public function getIndicatorAttr($id){

    return MainIndicator::where('indicator_id',$id)
    ->where("residence","")->where("age_group","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->where('sex', "")->orderBy('current_year' , 'DESC')->get();


  }

  public function getGenderIndicator($id)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where("residence","")->where("age_group","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->where('sex','!=',"")->orderBy('current_year' , 'DESC')->get();

  }
  public function getGenderIndicatorforDemographics($id)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where("residence","")->where("age_group",'!=',"")
    ->where("specific_name1","")
    ->where("specific_name2",'!=',"")
    ->where("specific_name3","")->where('sex','!=',"")->orderBy('current_year' , 'DESC')->get();

  }
  public function getSpecificIndicator($id)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where("residence","")->where("age_group","")
    ->where('specific_name1','!=',"")->where('specific_description1','!=',"")
    ->where('sex', "")->orderBy('current_year' , 'DESC')->orderby('id','ASC')->get();

  }
  public function getSpecificColumnIndicator($id,$column)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where('specific_description2','!=',"")
    ->where($column,'!=',"")->orderBy('current_year' , 'DESC')
    ->get();

  }
  

  public function getIndicatorInfo($id)
  {
    return MainIndicator::where('indicator_id',$id)->orderBy('id','ASC')->orderBy('current_year' , 'DESC')->get();

  }

  
  public function getResidenceIndicator($id)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where("age_group","")->where("sex","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->where('residence','!=',"")->orderBy('current_year' , 'DESC')->get();

  }
  public function getAgeGroupIndicator($id)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where("residence","")->where("sex","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->whereNotNull('age_group')->orderBy('current_year' , 'DESC')->get();

  }

  public function getAgeSpecificInfoIndicator($id)
  {
    return MainIndicator::where('indicator_id',$id)
    ->where("specific_name1",'!=',"")
    ->where('age_group','!=',"")->orderBy('current_year' , 'DESC')->orderBy('id','ASC')->get();

  }
  

  public function getProvincialLevelIndicator($id){

    return MainIndicator::where('indicator_id',$id)->where('survey_level', "Province")
    ->where("residence","")->where("age_group","")
    ->where("specific_name1","")
    ->where("specific_name2","")
    ->where("specific_name3","")->where('sex', "")->first();


  }

  public function getDistinctAgeGroup()
  {

    return MainIndicator::distinct('age_group')->whereNotIn('age_group',[""])->pluck('age_group');
  }

  public function getDistinctDataSources()
  {

    return MainIndicator::distinct('data_source_name')->whereNotIn('data_source_name',[""])->pluck('data_source_name');
  }
  public function getDistinctSpecificDis()
  {

    return MainIndicator::distinct('specific_description1')->whereNotIn('specific_description1',[""])->pluck('specific_description1');
  }

  public function storeIndicatorInfo($object){

    return DB::transaction(function() use ($object){
      $main_indicator = new MainIndicator;
      
      $main_indicator->indicator_id               = $object['indicator_id'];
      $main_indicator->data_source_name                 = $object['data_source_name'];
      $main_indicator->survey_level                 = $object['survey_level'];

      if($object['survey_level'] != "National")
      {
        if(isset($object['province_id'])){
          $main_indicator->province_id                 = $object['province_id'];

        }
        if(isset($object['division_id'])){
      $main_indicator->division_id                 = $object['division_id'];
        
        }
        if(isset($object['district_id'])){
       $main_indicator->district_id                 = $object['district_id'];
       
        }

      }
      $main_indicator->sex                 = $object['sex'];
      $main_indicator->age_group                 = $object['age'];
      $main_indicator->residence                 = $object['residence'];
      $main_indicator->unit                 = $object['unit'];
      $main_indicator->base_year                 = $object['base_year'];
      $main_indicator->base_value                 = $object['base_value'];
      $main_indicator->current_year                 = $object['current_year'];
      $main_indicator->current_value                 = $object['current_value'];
      $main_indicator->footnote                 = $object['footnote'];
      $main_indicator->nature                 = $object['nature'];
      $main_indicator->lower_year                 = $object['lower_year'];
      $main_indicator->upper_year                 = $object['upper_year'];
      $main_indicator->specific_name1                 = $object['specific_name1'];
      $main_indicator->specific_description1                 = $object['specific_description1'];
      $main_indicator->specific_name2                 = $object['specific_name2'];
      $main_indicator->specific_description2                 = $object['specific_description2'];
      $main_indicator->specific_name3                 = $object['specific_name3'];
      $main_indicator->specific_description3                 = $object['specific_description3'];
      $main_indicator->source_link                 = $object['source_link'];
      // $main_indicator->last_updated                 = $object['last_updated'];
      $main_indicator->save();

      return with($main_indicator);
    });

}
  public function province()
  {
    return $this->belongsTo(Province::class,'province_id')->withDefault();
  }

  public function division()
  {
    return $this->belongsTo(Division::class,'division_id')->withDefault();
  }

  public function district()
  {
    return $this->belongsTo(District::class,'district_id')->withDefault();
  }

}
