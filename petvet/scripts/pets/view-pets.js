$('.edit').click(function(){
    var peid=$(this).attr('data-classid');
    $.post('../petvet/includes/pets/modal_pets.php', {
        petid: peid
    }, function (result) {
        $("#updatePetID").val(peid);
        $("#ep_name").val(result.p_name);
        $("#ebirthdate").val(result.birthdate);
        $("#egender").val(result.gender);
        $("#especies").val(result.species);
        $("#ebreed").val(result.breed);
        $("#ecoat_color").val(result.coat_color);
        $("#emicro_num").val(result.microchip_number);
        $("#emicro_date").val(result.microchip_date);
        $("#eref_lab").val(result.reference_lab);
        $("#ehealth_cer").val(result.health_certificate);
        document.getElementById('evphoto').src = result.photo;
        document.getElementById('ephoto').src = result.photo;
    }, 'json');
});

$('.view').click(function(){
    $.post('../petvet/includes/pets/modal_pets.php', {
        petid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vp_name").innerHTML = result.p_name;
        document.getElementById("vbirthdate").innerHTML = result.birthdate;
        document.getElementById("vgender").innerHTML = result.gender;
        document.getElementById("vspecies").innerHTML = result.species;
        document.getElementById("vbreed").innerHTML = result.breed;
        document.getElementById("vcoat_color").innerHTML = result.coat_color;
        document.getElementById("vmicro_num").innerHTML = result.microchip_number;
        document.getElementById("vmicro_date").innerHTML = result.microchip_date;
        document.getElementById("vd_rabies").href = result.rabies;
        document.getElementById("vd_result").href = result.result;
        document.getElementById("vref_lab").innerHTML = result.reference_lab;
        document.getElementById("vhealth_cer").innerHTML = result.health_certificate;
        document.getElementById('vphoto').src = result.photo;
          $("#chargo").val(result.petid);

    }, 'json');
});

$('.view2').click(function(){
    var ap_name = $("#chargo");
    $.post('../petvet/includes/pets/modal_pets.php', {
        petid: ap_name.val()
    }, function (result) {
    document.getElementById('vrabies').src = result.rabies;
    }, 'json');
});

$('.view3').click(function(){
    var ap_name = $("#chargo");
    $.post('../petvet/includes/pets/modal_pets.php', {
        petid: ap_name.val()
    }, function (result) {
    document.getElementById('vresult').src = result.result;
    }, 'json');
});

$('.delete').click(function(){
    $("#deletePetID").val($(this).attr('data-dclassid'));
});
