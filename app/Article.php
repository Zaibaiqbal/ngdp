<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class Article extends Model
{
    public function getAllArticle()
    {
        return Article::orderBy('id','DESC')->paginate(10);
    }
    public function getAllArticlecount()
    {
        return Article::count();
    }

    public function getArticlesByThemeId($id)
    {
        return Article::join('knowledge_themes','knowledge_themes.id','=','articles.knowledge_theme_id')
       ->where('articles.knowledge_theme_id',$id)
        ->selectRaw('articles.id,articles.title,articles.year,articles.author_affilication,articles.volume,articles.issues,articles.pages,articles.pdf,articles.isbn,count(articles.id) as count')
        
        ->groupBy('articles.id','articles.title','articles.year','articles.author_affilication','articles.volume','articles.issues','articles.pages','articles.pdf','articles.isbn')
        ->get();
    }

    public function getArticleByKnowledgeTheme($value)
    {
       return Article::whereHas('knowledgeTheme',function($query) use($value) {

        $query->where('name', 'like', '%' . $value . '%');

       })->orderBy('id','DESC')->get();
    }

    public function getArticleByKnowledgeThemeId($theme_ids = []){
        
        return Article::whereIn('knowledge_theme_id' , $theme_ids )->get();
    }

    public function getArticleByKnowledgeThemekeyword($value,$keyword)
    {


       if($keyword != "" && $keyword != null)
       {
       $val =  Article::where('title' , 'iLIKE' , '%'.$keyword.'%')
       ->orWhere('url' , 'iLIKE' , '%'.$keyword.'%')->orWhere('author' , 'iLIKE' , '%'.$keyword.'%')
       ->orWhere('author_affilication' , 'iLIKE' , '%'.$keyword.'%')
       ->orWhere('volume' , 'iLIKE' , '%'.$keyword.'%')->orWhere('issues' , 'iLIKE' , '%'.$keyword.'%')
       ->orWhere('isbn' , 'iLIKE' , '%'.$keyword.'%')->get();
       }
       else{
         $val = Article::get();
       }

       if($value != 0)
       {
       $val = $val->where('knowledge_theme_id' , $value);
       }

       return $val;
    }

    public function getArticleById($id)
    {
        return  Article::find($id);
    }

    public function storeArticle($object)
    {
        return DB::transaction(function () use ($object)  {

           $article                     =  new Article;
           $article->knowledge_theme_id =  $object['knowledge_theme'];
           $article->title              =  $object['title'];
           $article->url                =  $object['source'];

           $article->author               =  $object['author'];
           $article->year                 =  $object['year'];
           $article->year                 =  $object['year'];
           $article->author_affilication  = $object['author_affilication'];
           $article->volume               = $object['volume'];
           $article->issues               = $object['issue'];
           $article->pages                = $object['page'];
           $article->isbn                 = $object['isbn'];
           $article->pdf                     =  \EF::fileLinker($object['pdf']);




           $article->save();

            return with($article);
        });
    }

   public function updateArticle($object)
    {
        return \DB::transaction(function () use ($object) {

         $article = Article::find($object['article']);

          if(isset($article->id))
          {

           $article->knowledge_theme_id   =  $object['knowledge_theme'];
           $article->title                =  $object['title'];
           $article->url                  =  $object['source'];

           $article->author               =  $object['author'];
           $article->year                 =  $object['year'];
           $article->year                 =  $object['year'];
           $article->author_affilication  = $object['author_affilication'];
           $article->volume               = $object['volume'];
           $article->issues               = $object['issue'];
           $article->pages                = $object['page'];
           $article->isbn                 = $object['isbn'];

           $article->pdf                 =   EF::fileLinker($object['pdf'],$article->pdf);


           $article->update();




          }


          return with($article);

    });
  }

  public function removeArticle($id)
  {
     return \DB::transaction(function () use ($id)
     {
          $flag = false;

         $article = Article::find($id);

          if (isset($article->id))
          {
             $article->delete();

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
