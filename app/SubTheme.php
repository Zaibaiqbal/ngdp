<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class SubTheme extends Model
{

    public function getAllSubThemes()
    {
        return SubTheme::all();
    }

    public function getSubThemeByThemeIdCount($id)
    {

        return SubTheme::where('theme_id',$id)->count();
    }


    public function getSubThemeCount()
    {
        return SubTheme::count();
    }

    public function getSubThemeById()
    {
        return SubTheme::find($id);
    }

    public function storeSubTheme($object)
    {
        return DB::transaction(function () use ($object)  {
            $subtheme            =  new SubTheme;

            $subtheme->theme_id  = $object['theme'];
            $subtheme->name      = $object['name'];

            $subtheme->save();

            return with($subtheme);
        });
    }

   public function updateSubTheme($object)
    {
        return \DB::transaction(function () use ($object) {

        $subtheme = SubTheme::find($object['subtheme']);

        if (isset($subtheme->id))
        {
            $subtheme             = new SubTheme;
            $subtheme->theme_id   = $object['theme'];
            $subtheme->name       = $object['name'];

            $subtheme->update();
        }

        return with($subtheme);

    });
  }

  public function removeSubTheme($id)
  {
     return \DB::transaction(function () use ($id)
     {
          $flag = false;

          $subtheme = SubTheme::find($id);

          if (isset($subtheme->id))
          {
              $subtheme->delete();

              $flag = true;
          }

          return with($flag);

     });

  }
    public function theme()
    {
    	return $this->belongsTo(Theme::class,'theme_id')->withDefault();
    }

    public function quantitative()
    {
        return $this->hasMany(Indicator::class, 'sub_theme_id')->orderBy('id','ASC')->with(['subTheme']);
    }

    public function requirements()
    {
        return $this->hasMany(Indicator::class, 'sub_theme_id')->orderBy('id','ASC')->with(['subTheme']);
    }
}
