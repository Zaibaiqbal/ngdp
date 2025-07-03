<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MainIndicatorRequest;
use App\Information;
use App\Requirement;
use App\Qualitative;
use App\TargetName;
use App\NewIndicator;
use App\MainIndicator;
use App\ChildInformation;
use App\ChildSpecific;
use App\HeadSpecific;
use App\Sdg;
use App\RegSdg;
use App\Target;
use App\Province;
use App\Division;
use App\District;
use EF;
use Session;

class MainIndicatorController extends Controller
{
    public function storeIndicatorInfo(MainIndicatorRequest $request)
    {
        try
        {
  
          $form_collect = $request->input();
          $form_collect['indicator_id'] = decrypt($form_collect['indicator_id']);

          $info                          = new 	MainIndicator;
          
          $curr_indicator_info = $info->storeIndicatorInfo($form_collect);

         if(isset($curr_indicator_info->id))
         {

            Session::flash('success', "Information Added Successfully");


         }
  
          }
  
        catch (DecryptException $e)
        {
  
        }
        return redirect()->back();
    }
}
