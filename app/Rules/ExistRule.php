<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Schema;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $field_name;
    private $table_name;
    private $message;
    private $flag;



    public function __construct($table,$field,$required = true)
    {
        $this->table_name = $table;
        $this->field_name = $field;
        $this->flag = $required;

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

            if($value > 0)
            {
                if($this->verification())
                {
                    if($this->getQuery($value) == 1)
                    {
                        return true;
                    }
                    else
                    {
                        $this->setMessage('The '.$attribute.' does not exist.');
                        
                    }
                }
            }
            else
            {
                // TRUE CASE REQUIRED FIELD
                if($this->getFlag())
                {
                    $this->setMessage('The '.$attribute.' does not exist.');
                }
                else
                {
                    return true;
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

     // RETURN FIELD NAME
    public function getFlag()
    {
        return $this->flag;
    }

    // RETURN TABLE NAME
    public function getTableName()
    {
        return $this->table_name;
    }


    public function getQuery($value)
    {
        return DB::table($this->getTableName())->where([$this->getFieldName() => $value])->count();
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
