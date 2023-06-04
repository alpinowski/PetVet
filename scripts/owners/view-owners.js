$('.edit').click(function(){
    var ownid=$(this).attr('data-classid');
    $.post('../petvet/includes/owners/modal_owners.php', {
        ownerid: ownid
    }, function (result) {
        $("#updateOwnerID").val(ownid);
        $("#eprefix").val(result.prefix);
        $("#efullname").val(result.fullname);
        $("#eemail").val(result.email);
        $("#eaddress").val(result.address);
        $("#emobile").val(result.mobile);
        $("#edescription").val(result.description);
    }, 'json');
});

$('.view').click(function(){
    $.post('../petvet/includes/owners/modal_owners.php', {
        ownerid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vprefix").innerHTML = result.prefix;
        document.getElementById("vfullname").innerHTML = result.fullname;
        document.getElementById("vemail").innerHTML = result.email;
        document.getElementById("vaddress").innerHTML = result.address;
        document.getElementById("vmobile").innerHTML = result.mobile;
        document.getElementById("vdescription").innerHTML = result.description;
    }, 'json');
});

$('.delete').click(function(){
    $("#deleteOwnerID").val($(this).attr('data-dclassid'));
});
