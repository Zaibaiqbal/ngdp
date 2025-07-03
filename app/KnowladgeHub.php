<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class KnowladgeHub extends Model
{
    public function getAllKnowladge()
    {
        return KnowladgeHub::orderBy('id','DESC')->paginate(10);
    }

    public function getAllKnowladgecount()
    {
        return KnowladgeHub::count();
    }
    public function getKnowladgeByThemeId($id)
    {
        return KnowladgeHub::join('knowledge_themes','knowledge_themes.id','=','knowladge_hubs.knowledge_theme_id')
        ->where('knowladge_hubs.knowledge_theme_id',$id)
         ->selectRaw('knowladge_hubs.id,knowladge_hubs.title,knowladge_hubs.author,knowladge_hubs.organization,knowladge_hubs.summary,knowladge_hubs.url,knowladge_hubs.thumbnail,knowladge_hubs.pdf,knowladge_hubs.publication_date,count(knowladge_hubs.id) as count')
         ->groupBy('knowladge_hubs.id','knowladge_hubs.title','knowladge_hubs.author','knowladge_hubs.organization','knowladge_hubs.summary','knowladge_hubs.url','knowladge_hubs.thumbnail','knowladge_hubs.pdf','knowladge_hubs.publication_date')
         ->get();

    }

    public function getKnowladgeHubDistinctList($column)
    {
        return KnowladgeHub::distinct($column)->pluck($column)->toArray();
    }

    public function getKnowladgeByKnowledgeThemeId($theme_ids = [])
    {
        return KnowladgeHub::whereIn('knowledge_theme_id' , $theme_ids )->get();
    }
    
    
    public function getKnowladgeByKnowledgeTheme($value)
    {
       return KnowladgeHub::whereHas('knowledgeTheme',function($query) use($value) {

        $query->where('name', 'like', '%' . $value . '%');

       })->orderBy('id','DESC')->get();
    }

    public function getKnowladgeByKnowledgeThemekeyword($value,$keyword)
    {
      if($keyword != "" && $keyword != null)
      {
      $val =  KnowladgeHub::where('title' , 'iLIKE' , '%'.$keyword.'%')
      ->orWhere('publication_date' , 'iLIKE' , '%'.$keyword.'%')->orWhere('author' , 'iLIKE' , '%'.$keyword.'%')
      ->orWhere('organization' , 'iLIKE' , '%'.$keyword.'%')->orWhere('summary' , 'iLIKE' , '%'.$keyword.'%')
      ->orWhere('url' , 'iLIKE' , '%'.$keyword.'%')
      ->get();
      }
      else{
      $val = KnowladgeHub::get();
      }

      if($value != 0)
      {
      $val = $val->where('knowledge_theme_id' , $value);
      }
      return $val;
    }

    public function getKnowladgeHubById($id)
    {
        return  KnowladgeHub::find($id);
    }

    public function storeKnowladgeHub($object)
    {
        return DB::transaction(function () use ($object)  {

            $knowladge_hub                          =  new KnowladgeHub;
            $knowladge_hub->knowledge_theme_id      =  $object['knowledge_theme'];
            $knowladge_hub->title                   =  $object['title'];
            $knowladge_hub->publication_date        =  $object['publication_date'];
            $knowladge_hub->author                  =  $object['author'];
            $knowladge_hub->organization            =  $object['organization'];
            $knowladge_hub->summary                 =  $object['summary'];
            $knowladge_hub->url                     =  $object['source'];
            $knowladge_hub->thumbnail               =  \EF::fileLinker($object['thumbnail']);
            $knowladge_hub->pdf                     =  \EF::fileLinker($object['pdf']);


            $knowladge_hub->save();

            return with($knowladge_hub);
        });
    }

   public function updateKnowladgeHub($object)
    {
        return \DB::transaction(function () use ($object) {

          $knowladge_hub = KnowladgeHub::find($object['knowladge_hub']);

          if(isset($knowladge_hub->id))
          {
              $knowladge_hub->knowledge_theme_id  =  $object['knowledge_theme'];
              $knowladge_hub->title               =  $object['title'];
              $knowladge_hub->publication_date    =  $object['publication_date'];
              $knowladge_hub->author              =  $object['author'];
              $knowladge_hub->organization        =  $object['organization'];

              $knowladge_hub->summary             =  $object['summary'];
              $knowladge_hub->url                 =  $object['source'];

              $knowladge_hub->thumbnail           =  EF::fileLinker($object['thumbnail'],$knowladge_hub->thumbnail);

              $knowladge_hub->pdf                 =   EF::fileLinker($object['pdf'],$knowladge_hub->pdf);

              $knowladge_hub->update();



          }


          return with($knowladge_hub);

    });
  }

  public function removeKnowladgeHub($id)
  {
     return \DB::transaction(function () use ($id)
     {
          $flag = false;

          $knowladge_hub = KnowladgeHub::find($id);

          if (isset($knowladge_hub->id))
          {
              $knowladge_hub->delete();

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
