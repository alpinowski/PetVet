$('.edit').click(function(){
    var cateid=$(this).attr('data-classid');
    $.post('../petvet/includes/categories/modal_categories.php', {
        categoryid: cateid
    }, function (result) {
        $("#updateCategoryID").val(cateid);
        $("#ename").val(result.c_name);
        $("#edescription").val(result.description);
    }, 'json');
});

$('.view').click(function(){
    $.post('../petvet/includes/categories/modal_categories.php', {
        categoryid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vname").innerHTML = result.c_name;
        document.getElementById("vdescription").innerHTML = result.description;
    }, 'json');
});

$('.delete').click(function(){
    $("#deleteCategoryID").val($(this).attr('data-dclassid'));
});
