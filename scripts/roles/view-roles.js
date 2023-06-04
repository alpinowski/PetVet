$('.edit').click(function(){
    var rolid=$(this).attr('data-classid');
    $.post('../petvet/includes/roles/modal_roles.php', {
        roleid: rolid
    }, function (result) {
        $("#updateRoleID").val(rolid);
        $("#er_name").val(result.r_name);
    }, 'json');
});

$('.view').click(function(){
    $.post('../petvet/includes/roles/modal_roles.php', {
        roleid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vr_name").innerHTML = result.r_name;
    }, 'json');
});

$('.delete').click(function(){
    $("#deleteRoleID").val($(this).attr('data-dclassid'));
});
