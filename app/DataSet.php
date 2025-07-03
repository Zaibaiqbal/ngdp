<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class DataSet extends Model
{
    public function getAllDataSet()
    {
        return DataSet::orderBy('id','DESC')->paginate(10);
    }
    public function getAllDataSetcount()
    {
        return DataSet::count();
    }

    public function getDataSetsByThemeId($id)
    {
        return Dataset::join('knowledge_themes','knowledge_themes.id','=','data_sets.knowledge_theme_id')
       ->where('data_sets.knowledge_theme_id',$id)
        ->selectRaw('data_sets.id,data_sets.title,data_sets.new_year,data_sets.institution,data_sets.summary,data_sets.url,data_sets.pdf,count(data_sets.id) as count')
        ->groupBy('data_sets.id','data_sets.title','data_sets.new_year','data_sets.institution','data_sets.summary','data_sets.url','data_sets.pdf')
        ->get();
    }
    
    public function getDataSetByKnowledgeThemeId($theme_ids = []){
        
        return DataSet::whereIn('knowledge_theme_id' , $theme_ids )->get();
    }

    public function getDataSetByKnowledgeTheme($value)
    {
       return DataSet::whereHas('knowledgeTheme',function($query) use($value) {

        $query->where('name', 'like', '%' . $value . '%');

       })->orderBy('id','DESC')->get();
    }


    public function getDataSetByKnowledgeThemekeyword($value,$keyword)
    {

      if($keyword != "" && $keyword != null)
      {
      $val =  DataSet::where('title' , 'iLIKE' , '%'.$keyword.'%')
      ->orWhere('url' , 'iLIKE' , '%'.$keyword.'%')->orWhere('summary' , 'iLIKE' , '%'.$keyword.'%')
      ->get();
      }
      else{
      $val = DataSet::get();
      }
      if($value != 0)
      {
      $val = $val->where('knowledge_theme_id' , $value);
      }

      return $val;
    }


    public function getDataSetById($id)
    {
        return  DataSet::find($id);
    }

    public function storeDataSet($object)
    {
        return DB::transaction(function () use ($object)  {

           $data_set                    =  new DataSet;

           $data_set->knowledge_theme_id      =  $object['knowledge_theme'];
           $data_set->title             =  $object['title'];
           $data_set->summary =  $object['summary'];
        
           $data_set->url               =  $object['source'];
           $data_set->pdf                     =  \EF::fileLinker($object['pdf']);



           $data_set->save();

            return with($data_set);
        });
    }

   public function updateDataSet($object)
    {
        return \DB::transaction(function () use ($object) {

         $data_set = DataSet::find($object['data_set']);

          if(isset($data_set->id))
          {

           $data_set->knowledge_theme_id      =  $object['knowledge_theme'];
           $data_set->title             =  $object['title'];
           $data_set->summary           =  $object['summary'];
           $data_set->url               =  $object['source'];
           $data_set->institution               =  $object['institution'];
           $data_set->new_year               =  $object['new_year'];
           $data_set->pdf                 =   EF::fileLinker($object['pdf'],$data_set->pdf);


           $data_set->update();




          }


          return with($data_set);

    });
  }

  public function removeDataSet($id)
  {
     return \DB::transaction(function () use ($id)
     {
          $flag = false;

         $data_set = DataSet::find($id);

          if (isset($data_set->id))
          {
             $data_set->delete();

              $flag = true;
          }

          return with($flag);

     });

  }

    public function knowledgeTheme()
    {
        return $this->belongsTo(KnowledgeTheme::class, 'knowledge_theme_id')->withDefault();
    }
}
