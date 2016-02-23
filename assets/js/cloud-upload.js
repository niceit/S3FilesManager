/*
* Cloud upload page script
* */

var instance_files = [];

$(function(){

    doomFormUpload('#cloud-upload-frm-1');

    $("select[name=bucket]").chosen();
    $("select[name=bucket]").change(function(){
        //Generate S3 Signature and Policy
        var bucket = $(this).val();
        if (bucket != '') {
            $(".cloud-upload-area .file-rows").html('');
            $(".add-file-btn").trigger('click');
            var region = $("input[name=region]").val();
            Application.generateFormS3Signature(".cloud-upload-form", bucket, region);
        }
    });

    //Modal
    $('#modal-add-bucket').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        buttons: {
            "Save": function() {
                var object = "#modal-add-bucket";
                Application.hideElementMessage(object, 'nSuccess');
                Application.hideElementMessage(object, 'nWarning');
                var name = $(object).find('input[name=bucket_name]').val();
                Application.displayLoadingField(object);
                $.post("/application/create-bucket", {name:name}, function(response){
                    response = JSON.parse(response);
                    Application.hideLoadingField(object);
                    if (response.status) {
                        Application.displayElementMessage(object, 'nSuccess', response.message);
                    }
                    else {
                        Application.displayElementMessage(object, 'nWarning', response.message);
                    }
                });
            },
            "Close":function() {
                $(this).dialog("close");
            }
        }
    });

    $('#modal-list-bucket-folder').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        buttons: {
            "Create new folder": function(){
                $(this).dialog('close');
                var object = '#modal-add-folder';
                var bucket = $("select[name=bucket]").val();
                $('#modal-add-folder').dialog('open');
                $('#modal-add-folder').find('span.selected-folder').html('/');
                $(object).find('.body').html("<img src='/assets/images/elements/loaders/5s.gif' /> &nbsp; <i>Please patience...</i>");
                $.post("/application/list-bucket-folders", {bucket:bucket, path:'/', 'add-folder':1},function(response){
                    $(object).find('.body').html(response);
                });
            },
            "Choose": function() {
                var bucket_select_path = $("#modal-list-bucket-folder input[name=bucket_path]").val();
                if (bucket_select_path == '') {
                    alert("You set an invalid path");
                }
                else {
                    $('input[name=destination_path]').val(bucket_select_path);
                    $(this).dialog('close');
                }
            },
            "Close":function() {
                $(this).dialog("close");
            }
        }
    });

    $('#modal-add-folder').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        buttons: {
            "Save": function(){
                var folder_name = $("input[name=folder_name]").val();
                if (folder_name == '') {
                    alert('Did you forget to input folder name?');
                }
                else {
                    if (folder_name.indexOf("/") > 0) {
                        alert('Folder name can not contain /');
                    }
                    else{
                        $(this).find('.message').hide();
                        $(this).find(".add-folder-loading").show();
                        var bucket = $("select[name=bucket]").val();
                        $.post("/application/create-folder",
                            {bucket:bucket, path:$('input[name=select_folder_path]').val(),name:folder_name},
                            function(response){
                                response = JSON.parse(response);
                                var object = '#modal-add-folder';
                                if (response.status) {
                                    $("input[name=folder_name]").val('');
                                    $(object).find('.body').html("<img src='/assets/images/elements/loaders/5s.gif' /> &nbsp; <i>Please patience...</i>");
                                    $.post("/application/list-bucket-folders", {bucket:bucket, path:'/', 'add-folder':1},function(response){
                                        $(object).find('.body').html(response);
                                    });
                                }
                                else {
                                    $(this).find('.message p').html(response.message);
                                    $(this).find('.message').show();
                                }
                                $(object).find(".add-folder-loading").hide();
                            });
                    }
                }
            },
            "Close":function() {
                $(this).dialog("close");
            }
        }
    });

    $('.add-bucket-btn').click(function () {
        $('#modal-add-bucket').dialog('open');

        return false;
    });

    $('.locate-path-btn').click(function () {
        var bucket = $("select[name=bucket]").val();
        if (bucket == '') {
            alert('Please select bucket first');
        }
        else {
            $('input[name=bucket_path]').val('/');
            $('#modal-list-bucket-folder').dialog('open');
            var object = '#modal-list-bucket-folder';
            $(object).find('.body').html("<img src='/assets/images/elements/loaders/5s.gif' /> &nbsp; <i>Please patience...</i>");
            $.post("/application/list-bucket-folders", {bucket:bucket, path:'/'},function(response){
                $(object).find('.body').html(response);
            });
        }

        return false;
    });

    $(".add-folder-btn").click(function(){
        var object = '#modal-add-folder';
        var bucket = $("select[name=bucket]").val();

        if (bucket == '') {
            alert('Please choose bucket first');
            return false;
        }

        $('#modal-add-folder').dialog('open');
        $('#modal-add-folder').find('span.selected-folder').html('/');
        $(object).find('.body').html("<img src='/assets/images/elements/loaders/5s.gif' /> &nbsp; <i>Please patience...</i>");
        $.post("/application/list-bucket-folders", {bucket:bucket, path:'/', 'add-folder':1},function(response){
            $(object).find('.body').html(response);
        });
    });

    $(".add-file-btn").click(function(){

        var current_element_count = $('.file-row').length;
        var next_element_id = current_element_count + 1;

        if ($("#file-" + next_element_id).lenght > 0) {
            next_element_id = next_element_id + 1000;
        }

        var html = '<div class="file-row"><form data-id="'+ next_element_id +'" class="form-horizontal group-border stripped cloud-upload-form" id="cloud-upload-frm-' + next_element_id + '" method="post" action="" enctype="multipart/form-data"><div class="preview grid2"><img id="preview-file-' + next_element_id + '" src="/application/images/no-image.jpg"></div><div class="file-upload formRow grid10"><input type="file" name="file" id="file-' + next_element_id + '" class="file-select" onchange="trigger_file_select(this)"/><a href="javascript:;" onclick="select_file(this);" class="buttonM bGreen btn-select-file"><span class="icol-files"></span><span>Select file</span></a> <a href="javascript:;" onclick="remove_file(this);" class="buttonM bRed remove-file-btn"><span class="icol-trash"></span><span>Remove</span></a><br><span class="file-name-selected">No file selected</span><div class="progress-upload"><span class="file-upload-loading"><img src="' + Application.webRoot + 'assets/images/elements/loaders/10s.gif"><i>Uploading...</i></span><span class="percent"></span></div><br><br><input type="text" name="file_path" placeholder="File complete path" readonly disabled></div><input type="hidden" name="AWSAccessKeyId" value=""><input type="hidden" name="acl" value="public-read"><input type="hidden" name="success_action_status" value="201"><input type="hidden" name="Content-Type" value=""> <input type="hidden" name="policy" value=""><input type="hidden" name="signature" value=""><input type="hidden" name="key" value=""></form></div>';
        $(".cloud-upload-area .file-rows").append(html);

        //Generate S3 Signature and Policy
        var bucket = $("select[name=bucket]").val();
        if (bucket != '') {
            var region = $("input[name=region]").val();
            Application.generateFormS3Signature(".cloud-upload-form", bucket, region);
        }

        doomFormUpload("#cloud-upload-frm-" + next_element_id);
    });

    $(".upload-file-btn").click(function(){

        var bucket = $("select[name=bucket]").val();
        if (bucket == '') {
            alert('Please select bucket first');
            return false;
        }

        if (instance_files.length <= 0) {
            alert('Please choose file for upload first');
        }
        else {
            var key;
            for (key in instance_files) {
                if (instance_files.hasOwnProperty(key)) {
                    instance_files[key].context.find(".progress-upload").children(".file-upload-loading").show();
                    instance_files[key].submit();
                    Application.removeObjectItemByKey(instance_files, key);
                }
            }
        }
    });
});

