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
                adate: {
                    required: true
                },
                avac_lab: {
                    required: true
                },
                abarcode: {
                    digits: true,
                    required: true
                },
                anext_vac: {
                    required: true
                },
                acategory: {
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

                var adate = $("#adate");
                var avac_lab = $("#avac_lab");
                var abarcode = $("#abarcode");
                var anext_vac = $("#anext_vac");
                var acategory = $("#acategory :selected");

                var btn = $(this);

                btn.attr('disabled', true);
               
                $.post('../petvet/includes/tests/add_tests.php', {
                    datedate: adate.val(),
                    vac_labtxt: avac_lab.val(),
                    barcodetxt: abarcode.val(),
                    next_vacdate: anext_vac.val(),
                    categoryint: acategory.val()

                }, function (res) {
                    if (res.status == 'OK')
                    {
                        window.location.href = "test.php";
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
                edate: {
                    required: true
                },
                evac_lab: {
                    required: true
                },
                ebarcode: {
                    digits: true,
                    required: true
                },
                enext_vac: {
                    required: true
                },
                ecategory: {
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

                var testID = $("#updateTestID");
                var adate = $("#edate");
                var avac_lab = $("#evac_lab");
                var abarcode = $("#ebarcode");
                var anext_vac = $("#enext_vac");
                var acategory = $("#ecategory :selected");

                var btn = $(this);

                btn.attr('disabled', true);

                $.post('../petvet/includes/tests/update_tests.php', {

                    testID: testID.val(),
                    datedate: adate.val(),
                    vac_labtxt: avac_lab.val(),
                    barcodetxt: abarcode.val(),
                    next_vacdate: anext_vac.val(),
                    categoryint: acategory.val()

                }, function (res) {

                    if (res.status == 'OK')
                    {
                        window.location.href = "test.php";
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

                    var testID = $("#deleteTestID");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/tests/delete_tests.php', {

                        testid: testID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "test.php";
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