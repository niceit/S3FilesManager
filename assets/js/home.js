var instance_files = [];
jQuery(function(){
    loadFolder('/');
    $('#btn-search').click(function(){
        loadSearchFrefix(0);
    });
    $('#btn-create-new-folder').click(function(){
        $('.content-create-folder').slideDown();
        $('.content-upload-file').hide();
        $('.title-popup').html('Add new bucket folder');
        loadFolderNew('/');
    });
    $('#upload-file').click(function(){
        var bucket = $("select[name=bucket]").val();
        if (bucket == '') {
            alert('Please select bucket first');
        } else {
            $('.content-create-folder').hide();
            $('.content-upload-file').slideDown();
            $('.title-popup').html('Upload file');
            loadFolderNew('/');
        }

    });

    $('#save-folders').click(function(){
        saveCreateFolder();
    });
    $(".select_butket").select2();


    $("select[name=bucket]").change(function(){
        //Generate S3 Signature and Policy
        var bucket = $(this).val();
        if (bucket != '') {
            var region = $("input[name=region]").val();
            Application.generateFormS3Signature(".cloud-upload-form", bucket, region);
        }
    });



});

function loadFolderNewLeft(frefix){
    setFolderSelectedPath(frefix);
    loadFolderNew(frefix);
    $('.content-create-folder').slideDown();
    $('.content-upload-file').hide();
    $('.title-popup').html('Add new bucket folder');

}

function loadFolderNew(frefix) {
    $('#create-folder').modal('show');
    $("input[name=folder_name]").val('');
    $('#list-folder').prepend('<span class="loading"></span>');
    var URL = $('base').attr('href') + '/index.php?route=home/listbucketfolders';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix},
        dataType: "html",
        success: function (data) {
            $('#list-folder .loading').remove();
            $('#list-folder').html(data);
            clickFonderNew();
        }

    });
}

function loadSubFolderNew(frefix, id) {
    $('#list-folder').prepend('<span class="loading"></span>');
    var URL = $('base').attr('href') + '/index.php?route=home/listbucketfolders';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix},
        dataType: "html",
        success: function (data) {
            $('#list-folder .loading').remove();
            var sub = $('.sub-' + id + ' .sub');
            $(sub).html(data);
            clickFonderNew();
        }

    });
}

function clickFonderNew(){
    $('li .arrow-item').click(function(){
        var prefix = $(this).data('prefix');
        var id = $(this).data('id');

        var key = prefix  + '${filename}';
        $('#fileupload').find('input[name=key]').val(key);

        loadSubFolderNew(prefix, id);
    });
}


function saveCreateFolder(){
    var folder_name = $("input[name=folder_name]").val();
    if (folder_name == '') {
        alert('Did you forget to input folder name?');
    }
    else {
        if (folder_name.indexOf("/") > 0) {
            alert('Folder name can not contain /');
        }
        else{
            var URL = $('base').attr('href') + '/index.php?route=home/createfolder';
            $.ajax({
                type: "post",
                url: URL,
                data: {path:$('input[name=select_folder_path]').val(),name:folder_name},
                dataType: "json",
                success: function (response) {
                    if (response['status'] == 1) {
                        new PNotify({
                            title: 'Success',
                            text: 'Create folder ' + folder_name +' successfully!',
                            type: 'success'
                        });
                        $('#create-folder').modal('hide');
                        $(".sub-" + response['key'] + " .arrow").trigger( "click" );
                    }
                }

            });
        }
    }
}

//For list bucket folder path
function setSelectedPath(path) {
    $('input[name=bucket_path]').val(path);
}
//For add folder select folder path
function setFolderSelectedPath(path) {
    var key = path  + '${filename}';
    $('#fileupload').find('input[name=key]').val(key);

    $('input[name=select_folder_path]').val(path);
    $("span.selected-folder").html('<b>/'+ path + '</b>');
}

