$('.edit').click(function(){
    var priid=$(this).attr('data-classid');
    $.post('../petvet/includes/privileges/modal_privileges.php', {
        privilegeid: priid
    }, function (result) {
        $("#updatePrivilegeID").val(priid);
        $("#eview").val(result.view);
        $("#einsert").val(result.insert);
        $("#eupdate").val(result.insert);
        $("#edelete").val(result.update);
        $("#ep_name").val(result.p_name);
    }, 'json');
});

$('.delete').click(function(){
    $("#deletePrivilegeID").val($(this).attr('data-dclassid'));
});
