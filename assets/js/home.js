jQuery(function(){
    loadFolder('/');
});


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
        }

    });
}

