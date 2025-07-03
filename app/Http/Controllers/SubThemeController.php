<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests\SubThemeRequest;
use App\Qualitative;
use App\Theme;
use App\SubTheme;
use App\Requirement;
use App\Information;
use App\ChildInformation;

use Session;

use EF;


class SubThemeController extends Controller
{

    public function storeSubTheme(SubThemeRequest $request)
    {
        try
        {
            $form_collect = $request->input();
            $form_collect['theme'] = decrypt($form_collect['theme']);

            $sub_theme = new SubTheme;
            $sub_theme->storeSubTheme($form_collect);
        }
        catch(Exception $e)
        {

        }
        Session::flash('success', "SubTheme Added Successfully");

        EF::createLogs('Sub theme has added successfully');
        Session::put('theme_key', $form_collect['theme']);
        return redirect()->back();

    }

    public function updateSubTheme(SubThemeRequest $request)
    {
        try
        {
            $form_collect = $request->input();

            $form_collect['theme_id']    = decrypt($form_collect['theme']);

            $form_collect['subtheme'] = decrypt($form_collect['subtheme']);

            $subtheme = SubTheme::where('id', $form_collect['subtheme'])->first();

            $subtheme->name = $request->name;
            $subtheme->update();
        }
        catch(Exception $e)
        {

        }
        Session::flash('success', "SubTheme Updated Successfully");

        EF::createLogs('Sub theme has updated successfully');

        return redirect()->back();

    }

    public function removeSubTheme(Request $request)
	{

        try
        {
          $id = decrypt($request->subtheme);

          $sub_theme = new SubTheme;

          if ($subtheme->removeSubTheme($id))
          {

            $indicator = Requirement::where('sub_theme_id' , $id)->get();
            foreach ($indicator as  $value)
              {
                $info = Information::where('requirement_id', $value->id)->get();
              foreach($info as $in)
              {
                $child  = ChildInformation::where('information_id', $in->id)->get();
                foreach ($child as $ch) {
                  $child->delete();
                }
                $in->delete();
              }
              $qualitative = Qualitative::where('requirement_id', $value->id)->get();
              foreach ($qualitative as $data) {
                $data->delete();
              }
              $value->delete();
            }

          }
        }
        catch (Exception $e)
        {

        }
        Session::flash('success', "SubTheme Deleted Successfully");

        EF::createLogs('Sub theme has removed successfully');

        return redirect()->back();
	}
}
