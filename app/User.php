<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use DB;
use EF;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllUser()
    {
        return  User::get();
    }

    public function getUserById($id)
    {
        
        return User::find($id);
    }

    public function getUserByRegId($id)
    {
        return User::where('registration_id' , $id)->first();
    }

    public function storeUser($object)
    {
        return DB::transaction(function () use ($object)  {

            $user            =  new User;

            $user->name      = $object['name'];
            $user->fname     = $object['fname'];
            $user->cnic      = $object['cnic'];
            $user->contact   = $object['contact'];
            $user->email     = $object['email'];
            $user->password  = $object['password'];
            $user->status    = $object['status'];

            // $user->type      = $object['type'];

            $user->save();

            return with($user);
        });
    }

    public function updateUser($object)
    {
        return \DB::transaction(function () use ($object){

        $user = User::find($object['user']);
        if(isset($user->id))
        {
            $user = $this->model;
            $user->name      = $object['name'];
            $user->fname     = $object['fname'];
            $user->cnic      = $object['cnic'];
            $user->contact   = $object['contact'];
            $user->email     = \EF::autoGenerateEmail($object['email'],$user->email);
            $user->password  = EF::autoGeneratePassword($object['password']);
            $user->status    = $object['status'];
            // $user->type      = $object['type'];

            $user->update();    

        }
        return with($user);
    });
}

    public function removeUser($id)
    {
        return \DB::transaction(function () use ($id)
    {
        $flag = false;

        $user = User::find($id);

        if(isset($user->id))
        {
            $user->delete();

            $flag = true;

        }
        return with($flag);
    });
   }

   public function register()
   {
     return $this->belongsTo(Registration::class , 'registration_id')->withDefault();
   }



}
