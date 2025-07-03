function validate_form(form_element)
{

    
    var error_counter = 0;

    form_element.each(function(){

        
        if($(this).html().length > 1)
        {
            error_counter++;
           
        }
        else
        {
            
        }
    });

    return error_counter;


}

function validate_password(pass,conf_pass,pass_length,pass_length2)
{
    

    if(field_isempty(pass,"The field is required."))
    {
        field_refersh(pass);
    }
    else
    {
       return false;
    }

    if(length_range(pass,"The field must contain 8 - 16 letters.",pass_length,pass_length2))
    {
         field_refersh(pass);
    }
    else
    {
       
        return false;
    }

    if(password_match(pass,conf_pass,"Password and conform password is not matched",pass_length,pass_length2))
    {
        field_refersh(pass);
        field_refersh(conf_pass);
    }
    else
    {
        
        return false;
    }

    return true;
}

function validate_username(username)
{
    field_refersh(username);

    if(field_isempty(username,"The field is required."))
    {
        
    }
    else
    {
      
       return false;
    }

    if(regex_alpha(username,"The field contains only alpha characters."))
    {
       
    }
    else
    {
      
      return false;
    }

    return true;
}

function validate_email_address(email)
{
    field_refersh(email);

    if(field_isempty(email,"The field is required"))
    {
        
    }
    else
    {
      
       return false;
    }

    if(regex_email(email,"The email is not valid format"))
    {

    }
    else
    {
      
      return false;
    }

    return true;
}

function validate_contact(contact)
{
    field_refersh(contact);

    if(regex_PhoneNo(contact,"This field accept only +, -, digits."))
    {
        
    }
    else
    {
      
       return false;
    }

    return true;
}

function validate_city(city)
{
    field_refersh(city);

    // if(field_isempty(city,"The field is required."))
    // {
        
    // }
    // else
    // {
      
    //    return false;
    // }

    if(regex_alpha(city,"The field contains only alpha characters."))
    {
       
    }
    else
    {
      
      return false;
    }

    return true;
}

function validate_address(address)
{
    field_refersh(address);

    if(field_isempty(address,"The field is required."))
    {
        
    }
    else
    {
      
       return false;
    }

    return true;
}

function validate_cnic(cnic)
{
    field_refersh(cnic);

    if(field_isempty(cnic,"The field is required."))
    {
        
    }
    else
    {
      
       return false;
    }

    if(regex_pak_cnic(cnic,"The cnic is invalid format [XXXXX-XXXXXXX-X]"))

    return true;
}

function validate_is_decimaldigit(element)
{
    field_refersh(element);

    


    if(regex_decimal_digits(element,"The field contain only digits/decimal digits"))
    {

    }
    else
    {
        return false;
    }

    return true;    
}



function validate_isdigit(element)
{
    field_refersh(element);

  

    if(regex_decimal_digits(element,"The field contain only digits"))
    {

    }
    else
    {
        return false;
    }

    return true;    
}

function validate_combobox(element,message)
{
    field_refersh(element);
    
    if(combobox_is_selected(element,message))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function branch_commission(element)
{
    field_refersh(element);

    
    if(regex_decimal_digits(element,"The field contain only digits/decimal digits"))
    {
        if(element.val() > 0 && element.val() <= 100 )
        {
            field_refersh(element);
        }
        else
        {
            field_unsuccess(element,'The field range must be [0 - 100]');

             
        }
    }
    else
    {
        return false;
    }

    return true;    
}

function validate_fullname(fullname)
{
    field_refersh(fullname);

    if(field_isempty(fullname,"The field is required."))
    {
        field_refersh(fullname);
    }
    else
    {
       return false;
    }
    
    if(regex_AlphaSpace(fullname,"The field contain only characters and spaces"))
    {
        return true;
    }
    else
    {
        return false;
    }
}



