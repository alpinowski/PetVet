
var FormValidation = function () {

    // validation using icons
    var handleValidation2 = function() {

        var form2 = $('#form_add');
        var error2 = $('.alert-danger', form2);
        var success2 = $('.alert-success', form2);

        form2.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                afullname: {
                    minlength: 3,
                    required: true
                },
                ausername: {
                    minlength: 3,
                    maxlength: 10,
                    required: true
                },
                apassword: {
                    minlength: 6,
                    required: true
                },
                arpass: {
                    minlength: 6,
                    required: true,
                    equalTo: "#apassword"
                },
                aemail: {
                    email: true,
                    required: false
                },
            },
            messages: { arpass: { equalTo: "Password Does Not Match!" } },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success2.hide();
                error2.show();
                App.scrollTo(error2, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight

            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                success2.show();
                error2.hide();

                //===============================================================

                var aprefix = $("#aprefix");
                var afullname = $("#afullname");
                var ausername = $("#ausername");
                var apassword = $("#apassword");
                var aemail = $("#aemail");
                var arole = $("#arole :selected");

                var btn = $(this);

                btn.attr('disabled', true);

                $.post('../petvet/includes/users/add_users.php', {

                    prefixsel: aprefix.val(),
                    fullnametxt: afullname.val(),
                    usernametxt: ausername.val(),
                    passwordtxt: apassword.val(),
                    emailtxt: aemail.val(),
                    roleint: arole.val()

                }, function (res) {

                    if (res.status == 'OK')
                    {
                        window.location.href = "user.php";
                    }
                    else
                    {
                        success2.hide();
                        error2.show();
                    }

                    btn.attr('disabled', false);

                }, 'json');

                //================================================================
            }
        });

    }

    var handleValidation3 = function() {

            var form3 = $('#form_update');
            var error2 = $('.alert-danger', form3);
            var success2 = $('.alert-success', form3);

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    efullname: {
                    minlength: 3,
                    required: true
                    },
                    eusername: {
                        minlength: 3,
                        maxlength: 10,
                        required: true
                    },
                    epassword: {
                        minlength: 6,
                        required: true
                    },
                    erpass: {
                        minlength: 6,
                        required: true,
                        equalTo: "#epassword"
                    },
                    eemail: {
                        email: true,
                        required: false
                    },
                },
                messages: { erpass: { equalTo: "Password Does Not Match!"} },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight

                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();

                    //===============================================================

                    var userID = $("#updateUserID");
                    var aprefix = $("#eprefix");
                    var afullname = $("#efullname");
                    var ausername = $("#eusername");
                    var apassword = $("#epassword");
                    var arpass = $("#erpass");
                    var aemail = $("#eemail");
                    var erole = $("#erole :selected");

                    var btn = $(this);

                    btn.attr('disabled', true);       

                    $.post('../petvet/includes/users/update_users.php', {

                        userID: userID.val(),
                        prefixsel: aprefix.val(),
                        fullnametxt: afullname.val(),
                        usernametxt: ausername.val(),
                        passwordtxt: apassword.val(),
                        emailtxt: aemail.val(),
                        roleint: erole.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "user.php";
                        }
                        else
                        {
                            success2.hide();
                            error2.show();
                        }

                        btn.attr('disabled', false);

                    }, 'json');

                    //================================================================
                }
            });

    }

    var handleValidation4 = function() {

            var form4 = $('#form_delete');
            var error2 = $('.alert-danger', form4);
            var success2 = $('.alert-success', form4);

            form4.validate({
                submitHandler: function (form) {
                    success2.show();
                    error2.hide();

                    //===============================================================

                    var userID = $("#deleteUserID");

                    var btn = $(this);


                    btn.attr('disabled', true);

                    $.post('../petvet/includes/users/delete_users.php', {

                        userid: userID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "user.php";
                        }
                        else
                        {
                            success2.hide();
                            error2.show();
                        }

                        btn.attr('disabled', false);

                    }, 'json');

                    //================================================================
                }
            });

    }

    return {
        //main function to initiate the module
        init: function () {

            handleValidation2();
            handleValidation3();
            handleValidation4();

        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});