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
            $.post('/index.php?route=home/generate-s3-signature', {bucket:bucket}, function(response){
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
            $('.list-folder-upload-file').prepend('<span class="loading"></span>');
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/list-bucket-folders';
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket},
                dataType: "html",
                success: function (data) {
                    $('.list-folder-upload-file .loading').remove();
                    $('.list-folder-upload-file').html(data);
                    PrettyS3FilesManager.S3Upload.doomFolderClickHandleForUploads();
                }
            });
        },
        doomFolderClickHandleForUploads: function() {
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
        loadBucketObjects: function(prefix) {
            $('#contentFolder').prepend('<span class="loading"></span>');
            $('#contentfrefix').prepend('<span class="loading"></span>');
            var bucket = $("select[name=bucket]").val();
            var URL = $('base').attr('href') + '/index.php?route=home/ajax-load-folder-prefix';
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'bucket' : bucket},
                dataType: "json",
                success: function (data) {
                    $('.contentFolder .loading').remove();
                    $('#contentfrefix .loading').remove();
                    $('#contentFolder').html(data['folder']);
                    $('#contentfrefix').html(data['frefix']);
                    clickFonder();
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
            $.ajax({
                type: "post",
                url: URL,
                data: {'frefix': prefix , 'page' : page , 'bucket' : bucket},
                dataType: "json",
                success: function (data) {
                    load.parent().parent().remove();
                    $('#contentfrefix .loading').remove();
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
            });
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
                            else {
                                PrettyS3FilesManager.Application.errorPopup(data.message);
                            }
                        }
                    });
                }
            }
        },
    },
    /*
    * Handle for file functionally
    * 
    * @function deleteMultiple delete multiple file at one time
    * */
    File: {
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
                        type: "post",
                        url: URL,
                        data: {'key': $(this).find("input").val() , 'bucket': bucket},
                        dataType: "json",
                        success: function (data) {
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
                        }
                    });
                }
            });
        }
    }   
};
