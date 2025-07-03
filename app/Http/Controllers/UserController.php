<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

use App\Repositories\UserRepository;
use App\Registration;
use App\User;
use App\CustomRole;
use Session;
use EF;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{

    public function createuser()
    {
      $roles = new CustomRole;
      $roles = $roles->getRoleList();
        return view('users.register',
      [
        'roles' => $roles,
      ]);
    }

    public function userlist()
    {
        $register = new Registration;
        $curr_register = $register->getRegisterByStatus();

        $roles = new CustomRole;

        $roles = $roles->getRoleList();

        return view('users.userlist',[
          'users' => $curr_register,
          'roles' => $roles,
        ]);
    }

    public function registeruser()
    {
      Session::flash('success', "User Added Successfully, username and password sent to email!");
      return redirect()->back();
    }

    public function gismap()
    {
        return view('maptest');
    }


    public function loginAjax(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $authSuccess = Auth::attempt($credentials, $request->has('remember'));

        if($authSuccess) {
            $request->session()->regenerate();
            return response()->JSON(['success' => true], 200);
        }

        return
            response()->JSON([
                'success' => false,
                'message' => 'Auth failed (or some other message)'
            ], 500);
    }

    public function reguser(Request $request)
    {
      try{
        $request->validate([
          'email' => 'required|email|unique:registrations',
     ]);

     $details = [];
     $details['name'] = $request->name;
     $details['email'] = $request->email;
     $details['address'] = $request->address;
     $details['gender'] = $request->gender;
     $details['contact'] = $request->contact;
     $details['option1'] = $request->option1;
     $details['option2'] = $request->option2;


     if(User::where('email', $request->email)->count() > 0)
     {
       Session::flash('error', "Email Already Exsists!");
       return redirect()->back();
     }
     $user = new Registration();
     $user->name =$request->name;
     $user->email = $request->email;
     $user->address = $request->address;
     $user->gender = $request->gender;
     $user->option1 = $request->option1;
     $user->option2 = $request->option2;
     $user->contact = $request->contact;
     $user->designation = $request->designation;
     $user->level = $request->level;
     $user->degree = $request->degree;
     $user->profession = $request->prof;
     $user->organization = $request->organization;

     $user->status = 0;
    
     $user->save();

       \Mail::to($request->email)->send(new \App\Mail\RegisterMail($details));
       Session::flash('success', "Request has been submited and email has been sent!");

       return redirect()->route('index');

      }
      catch(DecryptException $e)
      {

      }
   
    }

    public function userdetails($id)
    {
      $details = [];
      $id = decrypt($id);
      $user = User::where('registration_id', $id)->first();
      $register = Registration::where('id', $id)->first();


      return view('users.userdetails',[
        'user' => $user,
        'register' => $register,
      ]);
    }

    public function changerole(Request $request)
    {
      $details = [];

      $id = decrypt($request->user_id);

      $user = User::where('registration_id', $id)->first();


       $user->syncRoles($request->role);

        Session::flash('success', "Role Has been changed!");
        return redirect()->back();
    }
    public function approveuser(Request $request)
    {
      $details = [];
      $id = decrypt($request->user_id);
      $register = Registration::where('id', $id)->first();
      $register->status = 1;
      $register->save();
      $details['name'] = $register->name;
      $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
      $password = substr($random, 0, 10);
      $details['password'] = $password;
      $details['email'] = $register->email;
      $details['address'] = $register->address;
      $details['gender'] = $register->gender;
      $details['contact'] = $register->contact;
      $details['option1'] = $register->option1;
      $details['option2'] = $register->option2;

      $curr_user = new User();
      $curr_user = $curr_user->getUserByRegId($register->id);

      if(!isset($curr_user->id))
      {
        $user = new User();
        $user->name =$register->name;
        $user->email = $register->email;
        $user->address = $register->address;
        $user->gender = $register->gender;
        $user->contact = $register->contact;
        $user->registration_id = $register->id;
        $user->password = bcrypt($details['password']);
        $user->save();
  
        $user->assignRole($request->role);
  
  
          \Mail::to($register->email)->send(new \App\Mail\UserMail($details));
          Session::flash('success', "Request has been Approved and email has been sent!");
          return redirect()->back();
      }
      else
      {
        Session::flash('error', "User already approved");
        return redirect()->back();
      }
     
    }

    public function rejectuser(Request $request)
    {
      $details = [];
      $id = decrypt($request->user_id);
      $register = Registration::where('id', $id)->first();
      $register->status = 2;
      $register->save();
   
        Session::flash('success', "Request has been Reject!");
        return redirect()->back();
    }

    public function registerlist()
    {
      $details = [];

      $register = Registration::where('status', 0)->get();

      $roles = new CustomRole;
      $roles = $roles->getRoleList();
        return view('users.registerlist',
      [
        'roles' => $roles,
        'users' =>$register,
      ]);
    }


    public function index()
    {
        try
        {
            $user = new User;

            $user_list = $user->getAllUser();

            return $user_list;
        }
        catch(Exception $e)
        {

        }
        return redirect()->back();
    }

    public function storeUser(UserRequest $request)
    {
        try
        {
            $form_collect = $request->input();
            $user = new User;

            $user->storeUser($form_collect);
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    } 

    public function updateUser(UserRequest $request)
    {
        try
        {
           $form_collect = $request->input();
           $form_collect['user'] = decrypt($form_collect['user']);
           $user = new User;

           $user->updateUser($form_collect);
          
        }

        catch(Exception $e)
        {

        }
        return redirect()->back();
    }

    public function removeUser($id)
    {
        try
        {
            $id   = decrypt($id);
            $user = new User;
            if($user->removeUser($id))
            {

            }
        }
        catch(Exception $e)
        {

        } 
        return redirect()->back();
    }

    public function changeUserPassword(Request $request)
    {
        try
        {
          if($request->isMethod('post'))
          {


            $request->validate([
              'password'              => 'required| min:8|confirmed',
              'password_confirmation' => 'required| min:8',
              'user_id'               =>   'required'
            ]);


              $id   = decrypt($request->user_id);
              $user = new User;

              $user = $user->getUserByRegId($id);
              if(isset($user->id))
              {

                  $user->password = bcrypt($request->password);
                  $user->update();

                  $details = [

                    'name'        =>   $user->name,
                    'email'       =>   $user->email,
                    'password'    =>    $request->password
                  ];

                  if(Auth::user()->hasRole('Super Admin'))
                  {
                      \Mail::send('emails.change_password', ['details' => $details], function($message) use($user){
                        $message->to($user->email);
                        $message->subject('Reset Password Confirmation');
                      });
                   }

                  // \Mail::to($user->email)->send(new \App\Mail\UserMail($details));
                  Session::flash('success', "Password changed successfully!");
                  return redirect()->back();

              }

              Session::flash('error', "Record not found");
              exit;
              return redirect()->back();

          }
          else
          {
            $user = new User;
            $user = $user->getUserById(Auth::user()->id);

            return view('users.modals.change_password',['register' => $user->register])->render();
          }

        }
        catch(Exception $e)
        {
          dd($e);
        } 
    }

}
