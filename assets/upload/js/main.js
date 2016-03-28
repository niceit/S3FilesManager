/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        forceIframeTransport: true,
        url: $(this).attr('action'),
        done: function (event, data) {
            var destination_path = $(".file-upload-selected-folder").text();
            if (destination_path == '/') {
                destination_path = '';
            } else {
                destination_path = destination_path.substr(1, destination_path.length);
            }
            $('.processing-' + PrettyS3FilesManager.Application.htmlspecialchars(data.files[0].name)).html( "<input class='form-control' type='text' readonly='' value='" + $(this).attr('action') + destination_path + data.files[0].name + "' />");
            var element = $('.action-' + PrettyS3FilesManager.Application.htmlspecialchars(data.files[0].name));
            element.removeClass("td-action");
            var URL = $('base').attr('href') + '/index.php?route=home/basecode';
            $.ajax({
                type: "post",
                url: URL,
                data: {'key': data.files[0].name, 'id' : PrettyS3FilesManager.Application.htmlspecialchars(data.files[0].name)},
                dataType: "json",
                success: function (data) {
                    var element = $('.action-' + data['id']);
                    var link = "'"+ data['key'] + "','"+ data['id'] +"'";
                    element.html('<button onclick="PrettyS3FilesManager.File.delete(' + link +')" class="btn btn-danger delete" ><i class="glyphicon glyphicon-trash"></i> <span>Delete</span> </button> ');
                }
            });

        },
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option'
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }
});
