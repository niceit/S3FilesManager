var instance_files = [];
jQuery(function(){

    var region = $("input[name=region]").val();
    var bucket = $("select[name=bucket]").val();
    Application.generateFormS3Signature(".cloud-upload-form", bucket, region);
    loadFrefix("/", 0);
    loadFolder('/');
    $('#btn-search').click(function(){
        loadSearchFrefix(0);
    });

    $('#btn-create-new-bucket').click(function(){
        $("input[name=name-bucket]").removeAttr("disabled").val('');
        $("#save-bucket").removeAttr("disabled");
        $('#create-new-bucket-popup').modal('show');
    });

    $('#save-bucket').click(function(){
        var element =  $("input[name=name-bucket]");
        element.css("border", "1px solid #DDE2E8");
        var bucket = element.val().trim();
        if (bucket == ""){
            element.css("border", "1px solid red");
            return false;
        } else {
            element.attr("disabled","disabled");
            $(this).attr("disabled","disabled");
            var URL = $('base').attr('href') + '/index.php?route=home/create-bucket';
            $.ajax({
                type: "post",
                url: URL,
                data: {'name': bucket},
                dataType: "json",
                success: function (data) {
                    if (data['status'] == 1) {
                        $('#create-new-folder').modal('hide');
                        new PNotify({
                            title: 'Success',
                            text: data['message'],
                            type: 'success'
                        });
                        var bucket_curent = $("select[name=bucket]").val();
                        var html = '<select name="bucket" class="select_butket form-control" tabindex="-1">';
                        $.each(data['buckets'], function( index, value ) {
                            if (bucket_curent == value['Name'])
                                html += "<option selected='selected' value='" + value['Name'] + "'>" + value['Name'] + "</option>";
                            else
                                html += "<option value='" + value['Name'] + "'>" + value['Name'] + "</option>";
                        });
                        html += "</select>";
                        $(".select_butket_div").html(html);
                        $(".select_butket").select2();
                    } else {
                        new PNotify({
                            title: 'Error',
                            text: data['message'],
                            type: 'Error'
                        });
                    }
                }

            });
        }
    });

    $('#btn-create-new-folder').click(function(){
        $('.content-create-folder').slideDown();
        loadFolderNew('/');
    });
    
    $('#upload-file').click(function(){
        $(".template-upload").remove();
        var bucket = $("select[name=bucket]").val();
        if (bucket == '') {
            alert('Please select bucket first');
        } else {
            $('.content-upload-file').slideDown();
           // $('.title-popup').html('Upload file');
          //  $("#list-folder").css("border-right", '1px solid #ddd');
            loadFolderUpload('/');
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
            loadFolder('/');
            loadFrefix("/", 0);
        }
    });


    $("#clear-search").click(function(){
        $('#txt-name').val('');
        if (typeof  $(".name-prefix.active").html() == "undefined" )
             loadFrefix("/", 0);
        else{
            var frefix = $(".name-prefix.active").html();
            loadFrefix(frefix+"/", 0);
        }
    });

});

function refresh_butket(){
    $('#txt-name').val('');
    loadFolder('/');
    loadFrefix("/", 0);
}

function is_check(){
    var is_check = true;
    $( ".content-file .icheckbox_flat-green" ).each(function( index ) {
        if ($(this).hasClass("checked")) {
            is_check = false;
        }
    });
    return is_check;
}

function multiple_delete(){
    if (is_check()){
        alert("Please check file to remove!");
        return false;
    }
    var confirmBox = confirm('Are you sure you want to delete this multiple file?');
    if (!confirmBox) return false;

    var bucket = $("select[name=bucket]").val();
    $( ".content-file .icheckbox_flat-green" ).each(function( index ) {

        var row = $(this).find("input").data("id");
        if ($(this).hasClass("checked")) {
            var URL = $('base').attr('href') + '/index.php?route=home/delete-file';
            $.ajax({
                type: "post",
                url: URL,
                data: {'key': $(this).find("input").val() , 'bucket': bucket},
                dataType: "html",
                success: function (data) {
                    $(".row-" + row).remove();
                }

            });
        }
    });
    new PNotify({
        title: 'Success',
        text: 'You deleted successfully!',
        type: 'success'
    });

}

function loadFolderNewLeft(frefix){
    setFolderSelectedPath(frefix);
    loadFolderNew(frefix);
    $('.content-create-folder').slideDown();
    $('.content-upload-file').hide();
    $('.title-popup').html('Add new bucket folder');

}

function loadFolderUpload(frefix) {
    $('#upload-file-modal').modal('show');
    $("input[name=folder_name]").val('');
    $('.list-folder-upload-file').prepend('<span class="loading"></span>');
    var bucket = $("select[name=bucket]").val();
    var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'bucket' : bucket},
        dataType: "html",
        success: function (data) {
            $('.list-folder-upload-file .loading').remove();
            $('.list-folder-upload-file').html(data);
            clickFonderNew();
        }

    });
}

