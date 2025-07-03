<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Http\Request;

use App\Repositories\ThemeRepository;

use App\Http\Requests\ThemeRequest;

use App\Theme;
use App\SubTheme;
use App\Requirement;
use App\Information;
use App\ChildInformation;

use Session;

use Crypt;

use EF;


class ThemeController extends Controller
{

 
    public function index()
    {
        try
        {
          $theme = new Theme;
            $theme_list = $theme->getAllTheme();

            return $theme_list;
        }
        catch(Exception $e)
        {

        }
        return redirect()->back();
    }

    public function storeTheme(ThemeRequest $request)
    {
        try
        {
            $form_collect = $request->input();
            $form_collect['image'] = $request->image;
            $theme = new Theme;
            $theme->storeTheme($form_collect);
        }
        catch(Exception $e)
        {

        }
        Session::flash('success', "Theme Added Successfully");

        EF::createLogs('Theme has been added successfully');

        return redirect()->back();

    }

    public function updateTheme(ThemeRequest $request)
    {
      try
        {
            $form_collect = $request->input();

            $form_collect['theme'] = decrypt($form_collect['theme']);
            // $this->theme_repository->updateTheme($form_collect);
            $theme = Theme::where('id' , $form_collect['theme'])->first();
            $theme->name = $form_collect['name'];
            if($request->image)
            {
              $theme->image    =  EF::fileLinker($request->image);
            }
            $theme->update();


        }
        catch(Exception $e)
        {

        }

        EF::createLogs('Theme has been updated successfully');

        return redirect()->back();
    }

	public function removeTheme(Request $request)
	{
        try
        {
          $id = decrypt($request->theme);

          $theme             =  new Theme;

          if ($theme->removeTheme($id))
           {
             $sub = SubTheme::where('theme_id', $id)->get();
             foreach ($sub as  $value) {
               $indicator = Requirement::where('sub_theme_id' , $value->id)->get();
               foreach ($indicator as  $value1) {
                 $info = Information::where('requirement_id', $value1->id)->get();
                 foreach($info as $in)
                 {
                   $child  = ChildInformation::where('information_id', $in->id)->get();
                   foreach ($child as $ch) {
                     $child->delete();
                   }
                   $in->delete();
                 }

                 $value1->delete();
               }
               $value->delete();
             }

           }
        }
        catch (DecryptException $e)
        {

        }
        Session::flash('success', "Theme Deleted Successfully");

        EF::createLogs('Theme has been removed successfully');

        return redirect()->back();
	}

    public function getThemeBySubTheme($id)
    {
        $view = '<option value="'.Crypt::encrypt(0).'">Select Sub Theme</option>';

        try
        {
            $id = decrypt($id);

            $theme             =  new Theme;
            $curr_theme = $theme>getThemeById($id);

            if(isset($curr_theme->id))
            {
                foreach($curr_theme->subTheme as $rows)
                {
                    $view .= '<option value="'.Crypt::encrypt($rows->id).'">'.$rows->name.'</option>';
                }
            }
        }
        catch (DecryptException $e)
        {

        }

        return $view;
    }
}
