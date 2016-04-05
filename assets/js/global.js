/*
* Pretty S3 Files Manager
* 
* @Main application object
* */
PrettyS3FilesManager = {
    /*
    * Common application functions
    *
    * @function displayElementMessageWithDelay display message with timeout
    * @function displayElementMessage display message inside a specify element
    * @function hideElementMessage hide message inside a specify element
    * @function displayLoadingField find and display message under an area
    * @function hideLoadingField find and remove message under an area
    * @function errorPopup display error popup detail from server
    * @function putLoadingState put area disabled for loading state
    * @function removeLoadingState remove area loading state
    * @function removeObjectItemByValue remove item from array
    * @function removeObjectItemByKey remove item from array by index
    * */
    Application: {
        webRoot: '/',
        requestTimeout: 300000, // 5 Mints
        htmlspecialchars: function(str) {
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
        },
        displayElementMessageWithDelay: function (element, type, message, timeout) {
            $(element).find('.message')
                .addClass('nNote')
                .addClass(type)
                .find('p').html(message);

            $(element).find('.message').fadeIn(1500);

            setTimeout(function(){
                Application.hideElementMessage(element, type);
            }, timeout);
        },
        displayElementMessage: function (element, type, message) {
            $(element).find('.message')
                .addClass('nNote')
                .addClass(type)
                .find('p').html(message);

            $(element).find('.message').fadeIn(1500);
        },
        hideElementMessage: function (element, type) {
            $(element).find('.message')
                .removeClass("nNote")
                .removeClass(type).fadeOut(1500);
        },
        displayLoadingField: function (element) {
            $(element).find('.loading-field').show();
        },
        hideLoadingField: function (element) {
            $(element).find('.loading-field').hide();
        },
        errorPopup: function(message) {
            var jPopupElement = $("#error-popup");
            jPopupElement.find("#content-detail").find(".alert-error").html(message);
            jPopupElement.modal('show');
        },
        putLoadingState: function (areaElement) {
            $(areaElement).attr("style", "position: relative;");
            $(areaElement).append('<span class="loading"></span>');
        },
        removeLoadingState: function (areaElement) {
            $(areaElement).removeAttr("style");
            $(areaElement).find(".loading").remove();
        },
        removeObjectItemByValue: function(array, item) {
            for(var i in array){
                if(array[i]==item){
                    array.splice(i,1);
                    break;
                }
            }
        },
        removeObjectItemByKey: function(array, index) {
            array.splice(index,1);
        },
        ajaxErrorHandler: function (response, textStatus, errorThrown, loadingElement, targetContentElement) {
            if(textStatus === 'timeout')
            {
                PrettyS3FilesManager.Application.errorPopup("Request timeout! Please check your network connection and try again later!");
                if (targetContentElement != '') {
                    $(targetContentElement).html('Connect Timeout');
                }
            }
            else {
                PrettyS3FilesManager.Application.errorPopup("An error occurred: " + textStatus);
            }
            PrettyS3FilesManager.Application.removeLoadingState(loadingElement);
        },
    },
    /*
    * Perform S3 upload popup functionally
    *
    * @function generateFromS3Signature request to server to get S3 authenticate signature, policy, etc...
    * @function loadAvailableFolderForUploads will load available folders preparing for uploading file(s)
    * @function doomFolderClickHandleForUploads will handle click event for choosing folder for uploading
    * */
    S3Upload: {
        generateFormS3Signature: function (element, bucket, region) {
            $.post($('base').attr('href') + '/index.php?route=home/generate-s3-signature', {bucket:bucket}, function(response){
                if (response['status']) {
                    $(element).each(function(){
                        $(this).attr('action', 'https://' + bucket + '.s3-' + region + '.amazonaws.com/')
                        $(this).find('input[name=AWSAccessKeyId]').val(response['accessKey']);
                        $(this).find('input[name=policy]').val(response['policy']);
                        $(this).find('input[name=signature]').val(response['signature']);
                    });
                }
            });
        },
        loadAvailableFolderForUploads: function(prefix) {
            $('#upload-file-modal').modal('show');
            $("input[name=folder_name]").val('');
            PrettyS3FilesManager.Application.putLoadingState(".list-folder-upload-file");
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket, 'popup_type': 'upload_file', 'add_folder': 0},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $('.list-folder-upload-file').html(data);
                        PrettyS3FilesManager.S3Upload.doomFolderClickHandleForUploads();
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                    $('.list-folder-upload-file .loading').remove();
                    PrettyS3FilesManager.Application.removeLoadingState(".list-folder-upload-file");
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(response, textStatus, errorThrown, ".list-folder-upload-file", ".list-folder-upload-file");
                },
            });
        },
        setPopupUploadFileSelectPath: function (path) {
            var key = path  + '${filename}';
            $('#fileupload').find('input[name=key]').val(key);

            if (path != "/")
                $("span.file-upload-selected-folder").html('<b>/'+ path + '</b>');
            else
                $("span.file-upload-selected-folder").html('<b>/</b>');
        },
        loadPopupUploadFileSubFolder: function (element) {
            var id = $(element).attr('data-id');
            var sub = $('.sub-' + id + ' .sub');
            var item = $('.sub-' + id + ' .item');
            var frefix = $(element).attr('data-prefix');
            item.find('.fa-caret-right')
                .removeClass('fa-caret-right')
                .addClass('fa-caret-down');

            var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
            var bucket = $("select[name=bucket]").val();
            PrettyS3FilesManager.Application.putLoadingState('.list-folder-upload-file');
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': frefix , 'bucket' : bucket, 'popup_type': 'upload_file', 'add_folder': 0},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $(sub).html(data);
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                    PrettyS3FilesManager.Application.removeLoadingState('.list-folder-upload-file');
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(response, textStatus, errorThrown, '.list-folder-upload-file', '.list-folder-upload-file');
                },
            });
        },
        doomFolderClickHandleForUploads: function() {
            $('li .arrow-item').click(function(){
                var prefix = $(this).data('prefix');
                var id = $(this).data('id');

                var key = prefix  + '${filename}';
                $('#fileupload').find('input[name=key]').val(key);
            });

            $(".tree-file-row").click(function(){
                $(".tree-file-row").removeClass("active_new");
                $(this ).addClass("active_new");
            });
        },
    },
    /*
    * Handle for bucket functionally
    *
    * @function loadBucketObjects load all objects under a bucket (folders and files)
    * @function loadObjects load objects under a folder
    * @function createFolder create new folder/sub-folder under bucket
    * */
    Bucket: {
        currentDirectory: '/',
        loadBucketObjects: function(prefix) {
            PrettyS3FilesManager.Application.putLoadingState("#contentFolder");
            PrettyS3FilesManager.Application.putLoadingState("#contentfrefix");
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-folder-prefix';
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (data) {
                    if (data.status) {
                        data = data.data;
                        $('.contentFolder .loading').remove();
                        $('#contentfrefix .loading').remove();
                        $('#contentFolder').html(data['folder']);
                        $('.breadcrumbs').html(data['folder_breadcrumb']);
                        $('#contentfrefix').html(data['frefix']);

                        PrettyS3FilesManager.Bucket.handleBucketFolderClick();

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
                    else {
                        PrettyS3FilesManager.Application.errorPopup(data.message);
                    }

                    PrettyS3FilesManager.Application.removeLoadingState("#contentFolder");
                    PrettyS3FilesManager.Application.removeLoadingState("#contentfrefix");
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '#contentFolder, #contentfrefix',
                        '#contentFolder, #contentfrefix'
                    );
                },
            });
        },
        loadObjects: function(prefix, page) {
            if (page == 0)
                $('#contentfrefix').prepend('<span class="loading"></span>');
    
            $( ".item .arrow" ).each(function( index ) {
                if ( $(this).data("prefix") == prefix ){
                    $(this).trigger("click");
                }
            });
    
            var load = $('.load-more');
            load.removeAttr( "onclick" );
            load.html('Loading...');
            var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-prefix';
            var bucket = $("select[name=bucket]").val();
            PrettyS3FilesManager.Bucket.currentDirectory = prefix;
            PrettyS3FilesManager.Application.putLoadingState("#contentfrefix");
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'page' : page , 'bucket' : bucket},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        load.parent().parent().remove();
                        if (page == 0)
                            $('#contentfrefix').html(data['prefix']);
                        else
                            $('.content-file').append(data['prefix']);

                        $('.breadcrumbs').html(data['folder']);

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
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }

                    PrettyS3FilesManager.Application.removeLoadingState("#contentfrefix");
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '#contentfrefix', '#contentfrefix'
                    );
                },
            });
        },
        handleBucketFolderClick: function() {
            $('li .arrow').click(function(){
                var prefix = $(this).data('prefix');
                var id = $(this).data('id');
                PrettyS3FilesManager.Bucket.handleBrowseSubFolder(prefix, id);
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
        },
        handleBrowseSubFolder: function (prefix, id) {
            var sub = $('.sub-' + id + ' .sub');
            var item = $('.sub-' + id + ' .item');
            item.find('.fa-caret-right')
                .removeClass('fa-caret-right')
                .addClass('fa-caret-down');
            if (prefix == "/")
                $('#contentFolder').prepend('<span class="loading"></span>');
            else
                $(sub).html('<span class="loading subloading"></span>');
            var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-folder';
            var bucket = $("select[name=bucket]").val();
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $('.contentFolder .loading').remove();
                        $(sub).html(data['folder']);
                        PrettyS3FilesManager.Bucket.handleBucketFolderClick();
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '#contentFolder', ''
                    );
                },
            });
        },
        reloadObjects: function(){
            PrettyS3FilesManager.Bucket.loadObjects(PrettyS3FilesManager.Bucket.currentDirectory, 0);
        },
        reloadFolders: function(){
            var prefix = "/";
            PrettyS3FilesManager.Application.putLoadingState('#contentFolder');
            var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-folder';
            var bucket = $("select[name=bucket]").val();
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $('#contentFolder').html(data['folder']);
                        PrettyS3FilesManager.Bucket.handleBucketFolderClick();
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                    PrettyS3FilesManager.Application.removeLoadingState('#contentFolder');
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '#contentFolder', '#contentFolder'
                    );
                },
            });
        },
        loadAvailableFolderForCreatingFolder: function(prefix) {
            $('#create-folder').modal('show');
            $("input[name=folder_name]").val('');
            PrettyS3FilesManager.Application.putLoadingState('.list-folder');
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket, 'popup_type': 'create_folder'},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $('.list-folder').html(data);
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                    $('.list-folder .loading').remove();
                    PrettyS3FilesManager.Application.removeLoadingState('.list-folder');
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '.list-folder', '.list-folder'
                    );
                },
            });
        },
        setPopupCreateFolderSelectPath: function (path) {

            $('input[name=select_folder_path]').val(path);
            if (path != "/")
                $("span.create-folder-selected-folder").html('<b>/'+ path + '</b>');
            else
                $("span.create-folder-selected-folder").html('<b>/</b>');
        },
        loadPopupCreateFolderSubFolder: function(element) {
            var id = $(element).attr('data-id');
            var sub = $('.sub-' + id + ' .sub');
            var item = $('.sub-' + id + ' .item');
            var frefix = $(element).attr('data-prefix');
            item.find('.fa-caret-right')
                .removeClass('fa-caret-right')
                .addClass('fa-caret-down');

            var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
            var bucket = $("select[name=bucket]").val();
            PrettyS3FilesManager.Application.putLoadingState('.list-folder');
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': frefix , 'bucket' : bucket, 'popup_type': 'create_folder'},
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $(sub).html(data);
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                    PrettyS3FilesManager.Application.removeLoadingState('.list-folder');
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '.list-folder', ''
                    );
                },
            });
        },
        createBucket: function(btnElement, inputFieldElement){
            inputFieldElement.css("border", "1px solid #DDE2E8");
            var bucket = inputFieldElement.val().trim();
            if (bucket == ""){
                inputFieldElement.css("border", "1px solid red");
                return false;
            } else {
                inputFieldElement.attr("disabled","disabled");
                btnElement.attr("disabled","disabled");
                PrettyS3FilesManager.Application.putLoadingState('.creating-bucket-content');
                var URL = $('base').attr('href') + '/index.php?route=home/create-bucket';
                $.ajax({
                    type: "post",
                    url: URL,
                    data: {'name': bucket},
                    dataType: "json",
                    timeout: PrettyS3FilesManager.Application.requestTimeout,
                    success: function (data) {
                        if (data['status'] == 1) {
                            $('#create-new-bucket-popup').modal('hide');
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
                            inputFieldElement.removeAttr("disabled");
                            btnElement.removeAttr("disabled");
                            PrettyS3FilesManager.Application.errorPopup(data.message);
                        }
                        PrettyS3FilesManager.Application.removeLoadingState('.creating-bucket-content');
                    },
                    error: function (response, textStatus, errorThrown) {
                        PrettyS3FilesManager.Application.ajaxErrorHandler(
                            response, textStatus, errorThrown,
                            '.create-bucket-content', ''
                        );
                    },
                });
            }
        },
        createFolder: function() {
            var folder_name = $("input[name=folder_name]").val();
            if (folder_name == '') {
                new PNotify({
                    title: 'Oop!',
                    text: 'Did you forget to input folder name?',
                    type: 'error'
                });
            }
            else {
                if (folder_name.indexOf("/") > 0) {
                    new PNotify({
                        title: 'Oop!',
                        text: 'Folder name must not contain /',
                        type: 'error'
                    });
                }
                else{
                    PrettyS3FilesManager.Application.putLoadingState('.create-folder-content');
                    var bucket = $("select[name=bucket]").val();
                    var URL = $('base').attr('href') + '/index.php?route=home/create-folder';
                    $.ajax({
                        type: "post",
                        url: URL,
                        data: {path:$('input[name=select_folder_path]').val(),name:folder_name , 'bucket': bucket},
                        dataType: "json",
                        timeout: PrettyS3FilesManager.Application.requestTimeout,
                        success: function (response) {
                            if (response['status'] == 1) {
                                new PNotify({
                                    title: 'Success',
                                    text: 'Create folder ' + folder_name +' successfully!',
                                    type: 'success'
                                });
                                $('#create-folder').modal('hide');
                                $('#status_create_folder').val('1');
                                $('#status_upload').val('1');
                                $(".sub-" + response['key'] + " .arrow").trigger( "click" );
                                if (response['path'] == ''){
                                    PrettyS3FilesManager.Bucket.reloadFolders();
                                }
                            }
                            else {
                                PrettyS3FilesManager.Application.errorPopup(data.message);
                            }
                            PrettyS3FilesManager.Application.removeLoadingState('.create-folder-content');
                        },
                        error: function (response, textStatus, errorThrown) {
                            PrettyS3FilesManager.Application.ajaxErrorHandler(
                                response, textStatus, errorThrown,
                                '.create-folder-content', ''
                            );
                        },
                    });
                }
            }
        },
        deleteFolder: function(key, object_sub, id) {
            $(".sub-" + id).append('<span class="loading subloading"></span>');
            var URL = $('base').attr('href') + '/index.php?route=home/delete-folder';
            var bucket = $("select[name=bucket]").val();
            $.ajax({
                type: "post",
                url: URL,
                data: {'key': key , 'bucket' : bucket , 'object_sub' : object_sub},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (data) {
                    $(".sub-" + id).find(".loading").remove();
                    data = JSON.parse(data);
                    if (data.status == 2){
                        $(".content-confirm").html("This folder has sub-folders/files under it. Are you sure want to remove all? <br/> ");
                        $("#confirm-delete").modal('show');
                        $(".btn-delete-all").attr("onclick", "PrettyS3FilesManager.Bucket.deleteFolder('" + key + "', '1' , '" + id + "');");
                        return false;
                    }

                    if (data.status){
                        $(".sub-" + data.curent_id).remove();
                        PrettyS3FilesManager.Bucket.handleBrowseSubFolder(data.parent_key, data.id);
                        var prefix_curent = $("#prefix_curent").val();
                        if (data.curent_id == prefix_curent){
                            PrettyS3FilesManager.Bucket.loadObjects(data.parent_key, 0);
                            $(".name-" +  data.id).addClass("active");
                        }
                        new PNotify({
                            title: 'Success',
                            text: 'Object had been removed!',
                            type: 'success'
                        });
                        $("#confirm-delete").modal('hide');
                    } else {
                        PrettyS3FilesManager.Application.errorPopup(data.message);
                    }
                }
            });
        },
    },
    /*
    * Handle for file functionally
    * 
    * @function deleteMultiple delete multiple file at one time
    * */
    File: {
        delete: function (key, row) {
            var confirmBox = confirm('Are you sure you want to delete this file?');
            if (!confirmBox) return false;
            var URL = $('base').attr('href') + '/index.php?route=home/delete-file';
            var bucket = $("select[name=bucket]").val();
            PrettyS3FilesManager.Application.putLoadingState("#contentfrefix");
            $.ajax({
                type: "post",
                url: URL,
                data: {'key': key , 'bucket' : bucket},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status){
                        $(".row-" + row).remove();
                        new PNotify({
                            title: 'Success',
                            text: 'File had been removed!',
                            type: 'success'
                        });
                    } else {
                        PrettyS3FilesManager.Application.errorPopup(data.message);
                    }
                    PrettyS3FilesManager.Application.removeLoadingState("#contentfrefix");
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '#contentfrefix', ''
                    );
                },
            });
        },
        deleteMultiple: function () {
            var is_check = false;
            $( ".content-file .icheckbox_flat-green" ).each(function( index ) {
                if ($(this).hasClass("checked")) {
                    is_check = true;
                }
            });

            if (!is_check){
                new PNotify({
                    title: 'Oop!',
                    text: 'Please choose file(s) to remove!',
                    type: 'error'
                });
                return false;
            }

            var confirmBox = confirm('Are you sure want to delete them?');
            if (!confirmBox) return false;

            var bucket = $("select[name=bucket]").val();
            $( ".content-file .icheckbox_flat-green" ).each(function( index ) {
                var row = $(this).find("input").data("id");
                if ($(this).hasClass("checked")) {
                    PrettyS3FilesManager.Application.putLoadingState('contentfrefix');
                    var URL = $('base').attr('href') + '/index.php?route=home/delete-file';
                    $.ajax({
                        type: "POST",
                        url: URL,
                        data: {'key': $(this).find("input").val() , 'bucket': bucket},
                        dataType: "json",
                        timeout: PrettyS3FilesManager.Application.requestTimeout,
                        success: function (data) {
                            data = JSON.parse(data);
                            PrettyS3FilesManager.Application.removeLoadingState('contentfrefix');
                            if (data.status) {
                                new PNotify({
                                    title: 'Success',
                                    text: 'Object(s) has been deleted!',
                                    type: 'success'
                                });
                                $(".row-" + row).remove();
                            }
                            else {
                                PrettyS3FilesManager.Application.errorPopup(data.message);
                            }
                        },
                        error: function (response, textStatus, errorThrown) {
                            PrettyS3FilesManager.Application.ajaxErrorHandler(
                                response, textStatus, errorThrown,
                                '#contentfrefix', ''
                            );
                        },
                    });
                }
            });
        },
        fileProperties: function (key, url) {
            PrettyS3FilesManager.Application.putLoadingState('#content-detail');
            $('#detail-file').modal('show');
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/ajax-detail-file';
            $.ajax({
                type: "post",
                url: URL,
                data: {'key': key , 'url' : url , 'bucket' : bucket},
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        $("#content-detail").html(data);
                        $('input.flat').iCheck({
                            checkboxClass: 'icheckbox_flat-green',
                            radioClass: 'iradio_flat-green'
                        });

                        //Update Permissions
                        $(".btn-save-permissions").click(function(){
                            PrettyS3FilesManager.Application.putLoadingState("#permissions");
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
                                        PrettyS3FilesManager.Application.errorPopup(data.message);
                                    }
                                    PrettyS3FilesManager.Application.removeLoadingState("#permissions");
                                }
                            });
                        });
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '#permissions', '#permissions'
                    );
                },
            });
        },
        previewImage: function (src) {
            $(".content-image").html("<img class='img-responsive' src='"+ src +"' />");
        },
        editHeader: function () {
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
                    timeout: PrettyS3FilesManager.Application.requestTimeout,
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
                    },
                    error: function (response, textStatus, errorThrown) {
                        PrettyS3FilesManager.Application.ajaxErrorHandler(
                            response, textStatus, errorThrown,
                            '#permissions', ''
                        );
                    },
                });
            });
        },
        search: function (page) {
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
                dataType: "json",
                timeout: PrettyS3FilesManager.Application.requestTimeout,
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
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
                    else {
                        PrettyS3FilesManager.Application.errorPopup(response.message);
                    }

                    $('#contentfrefix .loading').remove();
                },
                error: function (response, textStatus, errorThrown) {
                    PrettyS3FilesManager.Application.ajaxErrorHandler(
                        response, textStatus, errorThrown,
                        '.contentfrefix', ''
                    );
                },
            });
        },
        breadCrumbNavigator: function (frefix, page, name) {
            $(".name-prefix").removeClass("active");
            $(".name-" + name).addClass("active");
            PrettyS3FilesManager.Bucket.loadObjects(frefix, page);
        },
    } ,
};
