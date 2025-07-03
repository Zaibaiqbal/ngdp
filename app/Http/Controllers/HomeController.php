<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showLogs()
    {

        $current_month = date('m-Y');

        $file_name = 'system_logs/'.$current_month.'.json';    

        $file_list = \File::allFiles(\Storage::disk('local')->path('system_logs'));

        $log_list = \Storage::disk('local')->exists($file_name) ? json_decode(\Storage::disk('local')->get($file_name)) : [];

              
        return view('logs',['logs_list' => $log_list, 'file_list' => $file_list]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

}