function loadFolder(frefix) {
    $('#contentFolder').prepend('<span class="loading"></span>');
    var URL = $('base').attr('href') + '/index.php?route=home/ajaxloadfolder';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix},
        dataType: "html",
        success: function (data) {
            $('.contentFolder .loading').remove();
            $('#contentFolder').html(data);
            clickFonder();
        }

    });
}
function clickFonder(){
    $('li .arrow').click(function(){
        var prefix = $(this).data('prefix');
        var id = $(this).data('id');
        loadSubFolder(prefix, id);
    });
    $('.name-prefix').click(function(){
        $('li .name-prefix').removeClass('active');
        $(this).addClass('active');
    });

    $(".tree-file li .item").hover(function(){
        $(this).find(".create-sub-folder").show();
    }, function(){
        $(this).find(".create-sub-folder").hide();
    });
}

function loadSubFolder(frefix, id) {
    var sub = $('.sub-' + id + ' .sub');
    var item = $('.sub-' + id + ' .item');
    item.find('.fa-caret-right')
        .removeClass('fa-caret-right')
        .addClass('fa-caret-down');

    $('#contentFolder').prepend('<span class="loading"></span>');
    var URL = $('base').attr('href') + '/index.php?route=home/ajaxloadfolder';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix},
        dataType: "html",
        success: function (data) {
            $('.contentFolder .loading').remove();
            $(sub).html(data);
            //$(sub).fadeIn(500);
            clickFonder();
        }

    });
}

function loadFrefix(frefix, page) {
    if (page == 0)
    $('#contentfrefix').prepend('<span class="loading"></span>');

    var load = $('.load-more');
    load.removeAttr( "onclick" );
    load.html('Loading...');
    var URL = $('base').attr('href') + '/index.php?route=home/ajaxloadfrefix';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'page' : page},
        dataType: "html",
        success: function (data) {
            load.parent().parent().remove();
            $('#contentfrefix .loading').remove();
            if (page == 0)
                $('#contentfrefix').html(data);
            else
                $('.content-file').append(data);

            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        }

    });
}

function loadSearchFrefix(page){
    if (page == 0)
        $('#contentfrefix').prepend('<span class="loading"></span>');

    var object = $('#txt-name');
    if (object.val().trim() == ""){
        object.css('border', '1px solid red');
        return false;
    } else {
        object.css('border', '1px solid #DDE2E8');
    }
    var load = $('.load-more');
    load.removeAttr( "onclick" );
    load.html('Loading...');
    var URL = $('base').attr('href') + '/index.php?route=home/ajaxloadsearchobjects';
    $.ajax({
        type: "post",
        url: URL,
        data: {'name': object.val() , 'page' : page},
        dataType: "html",
        success: function (data) {
            $('#contentfrefix .loading').remove();
            load.parent().parent().remove();
            if (page == 0)
                $('#contentfrefix').html(data);
            else
                $('.content-file').append(data);
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        }

    });
}

function delete_file(key, row) {
    var confirmBox = confirm('Are you sure you want to delete this file?');
    if (!confirmBox) return false;
    var URL = $('base').attr('href') + '/index.php?route=home/deletefile';
    $.ajax({
        type: "post",
        url: URL,
        data: {'key': key },
        dataType: "html",
        success: function (data) {
            if (data == "0"){
                $(".row-" + row).remove();
                new PNotify({
                    title: 'Success',
                    text: 'You deleted successfully!',
                    type: 'success'
                });
            } else {
                new PNotify({
                    title: 'Error',
                    text: data,
                    type: 'error'
                });
            }

        }

    });
}

function click_popup(src){
    $(".content-image").html("<img class='img-responsive' src='"+ src +"' />")
}

function htmlspecialchars(str) {
    if (typeof(str) == "string") {
        str = str.replace(".", "-");
        str = str.replace("&", "-");
        str = str.replace(" ", "-");
        str = str.replace("  ", "-");
        str = str.replace("   ", "-");
        str = str.replace("$", "-");
        str = str.replace("+", "-");
        str = str.replace("! ", "-");
        str = str.replace("@", "-");
        str = str.replace("#", "-");
        str = str.replace("$", "-");
        str = str.replace("%", "-");
        str = str.replace("^", "-");
        str = str.replace("&", "-");
        str = str.replace("*", "-");
        str = str.replace("(", "-");
        str = str.replace(")", "-");
        str = str.replace("/", "-");
        str = str.replace("+", "-");

    }
    return str;
}