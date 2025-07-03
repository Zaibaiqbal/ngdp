<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
  public function getRegisterByStatus(){

    return Registration::where('status',1)->get();
  }


   public function user()
   {
     return $this->belongsTo(User::class , 'registration_id')->withDefault();
   }
}
