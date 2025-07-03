// SECTION # 1.1 => START FORM MESSAGES SUCCESS/ UNSUCCESS 
function field_unsuccess(element, message) {

    var input_lenght = element.val().length;

    if (element.parentsUntil().children('small.req').attr('value') == "*") {
        element.parentsUntil().children('small.req').html(' (' + message + ')');
        //element.after('<small class="error_message">'+message+'</small><br>').next().css('color','red');
        element.css('border-color', 'red');
    } else if (input_lenght > 0) {
        element.parentsUntil().children('small.req').html(' (' + message + ')');
        //element.after('<small class="error_message">'+message+'</small><br>').next().css('color','red');
        element.css('border-color', 'red');
    }

}

function ajax_base_field_unsuccess(element, message) {
    element.parentsUntil().children('small.req').html(' (' + message + ')');
    //element.after('<small class="error_message">'+message+'</small><br>').next().css('color','red');
    element.css('border-color', 'red');
}

function ajax_show_error(error_list, form_element, model_element) {
    var separate_data = "";

    $.each(error_list.responseJSON.errors, function(index, value) {

        separate_data = index.split('.');

        // ITS MEAN DATA AN ARRAY FORM
        if (typeof(separate_data[1]) !== 'undefined') {
            // FOR ALL INPUT FROM ERROR LIST
            element = form_element.find("input[name^=" + separate_data[0] + "]:eq(" + separate_data[1] + ")");

            value = value.toString();

            ajax_base_field_unsuccess(element, value.replace('.' + separate_data[1], " "));

            // FOR ALL TEXTAREA FROM ERROR LIST
            element = form_element.find("textarea[name^=" + separate_data[0] + "]:eq(" + separate_data[1] + ")");

            value = value.toString();

            ajax_base_field_unsuccess(element, value.replace('.' + separate_data[1], " "));

            // FOR ALL DROPDOWN FROM ERROR LIST
            element = form_element.find("select[name^=" + separate_data[0] + "]:eq(" + separate_data[1] + ")");

            value = value.toString();

            ajax_base_field_unsuccess(element, value.replace('.' + separate_data[1], " "));

            model_element.scrollTop(0);
        } else {
            ajax_base_field_unsuccess($('input[name=' + index + ']'), value);
            ajax_base_field_unsuccess($('textarea[name=' + index + ']'), value);
            ajax_base_field_unsuccess($('select[name=' + index + ']'), value);


        }

    });

    removeLoader();

    swal("Your request has been cancelled!");
}

function field_refersh(element) {

    if (element.parentsUntil().children('small.req').attr('value') == "*") {
        // element.parentsUntil().children('small.req').html('*');
        element.parentsUntil().children('small.req').html('');

    } else {
        element.parentsUntil().children('small.req').html(" ");
    }

    element.css('border-color', '#ced4da');

}



// ********************************** END FORM MESSAGES SUCCESS/ UNSUCCESS ****************************


// SECTION # 1.1 => START REGEX PATTERN 

// # REGEX EMAIL ADDRESS 
function regex_email(element, message) {
    var regex_email = /^[A-Za-z0-9]{1}[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,3}$/;

    if (element.val().trim().match(regex_email)) {
        return true;
    } else {
        field_unsuccess(element, message);
        return false;
    }
}

function regex_nofowners(element, message) {
    var regex_email = /^([1-5])$/;

    if (element.val().trim().match(regex_email)) {
        return true;
    } else {
        field_unsuccess(element, message);
        return false;
    }
}

// # REGEX CONTAIN ONLY ALPHA
function regex_alpha(element, message) {
    var regexaplha = /^[a-zA-Z \s]*$/;

    if (element.val().trim().match(regexaplha)) {

        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }
}

function regex_alpha_numeric(element, message) {
    field_refersh(element);

    var regexaplha = /^[a-zA-Z 0-9]*$/;

    if (element.val().trim().match(regexaplha)) {

        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }
}

function regex_alpha_numeric_space(element, message) {
    field_refersh(element);

    var regexaplha = /^[a-zA-Z 0-9 \w]*$/;

    if (element.val().trim().match(regexaplha)) {

        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }
}

// # REGEX CONTAIN ONLY DECIMAL DIGIT
function regex_decimal_digits(element, message) {
    var regexdecimal_digit = /^[\d,]*\.?[\d,]*$/;

    if (element.val().trim().match(regexdecimal_digit)) {

        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }
}

function regex_digits(element, message) {
    var regexdecimal_digit = /^[\d,]*$/;

    if (element.val().trim().match(regexdecimal_digit)) {

        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }
}

// # REGEX CONTAIN ONLY ALPHA OR SPECES
function regex_AlphaSpace(element, errorValue) {
    var regex_alpha_spaces = /^[a-zA-Z\s\.]+$/; // CHARACTER WITH SPACE

    if (element.val().trim().match(regex_alpha_spaces)) {
        //element.val(element.val().trim());
        return true;
    } else {
        field_unsuccess(element, errorValue);

        return false;
    }
}

