<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use EF;

class Theme extends Model
{
    public function getAllThemes()
    {
        return  Theme::all()->orderBy('id','DSC')->get();

    }
    public function getAllKnowledgeTheme()
    {
        return  Theme::all();

    }
    public function getThemeCount()
    {
        return  Theme::count();

    }

    public function getAllTheme()
    {
        return  Theme::with(['subTheme'])->get();
    }


    public function getThemeById($id)
    {
        return  Theme::find($id);
    }

    public function storeTheme($object)
    {
        return DB::transaction(function () use ($object)  {

            $theme             =  new Theme;
            $theme->name       = $object['name'];
            $theme->image    =  EF::fileLinker($object['image']);

            $theme->save();

            return with($theme);
        });
    }

  public function updateTheme($object)
  {
      return \DB::transaction(function () use ($object) {

          $theme = Theme::find($object['theme']);

          if(isset($theme->id))
          {
              $theme->name = $object['name'];

              $theme->update();

          }

          return with($theme);
      });
  }

  public function removeTheme($id)
  {
     return \DB::transaction(function () use ($id)
     {
        $flag = false;

        $theme = Theme::find($id);

        if(isset($theme->id))
        {
            $theme->delete();
            $flag = true;
        }

        return with($flag);
     });

  }

    public function subTheme()
    {
        return $this->hasMany(SubTheme::class, 'theme_id')->with(['requirements']);
    }
}
