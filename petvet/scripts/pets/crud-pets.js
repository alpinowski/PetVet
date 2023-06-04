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
                    minlength: 2,
                    required: true
                    },
                    abirthdate: {
                        required: true
                    },
                    agender: {
                        required: true
                    },
                    amicro_num: {
                        digits: true,
                        required: true
                    },
                    amicro_date: {
                        required: true
                    },
                    arabies: {
                        required: true
                    },
                    aresult: {
                        required: true
                    },
                    aref_lab: {
                        required: true
                    },
                    ahealth_cer: {
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

                    var ap_name = $("#ap_name");
                    var abirthdate = $("#abirthdate");
                    var agender = $("#agender");
                    var aspecies = $("#aspecies");
                    var abreed = $("#abreed");
                    var acoat_color = $("#acoat_color");
                    var amicro_num = $("#amicro_num");
                    var amicro_date = $("#amicro_date");
                    var aref_lab = $("#aref_lab");
                    var ahealth_cer = $("#ahealth_cer");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/pets/add_pets.php', {

                        p_nametxt: ap_name.val(),
                        birthdatedate: abirthdate.val(),
                        gendersel: agender.val(),
                        speciestxt: aspecies.val(),
                        breedtxt: abreed.val(),
                        coat_colortxt: acoat_color.val(),
                        micro_numtxt: amicro_num.val(),
                        micro_datedate: amicro_date.val(),
                        ref_labtxt: aref_lab.val(),
                        health_certxt: ahealth_cer.val(),

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            var formData = new FormData();
                            formData.append("userfile", aphoto.files[0]);
                            formData.append("petname", $("#ap_name").val());

                            var requests = new XMLHttpRequest();
                            
                            requests.open("POST", "../petvet/uploads/add_pet_photo.php");
                            requests.send(formData);

                            requests.onreadystatechange=function()
                            {
                                if (requests.readyState==4 && requests.status==200)
                                    {
                                    var formData = new FormData();
                                    formData.append("userfile", arabies.files[0]);
                                    formData.append("petname", $("#ap_name").val());

                                    var req = new XMLHttpRequest();

                                    req.open("POST", "../petvet/uploads/add_pet_rabies.php");
                                    req.send(formData);

                                    req.onreadystatechange=function()
                                    {
                                        if (req.readyState==4 && req.status==200)
                                        {
                                            var formData = new FormData();
                                            formData.append("userfile", aresult.files[0]);
                                            formData.append("petname", $("#ap_name").val());

                                            var req2 = new XMLHttpRequest();
                                            
                                            req2.open("POST", "../petvet/uploads/add_pet_result.php");
                                            req2.send(formData);

                                            req2.onreadystatechange=function()
                                            {
                                                if (req2.readyState==4 && req2.status==200)
                                                {
                                                    window.location.href = "pet.php";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
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
                    minlength: 2,
                    required: true
                    },
                    ebirthdate: {
                        required: true
                    },
                    egender: {
                        required: true
                    },
                    emicro_num: {
                        digits: true,
                        required: true
                    },
                    emicro_date: {
                        required: true
                    },
                    eref_lab: {
                        required: true
                    },
                    ehealth_cer: {
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

                    var petID = $("#updatePetID");
                    var ap_name = $("#ep_name");
                    var abirthdate = $("#ebirthdate");
                    var agender = $("#egender");
                    var aspecies = $("#especies");
                    var abreed = $("#ebreed");
                    var acoat_color = $("#ecoat_color");
                    var amicro_num = $("#emicro_num");
                    var amicro_date = $("#emicro_date");
                    var aref_lab = $("#eref_lab");
                    var ahealth_cer = $("#ehealth_cer");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/pets/update_pets.php', {

                        petID: petID.val(),
                        p_nametxt: ap_name.val(),
                        birthdatedate: abirthdate.val(),
                        gendersel: agender.val(),
                        speciestxt: aspecies.val(),
                        breedtxt: abreed.val(),
                        coat_colortxt: acoat_color.val(),
                        micro_numtxt: amicro_num.val(),
                        micro_datedate: amicro_date.val(),
                        ref_labtxt: aref_lab.val(),
                        health_certxt: ahealth_cer.val(),

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            var formData = new FormData();
                            formData.append("userfile", ephoto.files[0]);
                            formData.append("petid", $("#updatePetID").val());

                            var requests = new XMLHttpRequest();
                            
                            requests.open("POST", "../petvet/uploads/update_pet_photo.php");
                            requests.send(formData);

                            requests.onreadystatechange=function()
                            {
                                if (requests.readyState==4 && requests.status==200)
                                    {
                                    var formData = new FormData();
                                    formData.append("userfile", erabies.files[0]);
                                    formData.append("petid", $("#updatePetID").val());

                                    var req = new XMLHttpRequest();

                                    req.open("POST", "../petvet/uploads/update_pet_rabies.php");
                                    req.send(formData);

                                    req.onreadystatechange=function()
                                    {
                                        if (req.readyState==4 && req.status==200)
                                        {
                                            var formData = new FormData();
                                            formData.append("userfile", eresult.files[0]);
                                            formData.append("petid", $("#updatePetID").val());

                                            var req2 = new XMLHttpRequest();
                                            
                                            req2.open("POST", "../petvet/uploads/update_pet_result.php");
                                            req2.send(formData);

                                            req2.onreadystatechange=function()
                                            {
                                                if (req2.readyState==4 && req2.status==200)
                                                {
                                                    window.location.href = "pet.php";
                                                }
                                            }
                                        }
                                    }
                                }
                            }    
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

                    var petID = $("#deletePetID");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../petvet/includes/pets/delete_pets.php', {

                        petid: petID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            var formData = new FormData();
                            formData.append("petid", $("#deletePetID").val());

                            var requests = new XMLHttpRequest();
                            
                            requests.open("POST", "../petvet/uploads/delete_pet_photo.php");
                            requests.send(formData);

                            requests.onreadystatechange=function()
                            {
                                if (requests.readyState==4 && requests.status==200)
                                    {
                                    var formData = new FormData();
                                    formData.append("petid", $("#deletePetID").val());

                                    var req = new XMLHttpRequest();

                                    req.open("POST", "../petvet/uploads/delete_pet_rabies.php");
                                    req.send(formData);

                                    req.onreadystatechange=function()
                                    {
                                        if (req.readyState==4 && req.status==200)
                                        {
                                            var formData = new FormData();
                                            formData.append("petid", $("#deletePetID").val());

                                            var req2 = new XMLHttpRequest();
                                            
                                            req2.open("POST", "../petvet/uploads/delete_pet_result.php");
                                            req2.send(formData);

                                            req2.onreadystatechange=function()
                                            {
                                                if (req2.readyState==4 && req2.status==200)
                                                {
                                                    window.location.href = "pet.php";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
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