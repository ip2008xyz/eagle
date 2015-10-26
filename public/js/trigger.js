var base_url = '';

jQuery.fn.hasAttr = function (name) {
    return this.attr(name) !== undefined;
};

function ajaxLoading(element) {

    /*if (element.parent().find('h3').length > 0) {
     element.parent().find('h3').html("&nbsp;");
     jQuery("#help_ajax").html("&nbsp;");
     }*/


    element.html('loading...');
}

function ajax_get(url_path, element, replace) {

    if (replace != true) {
        replace = false;
    }

    if (element == 'gritter') {

    } else if (element != true) {
        var element = jQuery("#ajax");
        element.modal('show');
        element = jQuery("#innerAjax");
    } else {
        ajaxLoading(element);
        element.show();

    }

    jQuery.ajax({
        type: "GET",
        url: base_url + url_path,
        dataTypeString: 'html',
        success: function (msg) {

            if (element == 'gritter') {
                jQuery.gritter.add({
                    title: null,
                    text: msg,
                    sticky: false,
                    class_name: 'green',
                    time: 2000,
                });
            } else if (element == true) {
                return msg;
            } else if (replace == false) {
                element.html(msg);

            }
            else {
                element.replaceWith(msg);
            }

        }

    });
    return false;

}


function ajaxpost(url_path, data) {
    var element = jQuery("#ajax");
    element.modal('show');
    ajax_post(url_path, data, jQuery("#innerAjax"));
}

function ajax_post(url_path, data, element) {

    if (element == 'gritter') {

    } else if (element != true) {
        var element = jQuery("#ajax");
        element.modal('show');
        element = jQuery("#innerAjax");
    } else {
        ajaxLoading(element);
        element.show();

    }

    jQuery.ajax({
        type: "POST",
        url: base_url + url_path, // + "/ajax/yes",
        data: data,
        dataTypeString: 'html',
        success: function (msg) {
            if (element == 'gritter') {
                jQuery.gritter.add({
                    title: null,
                    text: msg,
                    sticky: false,
                    class_name: 'green',
                    time: 2000,
                });
            } else {
                element.html(msg);
            }
        }

    });
    return false;

}

function nestDiv(element) {

    element.nestable({
        group: 1
    }).on('change', function () {

        if (jQuery(this).hasAttr("data-href")) {
            ajax_post(
                jQuery(this).attr("data-href"),
                'order=' + window.JSON.stringify(jQuery(this).nestable('serialize')));
        }


    });

    element.find('.dd-handle a').on('mousedown', function (e) {
        e.stopPropagation();
    });
    element.addClass('isnested');
}

