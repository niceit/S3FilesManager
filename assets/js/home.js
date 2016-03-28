/*
 * Pretty S3 Files Manager
 *
 * @Scripts execution for dashboard page
 * */
jQuery(function(){
    var region = $("input[name=region]").val();
    var bucket = $("select[name=bucket]").val();
    PrettyS3FilesManager.S3Upload.generateFormS3Signature(".cloud-upload-form", bucket, region);
    PrettyS3FilesManager.Bucket.loadBucketObjects('/');
    $('#btn-search').click(function(){
        PrettyS3FilesManager.File.search(0);
    });

    $('#btn-create-new-bucket').click(function(){
        $("input[name=name-bucket]").removeAttr("disabled").val('');
        $("#save-bucket").removeAttr("disabled");
        $('#create-new-bucket-popup').modal('show');
    });

    $('#save-bucket').click(function(){
        PrettyS3FilesManager.Bucket.createBucket($(this), $("input[name=name-bucket]"));
    });

    $('#btn-create-new-folder').click(function(){
        $('.content-create-folder').slideDown();
        var bucket = $("select[name=bucket]").val();
        var  bucket_old = $('#old_bucket').val();
        if (bucket_old == '' || bucket != bucket_old ){
            PrettyS3FilesManager.Bucket.loadAvailableFolderForCreatingFolder('/');
            $('#old_bucket').val(bucket);
        } else {
            $('#create-folder').modal('show');
        }
    });
    
    $('#upload-file').click(function(){
        $(".template-upload").remove();
        var bucket = $("select[name=bucket]").val();
        if (bucket == '') {
            alert('Please select bucket first');
        } else {
            $('.content-upload-file').slideDown();
            var bucket = $("select[name=bucket]").val();
            var  bucket_old = $('#old_bucket_upload').val();
            if (bucket_old == '' || bucket != bucket_old ){
                PrettyS3FilesManager.S3Upload.loadAvailableFolderForUploads('/');
                $('#old_bucket_upload').val(bucket);
            } else {
                $('#upload-file-modal').modal('show');
            }
        }
    });

    $('#save-folders').click(function(){
        PrettyS3FilesManager.Bucket.createFolder();
    });
    $(".select_butket").select2();
    
    $("select[name=bucket]").change(function(){
        //Generate S3 Signature and Policy
        var bucket = $(this).val();
        if (bucket != '') {
            var region = $("input[name=region]").val();
            PrettyS3FilesManager.S3Upload.generateFormS3Signature(".cloud-upload-form", bucket, region);
            PrettyS3FilesManager.Bucket.loadBucketObjects('/');
            //loadFolder('/');
            //loadFrefix("/", 0);
        }
    });

    $("#clear-search").click(function(){
        $('#txt-name').val('');
        if (typeof  $(".name-prefix.active").html() == "undefined" )
             PrettyS3FilesManager.Bucket.loadObjects("/", 0);
        else{
            var frefix = $(".name-prefix.active").html();
            PrettyS3FilesManager.Bucket.loadObjects(frefix + "/", 0);
        }
    });
});