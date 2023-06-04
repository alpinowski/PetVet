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
                ap_name: {
                required: true
                },
                aview: {
                required: true
                },
                ainsert: {
                required: true
                },
                aupdate: {
                required: true
                },
                adelete: {
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

                var aview = $("#aview");
                var ainsert = $("#ainsert");
                var aupdate = $("#aupdate");
                var adelete = $("#adelete");
                var ap_name = $("#ap_name");

                var btn = $(this);

                btn.attr('disabled', true);

                $.post('../petvet/includes/privileges/add_privileges.php', {

                    viewsel: aview.val(),
                    insertsel: ainsert.val(),
                    updatesel: aupdate.val(),
                    deletesel: adelete.val(),
                    p_nametxt: ap_name.val()


                }, function (res) {

                    if (res.status == 'OK')
                    {
                        window.location.href = "privilege.php";
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
                    ep_name: {
                    required: true
                    },
                    eview: {
                    required: true
                    },
                    einsert: {
                    required: true
                    },
                    eupdate: {
                    required: true
                    },
                    edelete: {
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

                    var privilegeID = $("#updatePrivilegeID");
                    var aview = $("#eview");
                    var ainsert = $("#einsert");
                    var aupdate = $("#eupdate");
                    var adelete = $("#edelete");
                    var ap_name = $("#ep_name");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/privileges/update_privileges.php', {

                        privilegeID: privilegeID.val(),
                        viewsel: aview.val(),
                        insertsel: ainsert.val(),
                        updatesel: aupdate.val(),
                        deletesel: adelete.val(),
                        p_nametxt: ap_name.val()

                    }, function (res) {
                        
                        if (res.status == 'OK')
                        {
                            window.location.href = "privilege.php";
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

                    var privilegeID = $("#deletePrivilegeID");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/privileges/delete_privileges.php', {

                        privilegeid: privilegeID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "privilege.php";
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