function loadFolderNew(frefix) {
    $('#create-folder').modal('show');
    $("input[name=folder_name]").val('');
    $('#list-folder').prepend('<span class="loading"></span>');
    var bucket = $("select[name=bucket]").val();
    var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'bucket' : bucket},
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
    var bucket = $("select[name=bucket]").val();
    var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'bucket': bucket},
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

    $(".tree-file-row").click(function(){
        $(".tree-file-row").removeClass("active_new");
        $(this ).addClass("active_new");
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
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/create-folder';
            $.ajax({
                type: "post",
                url: URL,
                data: {path:$('input[name=select_folder_path]').val(),name:folder_name , 'bucket': bucket},
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
    $('select[name=bucket_path]').val(path);
}
//For add folder select folder path
function setFolderSelectedPath(path) {
    var key = path  + '${filename}';
    $('#fileupload').find('input[name=key]').val(key);

    $('input[name=select_folder_path]').val(path);
    if (path != "/")
        $("span.selected-folder").html('<b>/'+ path + '</b>');
    else
        $("span.selected-folder").html('<b>/</b>');
}

function loadFolder(frefix) {
    $('#contentFolder').prepend('<span class="loading"></span>');
    var bucket = $("select[name=bucket]").val();
    var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-folder';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'bucket' : bucket},
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
    if (frefix == "/")
        $('#contentFolder').prepend('<span class="loading"></span>');
    else
        $(sub).html('<span class="loading subloading"></span>');
    var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-folder';
    var bucket = $("select[name=bucket]").val();
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'bucket' : bucket},
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

    $( ".item .arrow" ).each(function( index ) {
        if ( $(this).data("prefix") == frefix ){
            $(this).trigger("click");
        }
    });

    var load = $('.load-more');
    load.removeAttr( "onclick" );
    load.html('Loading...');
    var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-prefix';
    var bucket = $("select[name=bucket]").val();
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix , 'page' : page , 'bucket' : bucket},
        dataType: "html",
        success: function (data) {
            load.parent().parent().remove();
            $('#contentfrefix .loading').remove();
            if (page == 0)
                $('#contentfrefix').html(data);
            else
                $('.content-file').append(data);

            $(".tree-file-content li .li-custom").hover(function(){
                $(this).find(".act").show();
            }, function(){
                $(this).find(".act").hide();
            });

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
    var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-search-objects';
    var bucket = $("select[name=bucket]").val();
    $.ajax({
        type: "post",
        url: URL,
        data: {'name': object.val() , 'page' : page , 'bucket': bucket},
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
    var URL = $('base').attr('href') + '/index.php?route=home/delete-file';
    var bucket = $("select[name=bucket]").val();
    $.ajax({
        type: "post",
        url: URL,
        data: {'key': key , 'bucket' : bucket},
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

function popup_detail(key, url){
    $('#content-detail').prepend('<span class="loading"></span>');
    $('#detail-file').modal('show');
    var bucket = $("select[name=bucket]").val();
    var URL = $('base').attr('href') + '/index.php?route=home/ajax-detail-file';
    $.ajax({
        type: "post",
        url: URL,
        data: {'key': key , 'url' : url , 'bucket' : bucket},
        dataType: "html",
        success: function (data) {
            $("#content-detail").html(data);
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            //Update Permissions
            $(".btn-save-permissions").click(function(){
                Application.putLoadingState("#permissions");
                var data = $("form[name=permission_form]").serialize();
                var URL = $('base').attr('href') + '/index.php?route=home/update-permissions';
                data += '&data[bucket]=' + $("select[name=bucket]").val();
                $.ajax({
                    type: "POST",
                    url: URL,
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data.status) {
                            new PNotify({
                                title: 'Success',
                                text: data.message,
                                type: 'success',
                                timer: 4,
                            });
                        }
                        else {
                            Application.errorPopup(data.message);
                        }
                        Application.removeLoadingState("#permissions");
                    }
                });
            });

        }
    });
}
function edit_header(){
    $(".name-contenttype").hide();
    $(".edit-type").hide();
    $(".row-type").append("<span class='action-type'><input value='" +  $(".name-contenttype").text() + "' id='txt-content-type' type='text' style='width: 40%' class='form-control pull-left' /><a style='margin-left: 10px;' class='btn btn-primary pull-left save-type' href='javascript:;'><i class='fa fa-save'></i> Save</a><a class='btn btn-danger pull-left cancel-type' href='javascript:;'><i class='fa fa-remove'></i> Cancel</a></span>");
    $(".cancel-type").click(function(){
        $(".name-contenttype").show();
        $(".edit-type").show();
        $(".action-type").remove();
    });
    $(".save-type").click(function(){
        var bucket = $("select[name=bucket]").val();
        var URL = $('base').attr('href') + '/index.php?route=home/update-header-content-type';
        $.ajax({
            type: "post",
            url: URL,
            data: {'key': $("#key").val(), 'contentType': $('#txt-content-type').val() , 'bucket' :  bucket},
            dataType: "html",
            success: function (data) {
                $(".name-contenttype").html(data);
                $(".name-contenttype").show();
                $(".edit-type").show();
                $(".action-type").remove();

                new PNotify({
                    title: 'Success',
                    text: 'Update Content Type successfully!',
                    type: 'success'
                });
            }
        });

    });


}



function icheck_grant(grant){
    alert(grant);
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