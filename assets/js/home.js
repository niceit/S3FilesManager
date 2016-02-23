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
}

function loadSubFolder(frefix, id) {
    $('#contentFolder').prepend('<span class="loading"></span>');
    var URL = $('base').attr('href') + '/index.php?route=home/ajaxloadfolder';
    $.ajax({
        type: "post",
        url: URL,
        data: {'frefix': frefix},
        dataType: "html",
        success: function (data) {
            $('.contentFolder .loading').remove();
            var sub = $('.sub-' + id + ' .sub');
            $(sub).html(data);
            //$(sub).fadeIn(500);
            clickFonder();
        }

    });
}

function loadFrefix(frefix, page) {
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
           // $('.all-file').hide();
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

function createnewfolder(prefix){
    $('#prefix-parent').val(prefix);
    $('.show-prefix-parent').html(prefix);
    $( "#name-folder").val('');
    $('#create-folder').modal('show');
}
$(function(){
    $( "#name-folder" ).keypress(function() {
       var prefix = $('#prefix-parent').val();
        $('.show-prefix-parent').html(prefix + $(this).val());
    });

    $('#save-folder').click(function(){
        var folder = $( "#name-folder").val();
        var folder = $( "#name-folder").val();
        $('#create-folder').modal('hide');
    });
});

