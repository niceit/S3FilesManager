var s3_credential_installed = false;
var configuration_set = false;
$('#wizard').smartWizard({
    onLeaveStep: function (obj, context) {
        if (context.fromStep > context.toStep) {
            $(".left-installation-steps").removeClass('active');
            $(".step" + context.toStep).addClass('active');
            return true;
        }
        switch (context.fromStep) {
            case 1:
                if ($("input[name=license_checkbox]").is(":checked")) {
                    $(".left-installation-steps").removeClass('active');
                    $(".step" + context.toStep).addClass('active');
                    handle_target_step(context.toStep);
                    return true;
                }
                else {
                    new PNotify({
                        title: 'Oop!',
                        text: 'You must accept the License Agreement.',
                        type: 'error'
                    });
                    return false;
                }
                break;
            case 3:
                if (configuration_set) {
                    return true;
                }
                if (!s3_credential_installed) {
                    new PNotify({
                        title: 'Oop!',
                        text: 'Please complete S3 configuration stuffs',
                        type: 'error'
                    });
                    return false;
                }

                var bucket = $("select[name='setting[bucket]']").val();
                var username = $("input[name='setting[username]']").val();
                var password = $("input[name='setting[password]").val();
                var re_password = $("input[name='setting[re_password]").val();

                if (bucket == '') {
                    new PNotify({
                        title: 'Oop!',
                        text: 'Please choose default bucket',
                        type: 'error'
                    });
                    return false;
                }

                if (username == '') {
                    new PNotify({
                        title: 'Oop!',
                        text: 'Please fill username',
                        type: 'error'
                    });
                    return false;
                }

                if (password == '') {
                    new PNotify({
                        title: 'Oop!',
                        text: 'Please choose password',
                        type: 'error'
                    });
                    return false;
                }

                if (password != re_password) {
                    new PNotify({
                        title: 'Oop!',
                        text: 'Your password confirmation is not matched',
                        type: 'error'
                    });
                    return false;
                }

                var data = $("form[name=setting_form]").serialize();
                var url = $("input[name=site_url]").val() + '/index.php?route=home/installation';
                data += "&action=save_settings";
                PrettyS3FilesManager.Application.putLoadingState(".setting-form");
                $.post(url, data, function (data) {
                    PrettyS3FilesManager.Application.removeLoadingState(".setting-form");
                    if (data.status) {
                        $("#login-username").html($("input[name='setting[username]']").val());
                        $("#login-password").html($("input[name='setting[password]").val());
                        configuration_set = true;
                        $(".left-installation-steps").removeClass('active');
                        $(".step" + 4).addClass('active');
                        $('#wizard').smartWizard('goToStep', 4);
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(data.message);
                    }
                });
                return false;
                break;
        }

        $(".left-installation-steps").removeClass('active');
        $(".step" + context.toStep).addClass('active');
        handle_target_step(context.toStep);
        return true;
    },
    onFinish: function (objs, context) {
        var url = $("input[name=site_url]").val();
        document.location.href = url;
    },
});
function handle_target_step(step_num) {
    //Handle at target steps
    switch (step_num) {
        case 2:
            $(".requirement-checking-content").html('<i>Checking all requirements...</i>');
            $("#wizard").find(".actionBar a").attr("disabled", "disabled");
            var url = $("input[name=site_url]").val() + '/index.php?route=home/installation';
            $.post(url, {action:'requirements'}, function(data) {
                $(".requirement-checking-content").html(data.html);
                if (!data.status) {
                    $(".requirement-checking-content").prepend('<div class="alert alert-danger"><i class="fa fa-remove"> </i> Something wrong! please re-checking red highlight requirements</div>');
                }
                else {
                    $("#wizard").find(".actionBar a").removeAttr("disabled");
                }
            });
            break;
    }
}

$(function () {
   $("#btn-connect-cloud").click(function () {
       var app_key = $("input[name='setting[app_id]']").val();
       var app_secret = $("input[name='setting[app_secret]']").val();
       if (app_key == '' || app_secret == '') {
           new PNotify({
               title: 'Oop!',
               text: 'Please fill App Key and Secret',
               type: 'error'
           });
           s3_credential_installed = false;
       }
       else {
           var region = $("select[name='setting[region]']").val();
           if (region == '') {
               new PNotify({
                   title: 'Success',
                   text: 'Please choose your region',
                   type: 'error'
               });
               s3_credential_installed = false;
           }
           else {
               var data = {action:'connect_cloud', key: app_key, secret: app_secret, region: region};
               var url = $("input[name=site_url]").val() + '/index.php?route=home/installation';
               PrettyS3FilesManager.Application.putLoadingState(".setting-form");
               $.post(url, data,  function (data) {
                    if (data.status) {
                        $("select[name='setting[bucket]']").html(data.html);
                        new PNotify({
                            title: 'Success',
                            text: 'Connected to Amazon S3 Credential',
                            type: 'success'
                        });
                        s3_credential_installed = true;
                    }
                    else {
                        PrettyS3FilesManager.Application.errorPopup(data.message);
                        s3_credential_installed = false;
                    }
                    PrettyS3FilesManager.Application.removeLoadingState(".setting-form");
               });
           }
       }
   });
});