function loadBucketSubFolder(element, path, current_element, add_folder_option) {
    $(element).find('.arrow')
        .removeClass('.arrow')
        .addClass('arrow-down');
    var bucket = $("select[name=bucket]").val();
    $(current_element).removeAttr('onclick');
    $.post("/application/list-bucket-folders", {bucket:bucket, path:path, 'add-folder':add_folder_option},function(response){
        $(element).append(response);
    });
}

//For list bucket folder path
function setSelectedPath(path) {
    $('input[name=bucket_path]').val(path);
}
//For add folder select folder path
function setFolderSelectedPath(path) {
    $('input[name=select_folder_path]').val(path);
    $("span.selected-folder").html('<b>/'+ path + '</b>');
}

function select_file(element) {
    $(element).prev('.file-select').click();
}

function trigger_file_select(element) {
    var filename = $(element).val().replace(/C:\\fakepath\\/i, '');
    $(element).parent('.file-upload').find('.file-name-selected').html(filename);

    var preview_id = '#' + $(element).parents('.file-row').find('.preview img').attr('id');
    var preview = document.querySelector(preview_id);
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        var id = '#' + $(element).attr('id');
        var file = document.querySelector(id).files[0];

        // Only process image files.
        if (!file.type.match('image.*')) {
            preview.src = Application.webRoot + 'application/images/no-preview-available.png';
            return false;
        }

        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
    else {
        preview.src = Application.webRoot + 'application/images/no-preview-available.png';
    }
}