function regex_num_range(element, message) {
    var regex_num_range = /^([1-6]{1})$/;

    if (element.val().trim().match(regex_num_range)) {
        //element.val(element.val().trim());
        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }


}
// REGEX FOR ONLY PAKISTAN CONTACT NO 
function regex_PhoneNo(element, errorValue) {
    var regex_phone = /^([\d-+])*$/ // 03XX-XXXXXXX  /  051-XXXXXXX

    if (element.val().trim().match(regex_phone)) {
        return true;
    } else {
        field_unsuccess(element, errorValue);
        return false;
    }
}
// REGEX FOR ONLY PAKISTAN NATIONALITY FOR CNIC 
function regex_pak_cnic(element, errorValue) {
    var regex_cnic = /^([0-9]{5})[-]([0-9]{7})[-]([0-9]{1})$/; // XXXXX-XXXXXXX-X

    if (element.val().match(regex_cnic)) {
        return true;
    } else {
        field_unsuccess(element, errorValue);
        return false;
    }
}

// *********************************** END REGEX PATTERN *******************************************


// ********************************** START FIELD VALIDATIONS *****************************************

function field_isempty(element, message) {
    if (element.val().trim().length == 0) {
        field_unsuccess(element, message);

        return false;
    } else {
        return true;
    }
}

function field_length(element, message, length) {
    if (element.val().trim().length == length) {
        field_unsuccess(element, message);

        return false;
    } else {
        return true;
    }
}

function length_grethan_equall(element, message, length) {
    if (element.val().trim().length >= length) {
        field_unsuccess(element, message);

        return false;
    } else {
        return true;
    }
}

function length_lesthan_equall(element, message, length) {
    if (element.val().trim().length <= length) {
        field_unsuccess(element, message);

        return false;
    } else {
        return true;
    }
}

function length_range(element, message, length_max, length_min) {
    if (element.val().trim().length >= length_max && element.val().trim().length <= length_min) {


        return true;
    } else {
        field_unsuccess(element, message);
        return false;
    }
}

function password_length(element, message, pass_length) {
    if (element.val().trim().length == pass_length) {
        return true;
    } else {
        field_unsuccess(element, message);

        return false;
    }
}

function password_match(password, conf_password, message, pass_length, pass_length2) {
    if ((password.val().trim().length >= pass_length && password.val().trim().length <= pass_length2) && (conf_password.val().trim().length >= pass_length && conf_password.val().trim().length <= pass_length2)) {
        if (password.val().trim() == conf_password.val().trim()) {
            return true;
        } else {
            field_unsuccess(conf_password, message);
            field_unsuccess(password, message);


            return false;
        }
    } else {
        return true;
    }

}

function combobox_is_selected(element, message) {
    if ('selected' == element.val()) {
        field_unsuccess(element, message);
        return false;
    } else {
        return true;
    }
}



function today_date(element) {
    var current_date = new Date(element.val());
    var date_today = new Date();
    var previous_day = new Date(current_date.getTime() - 24 * 60 * 60 * 1000);

    if (current_date == date_today) {
        alert('ok');
    } else {
        alert('fail');
    }
}

function validate_form_fields(element) {
    var error = 0;

    element.each(function() {

        if ($(this).attr('value') == "*") {
            current_value = $(this).closest('div').find('input, textarea, select');;


            if (current_value.val() == "selected" || current_value.val().trim().length == 0) {
                field_refersh(current_value);
                field_unsuccess(current_value, "The field is required.");
                error++;


            }

        }
    });

    return error;
}

function validate_form_fields2(element) {
    element = element.find('div.tag_req');


    element.each(function() {

        if ($(this).find('small.req').html() == "*") {
            // alert($(this).text());
            if ($(this).after().val() == "selected" || $(this).after().val().trim().length == 0) {
                field_refersh($(this).after());
                field_unsuccess($(this).after(), "The field is required.");
            }

        }
    });
}



function messageToaster(messageType, message, title) {
    Command: toastr[messageType](message, title)

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}

function modelClose_clearForm(modal_id, form_id) {
    $(modal_id).modal('hide');
    $(form_id)[0].reset();
}

function showLoader() {
    (document.getElementById('cls-loader')).style.display = 'block';
}

function removeLoader() {
    // $.LoadingOverlay("hide");
    (document.getElementById('cls-loader')).style.display = 'none';

}

function resetDataTable(element) {
    element.DataTable().clear();
    element.DataTable().destroy();
}

function reiniDataTable(element) {
    element.DataTable();

}

function removeFieldRequired(element) {
    element.parentsUntil().children('small.req').attr('value', '');
    field_refersh(element);
    // element.val('');
}

function fieldRequired(element) {
    element.parentsUntil().children('small.req').attr('value', '*');
    field_refersh(element);



}

//today_date();

// ********************************** END FIELD VALIDATIONS *****************************************