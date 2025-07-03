<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeTheme extends Model
{
    public function getAllKnowledgeTheme()
    {
        return  KnowledgeTheme::get();
    }

    public function getAllKnowledgeThemecount()
    {
        return  KnowledgeTheme::count();
    }
    public function getKnowledgeThemeById($id)
    {
        return  KnowledgeTheme::find($id);
    }

    public function searchKnowledgeTheme($search)
    {
    	return KnowledgeTheme::where('name','iLIKE','%'.$search."%")->get();
    }
}
