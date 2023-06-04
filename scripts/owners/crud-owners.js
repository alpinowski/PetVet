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
                aemail: {
                    required: false,
                    email: true
                },
                amobile: {
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                    required: true
                },
            },

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
                var amobile = $("#amobile");
                var aemail = $("#aemail");
                var aaddress = $("#aaddress");
                var adescription = $("#adescription");

                var btn = $(this);

                btn.attr('disabled', true);

                $.post('../petvet/includes/owners/add_owners.php', {

                    prefixtxt: aprefix.val(),
                    fullnametxt: afullname.val(),
                    emailtxt: aemail.val(),
                    mobiletxt: amobile.val(),
                    addresstxt: aaddress.val(),
                    desctxt: adescription.val()

                }, function (res) {

                    if (res.status == 'OK')
                    {
                        window.location.href = "owner.php";
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
                    eemail: {
                        required: false,
                        email: true
                    },
                    emobile: {
                        minlength: 11,
                        maxlength: 11,
                        digits: true,
                        required: true
                    },
                },

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

                    var ownerID = $("#updateOwnerID");
                    var aprefix = $("#eprefix");
                    var afullname = $("#efullname");
                    var amobile = $("#emobile");
                    var aemail = $("#eemail");
                    var aaddress = $("#eaddress");
                    var adescription = $("#edescription");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/owners/update_owners.php', {

                        ownerID: ownerID.val(),
                        prefixtxt: aprefix.val(),
                        fullnametxt: afullname.val(),
                        mobiletxt: amobile.val(),
                        emailtxt: aemail.val(),
                        addresstxt: aaddress.val(),
                        desctxt: adescription.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "owner.php";
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

                    var ownerID = $("#deleteOwnerID");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/owners/delete_owners.php', {

                        ownerid: ownerID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "owner.php";
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