// KEYBOARD INPUT PREVENT DEFAULT (1)
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
    }
});

// KEYBOARD INPUT PREVENT DEFAULT (2)
$(window).keydown(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
        return false;
    }
});

// WHEN MULTIPLE MODEL OPEN THIS FUNCTION HELP TO CLOSE COMPLETE A SINGLE METHOD
$('body').on('hidden.bs.modal', function(e) {
    if ($('.modal').hasClass('in')) {
        $('body').addClass('modal-open');
    }
});

// BEFORE DELETE POP UP MESSAGE
$(document.body).on('click', '.cls_delete', function(event) {

    event.preventDefault();

    var route = $(this).attr('href');
    var content = $(this).attr('content');
    swal({
            title: "Are you sure",
            text: "you want to " + content + '?',
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                swal("Your request has been submitted!", {
                    icon: "success",
                });

                window.location.href = route;

                $.LoadingOverlay("show");

            } else {
                swal("Your request has been cancelled!");
            }
        });
});

// CHECK FIELD IS EMPTY OR NOT
$(document.body).on('keyup', '.cls_required', function() {

    field_refersh($(this));
    field_isempty($(this), "This field is required.");
});

// PURPOSE OF THIS CLASS VALIDATION PASSWORD 1
$('.cls_pass').keyup(function(event) {


    validate_password($(this), $('.cls_conf_pass'), 8, 16);
});

// PURPOSE OF THIS CLASS VALIDATION PASSWORD 2
$('.cls_conf_pass').keyup(function(event) {

    validate_password($(this), $('.cls_pass'), 8, 16);
});

// REJEX BASE VALIDATION CHECK FULL NAME
$(document.body).on('keyup', '.cls_fullname', function() {

    validate_fullname($(this));

});

// REJEX BASE VALIDATION CHECK EMAIL
$(document.body).on('keyup', '.cls_email', function() {

    validate_email_address($(this));

});

// REJEX BASE VALIDATION CHECK USER NAME
$(document.body).on('keyup', '.cls_username', function() {

    validate_username($(this));
});

// REJEX BASE VALIDATION CHECK CONTACT NO
$(document.body).on('keyup', '.cls_contact', function() {

    validate_contact($(this));

})

// REJEX BASE VALIDATION CHECK CITY
$('.cls_city').keyup(function(event) {

    validate_city($(this));
});

// REJEX BASE VALIDATION CHECK ADDRESS
$('.cls_address').keyup(function(event) {

    validate_address($(this));
});

// PURPOSE OF THE CLASS VALIDATE DROPDOWN
$(document.body).on('change', '.cls_selection', function() {

    validate_combobox($(this), "The field is required.")

});

// REJEX BASE VALIDATION CHECK CHARACTER IS ALPHA
$(document.body).on('keyup', '.cls_alpha', function() {

    field_refersh($(this));

    regex_alpha($(this), "This field contains only characters.")
});

// REJEX BASE VALIDATION CHECK CHARACTER IS ALPHA NUMERIC
$(document.body).on('keyup', '.cls_alpha_numeric', function() {

    regex_alpha_numeric($(this), "The field contains only characters or digits");
});

// REJEX BASE VALIDATION CHECK CNIC FORMAT
$(document.body).on('keyup', '.cls_cnic', function() {

    validate_cnic($(this));

});

// REJEX BASE VALIDATION CHECK DIGIT IS DEIMAL FORMAT
$(document.body).on('keyup', '.cls_decimal_digit', function() {

    validate_is_decimaldigit($(this));
});

// PURPOSE OF THIS CLASS VALIDATE COMMISSION IS [1-100]
$(document.body).on('keyup', '.cls_branch_commission', function() {

    branch_commission($(this));
});

// PURPOSE OF THIS CLASS VALIDATE DATE 
$(document.body).on('change', '.cls_date', function() {

    field_refersh($(this));

    field_isempty($(this), "This  field is required");
});

// REJEX BASE VALIDATION CHECK CHARACTER IS ALPHA NUMERIC AND SPACE
$('.cls_alpha_numeric_space').keyup(function() {

    field_refersh($(this));
    regex_alpha_numeric_space($(this), "The field contains only alpha numeric space");
});

// VALIDATE FORM 
$(document.body).on('click', '.cls_submit', function(event) {

    event.preventDefault();

    var form_obj = $(this).closest('form').find('small.req');

    var content = $(this).attr('content');
    alert(content);

    if (validate_form_fields(form_obj) == 0 && validate_form(form_obj) == 0) {
        swal({
                title: "Are you sure",
                text: "you want to " + content + '?',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

                if (willDelete) {
                    showLoader();


                    swal("Your request has been submitted!", {
                        icon: "success",
                    });


                    $(this).closest('form').submit();



                } else {
                    swal("Your request has been cancelled!");
                }
            });
    } else {
        swal("Your request has been cancelled!");

        event.preventDefault();
    }


});
// VALIDATE AJAX FORM 
function ajax_validate(form_element) {
    var flag = false;

    var form_obj = form_element.find('small.req');

    if (validate_form_fields(form_obj) == 0 && validate_form(form_obj) == 0) {
        flag = true;
    } else {
        swal("Your request has been cancelled!");
        flag = false;
    }

    return flag;
}