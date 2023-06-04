$('.edit').click(function(){
    var useid=$(this).attr('data-classid');
    $.post('../petvet/includes/users/modal_users.php', {
        userid: useid
    }, function (result) {
        $("#updateUserID").val(useid);
        $("#eprefix").val(result.prefix);
        $("#efullname").val(result.fullname);
        $("#eusername").val(result.username);
        $("#eemail").val(result.email);
        $("#erole").val(result.fk_role_id);
    }, 'json');
});

$('.view').click(function(){
    $.post('../petvet/includes/users/modal_users.php', {
        userid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vprefix").innerHTML = result.prefix;
        document.getElementById("vfullname").innerHTML = result.fullname;
        document.getElementById("vusername").innerHTML = result.username;
        document.getElementById("vemail").innerHTML = result.email;
        document.getElementById("vrole").innerHTML = result.r_name;
    }, 'json'); 
});

$('.delete').click(function(){
    $("#deleteUserID").val($(this).attr('data-dclassid'));
});
