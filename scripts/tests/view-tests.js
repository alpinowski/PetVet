$('.edit').click(function(){
    var teid=$(this).attr('data-classid');
    $.post('../petvet/includes/tests/modal_tests.php', {
        testid: teid
    }, function (result) {
        $("#updateTestID").val(teid);
        $("#edate").val(result.t_date);
        $("#evac_lab").val(result.vaccine_label);
        $("#ebarcode").val(result.barcode);
        $("#enext_vac").val(result.next_vaccination);
        $("#ecategory").val(result.fk_category_id);
    }, 'json');
});

$('.view').click(function(){
    $.post('../petvet/includes/tests/modal_tests.php', {
        testid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vdate").innerHTML = result.t_date;
        document.getElementById("vvac_lab").innerHTML = result.vaccine_label;
        document.getElementById("vbarcode").innerHTML = result.barcode;
        document.getElementById("vnext_vac").innerHTML = result.next_vaccination;
        document.getElementById("vcategory").innerHTML = result.c_name;
    }, 'json');
});

$('.delete').click(function(){
    $("#deleteTestID").val($(this).attr('data-dclassid'));
});
