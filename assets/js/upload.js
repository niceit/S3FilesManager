$(document).ready(function () {
    $(".select_butket").select2({
        placeholder: "Choose Bucket",
        allowClear: true
    });

    $(".add-folder-btn").click(function(){
        var object = '#modal-add-folder';
        var bucket = $("select[name=bucket]").val();

        if (bucket == '') {
            alert('Please choose bucket first');
            return false;
        }

        $('#modal-add-folder').modal('show');
        $('#modal-add-folder').find('span.selected-folder').html('/');
        $(object).find('.body').html("<img src='/assets/images/elements/loaders/5s.gif' /> &nbsp; <i>Please patience...</i>");
        $.post("/index.php?route=home/listbucketfolders", {bucket:bucket, path:'/', 'add-folder':1},function(response){
            $(object).find('.body').html(response);
        });
    });

});
