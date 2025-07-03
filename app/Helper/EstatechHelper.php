<?php 
namespace App\Helper;
use EF;
use Hash;



class EstatechHelper

{

    public function getYearsList()
    {
        return ['2025','2024','2023','2022','2021','2020','2019','2018','2017','2016','2015','2014','2013','2012','2011','2010'];
    }
    public function numberFormat($value){
        return number_format($value);
    }
    public function removeNumberFormat($value)
    {
        
        return str_replace(',', '', $value);

    }
    public function autoGenerateEmail($email,$old_email = "")
    {
        if(trim(strlen($email)) <= 0)
        {
            if(strlen(trim($old_email)) > 0 && strlen(trim($email)) <= 0 )
            {
                $email = $old_email;
            }
            else
            {
                $email = 'un-women'.uniqid().'@gisplus.net';
            }

        }

        return $email;
    }

    public function autoGeneratePassword($password,$old_password = '')
    {
        if(strlen(trim($password)) <= 0)
        {
            if(strlen(trim($old_password)) > 0 && strlen(trim($password)) <= 0 )
            {
                return $old_password;
            }
            else
            {
                $password = 'un-women'.uniqid().'@#';
            }
        }

        return Hash::make($password);


    }

    public function fileLinker($image,$loaded_image = 'user-icon.png')
    {

        if((isset($image) && trim(strlen($image)) > 0))
        {
            $image =  \EF::createFileLink($image);
        }
        else
        {
            if(strlen(trim($loaded_image)) > 0)
            {
                $image =  $loaded_image;
            }
            else
            {
               $image = 'user-icon.png'; 
            }    
        }
        return $image;
    }

    public  function createFileLink($contant_file)
    {
        $file_name = uniqid().'.'.$contant_file->getClientOriginalExtension();

        \Storage::disk('public')->put('/'.$file_name,file_get_contents($contant_file));

        return $file_name;
    }

    public  function retriveFileLink($file_name)
    {
        if(strlen(trim($file_name)) <= 0)
        {
            return url('graphics/user-icon.png');
        }


        return  \Storage::url($file_name);   
    }

    public function dateFormat($date)
    {
        return str_replace('01-Jan-1970','',date('d-M-Y',strtotime($date)));
    }

    public function datePhpFormat($date)
    {
        return str_replace('1970-01-01','',date('Y-m-d',strtotime($date)));
    }

    public function textWrapping($text)
    {
        return  wordwrap($text,100,"<br>\n");
    }

    public static function createLogs($message)
    {

        $current_month = date('m-Y');
        $file_name = 'system_logs/'.$current_month.'.json';

        try {

           // my data storage location is project_root/storage/app/data.json file.
            $old_logs = \Storage::disk('local')->exists($file_name) ? json_decode(\Storage::disk('local')->get($file_name)) : [];

           $user = \Auth::user();

           if(isset($user->id))
           {
               date_default_timezone_set("Asia/karachi");

               $inputData = array(
                       'user_id'   => $user->id,
                       'name'      => $user->name,
                       'log_date'  => date('d-M-Y'),
                       'log_time'  => date('H:i:s'),
                       'message'   => str_replace('.','', $message.' by '.$user->name).'.',
                   );

               array_push($old_logs,$inputData);

               \Storage::disk('local')->put($file_name, json_encode($old_logs),'public');

           }

       } catch(Exception $e) {

           return ['error' => true, 'message' => $e->getMessage()];

       }
    }

    public function getOtherKnowladgeList()
    {
        return [
            'Training Material',
            'Booklets',
            'Pamphlets',
            'Posters / Leaflets',
        ];
    }

    public function getSurveyLevels()
    {
        return[
            'National',
            'Province',
            'Federal',

        ];
    }



}
