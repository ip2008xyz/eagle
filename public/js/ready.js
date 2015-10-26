jQuery(document).ready(function () {

    //simple ajax call
    jQuery('body').on('click', '.ajaxCall', function (e) {

        var element_link = "";

        if (jQuery(this).hasAttr("data-href")) {
            element_link = jQuery(this).attr("data-href");
        } else {
            element_link = jQuery(this).attr("href");
        }

        //this is not a href so the element default action should continue
        if (jQuery(this).hasAttr("data-element")) {
            if (jQuery(this).attr("data-element") == 'gritter') {
                ajax_get(element_link, 'gritter', false);
            } else {
                ajax_get(element_link, jQuery(jQuery(this).attr("data-element")));
            }

        } else {
            e.preventDefault();
            ajax_get(element_link);
        }

        //return false;

    });

    //form submit with ajax
    jQuery('body').on('submit', '.ajaxSubmit', function () {

        if (jQuery(this).hasAttr('data-element')) {
            ajax_post(jQuery(this).attr("action"), jQuery(this).serialize(), jQuery(jQuery(this).attr('data-element')));

        } else {

            ajaxpost(jQuery(this).attr("action"), jQuery(this).serialize());
        }

        return false;
    });

    //form submit with ajax
    jQuery('body').on('submit', '.ajaxSubmit', function () {

        if (jQuery(this).hasAttr('data-element')) {
            ajax_post(jQuery(this).attr("action"), jQuery(this).serialize(), jQuery(jQuery(this).attr('data-element')));

        } else {

            ajaxpost(jQuery(this).attr("action"), jQuery(this).serialize());
        }

        return false;
    });


    nestDiv(jQuery('.nested'));

    jQuery('body').on('mouseenter', '.nested:not(.isnested)', function () {
        nestDiv(jQuery(this));
        return false;
    });



});