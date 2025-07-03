<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Schema;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

class UniqueRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $field_name;
    private $table_name;
    private $message;


    public function __construct($table,$field)
    {
        $this->table_name = $table;
        $this->field_name = $field;
        $this->message    = 'Required Validation.';

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try 
        {
            $value = decrypt($value);

            if($this->verification())
            {
                if($this->getQuery($value) == 0)
                {
                    return true;
                }
                else
                {
                    $this->setMessage('The '.$attribute.' already found.');
                    
                }
            }
        } 
        catch (DecryptException $e) 
        {
            //
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    
    // SET ERROR MESSAGE
    public function setMessage($msg)
    {
        $this->message = $msg;
    }

    // RETURN CUSTOM ERROR MESSAGE
    public function message()
    {
        return $this->message;
    }

    // RETURN FIELD NAME
    public function getFieldName()
    {
        return $this->field_name;
    }

    // RETURN TABLE NAME
    public function getTableName()
    {
        return $this->table_name;
    }


    public function getQuery($value)
    {
        return DB::table($this->getTableName())->where([$this->getFieldName() => $value,'is_recycle' => 0])->count();
    }

    public function verification()
    {
        if(Schema::hasTable($this->getTableName()) && Schema::hasColumn($this->getTableName(),$this->getFieldName()))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
