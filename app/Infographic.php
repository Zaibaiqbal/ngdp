<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class Infographic extends Model
{

    public function getAllInfographic()
    {
        return Infographic::orderBy('id','DESC')->paginate(10);
    }
    public function getAllInfographiccount()
    {
        return Infographic::count();
    }

    public function getInfographicByKnowledgeThemeId($theme_ids = []){

        return Infographic::whereIn('knowledge_theme_id' , $theme_ids )->get();
    }

    public function getInfographicsByThemeId($id)
    {
        return Infographic::join('knowledge_themes','knowledge_themes.id','=','infographics.knowledge_theme_id')

       ->where('infographics.knowledge_theme_id',$id)

        ->selectRaw('infographics.id,infographics.title,infographics.new_year,infographics.institution,infographics.image,infographics.url,count(infographics.id) as count')
        
        ->groupBy('infographics.id','infographics.title','infographics.new_year','infographics.institution','infographics.image','infographics.url')
        ->get();
    }

    public function getInfographicByKnowledgeTheme($value)
    {
       return Infographic::whereHas('knowledgeTheme',function($query) use($value) {

        $query->where('name', 'like', '%' . $value . '%');

       })->orderBy('id','DESC')->get();
    }

    public function getInfographicByKnowledgeThemekeyword($value,$keyword)
    {
      if($keyword != "" && $keyword != null)
      {
      $val =  Infographic::where('image' , 'iLIKE' , '%'.$keyword.'%')
      ->get();
      }
      else{
      $val = Infographic::get();
      }

      if($value != 0)
      {
      $val = $val->where('knowledge_theme_id' , $value);
      }

      return $val;
    }


    public function getInfographicById($id)
    {
        return  Infographic::find($id);
    }

    public function storeInfographic($object)
    {
        return DB::transaction(function () use ($object)  {



             $info_graphic                         =  new Infographic;

             $info_graphic->knowledge_theme_id      =  $object['knowledge_theme'];

             $info_graphic->title                   =  $object['title'];

             $info_graphic->url                     = $object['source'];

            //  $info_graphic->new_year               =  $object['new_year'];

            //  $info_graphic->institution               =  $object['institution'];

             $info_graphic->image    =  EF::fileLinker($object['image']);

             $info_graphic->save();

             return with($info_graphic);

        });
    }

    public function updateInfographic($object)
    {
        return \DB::transaction(function () use ($object) {

         $info_graphic = Infographic::find($object['info_graphics']);

          if(isset($info_graphic->id))
          {

            $info_graphic->knowledge_theme_id      =  $object['knowledge_theme'];

            $info_graphic->title                   =  $object['title'];

            $info_graphic->url                     = $object['source'];

            $info_graphic->institution               =  $object['institution'];

            $info_graphic->new_year               =  $object['new_year'];

            $info_graphic->image                   =  EF::fileLinker($object['image'],$info_graphic->image);

            $info_graphic->update();
          }


          return with($info_graphic);

    });
  }

  public function removeInfographic($id)
  {
     return \DB::transaction(function () use ($id)
     {
          $flag = false;

         $info_graphic = Infographic::find($id);

          if (isset($knowladge_hub->id))
          {
             $info_graphic->delete();

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
