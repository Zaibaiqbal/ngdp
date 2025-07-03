<?php

namespace App;

use DB;
use EF;
use Illuminate\Database\Eloquent\Model;

class OtherKnowladge extends Model
{
    public function getAllOtherKnowledge()
    {
        return OtherKnowladge::orderBy('id','DESC')->get();
    }


    public function getAllOtherKnowledgecounttrain()
    {
        return OtherKnowladge::where('type' , "Training Material")->count();
    }
    public function getAllOtherKnowledgecountbook()
    {
        return OtherKnowladge::where('type' , "Booklets")->count();
    }
    public function getAllOtherKnowledgecountpamp()
    {
        return OtherKnowladge::where('type' , "Pamphlets")->count();
    }
    public function getAllOtherKnowledgecountpost()
    {
        return OtherKnowladge::where('type' , "Posters / Leaflets")->count();
    }

    public function getOtherKnowledgeByKnowledgeThemeId($theme_ids = []){
        return OtherKnowladge::whereIn('knowledge_theme_id' , $theme_ids )->get();
    }
    
    public function getAllOtherKnowledgeByTypeId($id,$type = [])
    {
        return OtherKnowladge::join('knowledge_themes','knowledge_themes.id','=','other_knowladges.knowledge_theme_id')
        ->where('other_knowladges.knowledge_theme_id',$id)
        ->where('other_knowladges.type',$type)
         ->selectRaw('other_knowladges.id,other_knowladges.title,other_knowladges.new_year,other_knowladges.institution,other_knowladges.url,other_knowladges.pdf,other_knowladges.type')
         ->groupBy('other_knowladges.id','other_knowladges.title','other_knowladges.new_year','other_knowladges.institution','other_knowladges.url','other_knowladges.pdf','other_knowladges.type')
         ->get();
    }
    public function getOtherKnowledgeByKnowledgeTheme($value)
    {
       return OtherKnowladge::whereHas('knowledgeTheme',function($query) use($value) {

        $query->where('name', 'like', '%' . $value . '%');

       })->orderBy('id','DESC')->get();
    }

    public function getOtherKnowledgeByKnowledgeThemekeyword($value,$keyword)
    {
      if($keyword != "" && $keyword != null)
      {
      $val =  OtherKnowladge::where('title' , 'iLIKE' , '%'.$keyword.'%')
      ->orWhere('url' , 'iLIKE' , '%'.$keyword.'%')->orWhere('type' , 'iLIKE' , '%'.$keyword.'%')
      ->get();
      }
      else{
        $val = OtherKnowladge::get();
      }

      if($value != 0)
      {
      $val = $val->where('knowledge_theme_id' , $value);
      }
      return $val;
    }

    public function getOtherKnowledgeById($id)
    {
        return  OtherKnowladge::find($id);
    }

    public function storeOtherKnowledge($object)
    {
        return DB::transaction(function () use ($object)  {

           $other_knowledge                    =  new OtherKnowladge;
           $other_knowledge->knowledge_theme_id =  $object['knowledge_theme'];
           $other_knowledge->title              =  $object['title'];
           $other_knowledge->type                =  $object['type'];
           $other_knowledge->url                  =  $object['source'];
        //    $other_knowledge->new_year               =  $object['new_year'];
        //    $other_knowledge->institution               =  $object['institution'];
           $other_knowledge->pdf                     =  \EF::fileLinker($object['pdf']);




           $other_knowledge->save();

            return with($other_knowledge);
        });
    }

   public function updateOtherKnowledge($object)
    {
        return \DB::transaction(function () use ($object) {

         $other_knowledge = OtherKnowladge::find($object['other_knowledge']);

          if(isset($other_knowledge->id))
          {

           $other_knowledge->knowledge_theme_id   =  $object['knowledge_theme'];
           $other_knowledge->title                =  $object['title'];
           $other_knowledge->type                 =  $object['type'];
           $other_knowledge->url                  =  $object['source'];
           $other_knowledge->new_year               =  $object['new_year'];
           $other_knowledge->institution               =  $object['institution'];
           $other_knowledge->pdf                 =   EF::fileLinker($object['pdf'],$other_knowledge->pdf);

           $other_knowledge->update();

          }
          
          return with($other_knowledge);

    });
  }

  public function removeOtherKnowledge($id)
  {
     return \DB::transaction(function () use ($id)
     {
          $flag = false;

         $other_knowledge= OtherKnowladge::find($id);

          if (isset($other_knowledge->id))
          {
             $other_knowledge->delete();

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
