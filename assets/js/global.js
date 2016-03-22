Application = function() {

    this.webRoot = '/';

    //Display message with timeout
    this.displayElementMessageWithDelay = function (element, type, message, timeout) {
        $(element).find('.message')
            .addClass('nNote')
            .addClass(type)
            .find('p').html(message);

        $(element).find('.message').fadeIn(1500);

        setTimeout(function(){
            Application.hideElementMessage(element, type);
        }, timeout);
    }

    //Display element message
    this.displayElementMessage = function (element, type, message) {
        $(element).find('.message')
            .addClass('nNote')
            .addClass(type)
            .find('p').html(message);

        $(element).find('.message').fadeIn(1500);
    }

    //Hide element message
    this.hideElementMessage = function (element, type) {
        $(element).find('.message')
            .removeClass("nNote")
            .removeClass(type).fadeOut(1500);
    }

    //Display loading field
    this.displayLoadingField = function (element) {
        $(element).find('.loading-field').show();
    }

    //Hide loading field
    this.hideLoadingField = function (element) {
        $(element).find('.loading-field').hide();
    }

    /*For form upload stuffs and elements*/
    this.generateFormS3Signature = function (element, bucket, region) {
        $.post('/index.php?route=home/generateS3Signature', {bucket:bucket}, function(response){
            if (response['status']) {
                $(element).each(function(){
                    $(this).attr('action', 'https://' + bucket + '.s3-' + region + '.amazonaws.com/')
                    $(this).find('input[name=AWSAccessKeyId]').val(response['accessKey']);
                    $(this).find('input[name=policy]').val(response['policy']);
                    $(this).find('input[name=signature]').val(response['signature']);
                });
            }
        });
    }

    /*
    * Display error popup detail from server
    * */
    this.errorPopup = function(message) {
        var jPopupElement = $("#error-popup");
        jPopupElement.find("#content-detail").find(".alert-error").html(message);
        jPopupElement.modal('show');
    }

    /*
    * Put area disabled for loading state
    * */
    this.putLoadingState = function (areaElement) {
        $(areaElement).attr("style", "position: relative;");
        $(areaElement).append('<span class="loading"></span>');
    };

    /*
    * Remove area loading state
    * */
    this.removeLoadingState = function (areaElement) {
        $(areaElement).removeAttr("style");
        $(areaElement).find(".loading").remove();
    }

    //Remove item from array
    this.removeObjectItemByValue = function(array, item) {
        for(var i in array){
            if(array[i]==item){
                array.splice(i,1);
                break;
            }
        }
    }
    this.removeObjectItemByKey = function(array, index) {
        array.splice(index,1);
    }
}

var Application = new Application();