function remove_file(element) {
    var index = $(element).parents('.file-row').find('form.cloud-upload-form').attr('data-id');
    if (instance_files.hasOwnProperty(index)) {
        Application.removeObjectItemByKey(instance_files, index);
    }
    $(element).parents('.file-row').find('.cloud-upload-form').unbind('fileupload');
    $(element).parents('.file-row').remove();
    return;
}

function doomFormUpload(element) {
    //Handle file upload
    $(element).fileupload({
        forceIframeTransport: true,
        url: $(this).attr('action'),
        dataType: 'json',
        crossDomain: true,
        type: 'POST',
        autoUpload: true,
        add: function (event, data){

            var file_type = data.files[0].type;

            var path = $("input[name=destination_path]").val();
            if (path == '/') {
                path = '';
            }
            $(this).find('input[name=Content-Type]').val(file_type);

            var key = path + '${filename}';
            $(this).find('input[name=key]').val(key);

            // Use XHR, fallback to iframe
            options = $(this).fileupload('option');
            use_xhr = !options.forceIframeTransport &&
                ((!options.multipart && $.support.xhrFileUpload) ||
                $.support.xhrFormDataFileUpload);

            if (!use_xhr) {
                using_iframe_transport = true;
            }

            //For upload
            var context = $(this).find('.file-upload');
            data.context = context;

            instance_files[$(this).attr('data-id')] = data;
        },
        progress: function(e, data){
            var percent = parseInt(data.loaded / data.total * 100);
            /*data.context.find(".progress-upload .ui-progressbar-value").css('display', 'block');
            data.context.find(".progress-upload .ui-progressbar-value").css ("width", percent + "%");
            */
            data.context.find(".progress-upload").children('span.percent').html (percent + "%");
            if (percent == 100){
                data.context.find(".progress-upload").children(".file-upload-loading").hide();
                data.context.find(".progress-upload").children(".percent").html ("Finished!");
            }
        },
        fail: function(e, data) {
            window.onbeforeunload = null;
        },
        success: function(result, status, jqXHR) {

        },
        done: function (event, data) {
            var destination_path = $("input[name=destination_path]").val();
            if (destination_path == '/') {
                destination_path = '';
            }
            var server_path = $(element).attr('action') + destination_path + data.files[0].name;
            $(element).find('input[name=file_path]').val(server_path);
            $(element).find('input[name=file_path]').show();
        }
    });
}