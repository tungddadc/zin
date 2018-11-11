jQuery(document).ready(function () {

    $('a[href*="#"]').click(function (e) {
        e.preventDefault();
        let tabClick = $(this).attr('href');
        $(this).tab('show');
        setTimeout(function () {
            $('html, body').animate({
                scrollTop: $(tabClick).offset().top - 80
            }, 1000);
        },500);
    });

    if (localStorage.getItem('show_popup_subscriber') !== 'hide') {
        $('#popup_newsletter').show();
        $('#overlay').show();
    }
    $('input#notshowpopup').change(function () {
        if ($(this).val()) {
            setTimeout(function () {
                localStorage.setItem('show_popup_subscriber', 'hide');
                $('#popup_newsletter').hide();
                $('#overlay').hide();
            },1000);
        }
    });

    jQuery('#rev_slider_4').show().revolution({
        dottedOverlay: 'none',
        delay: 5000,
        startwidth: 850,
        startheight: 428,
        hideThumbs: 200,
        thumbWidth: 200,
        thumbHeight: 50,
        thumbAmount: 2,
        navigationType: 'thumb',
        navigationArrows: 'solo',
        navigationStyle: 'round',
        touchenabled: 'on',
        onHoverStop: 'on',
        swipe_velocity: 0.7,
        swipe_min_touches: 1,
        swipe_max_touches: 1,
        drag_block_vertical: false,
        spinner: 'spinner0',
        keyboardNavigation: 'off',
        navigationHAlign: 'center',
        navigationVAlign: 'bottom',
        navigationHOffset: 0,
        navigationVOffset: 20,
        soloArrowLeftHalign: 'left',
        soloArrowLeftValign: 'center',
        soloArrowLeftHOffset: 20,
        soloArrowLeftVOffset: 0,
        soloArrowRightHalign: 'right',
        soloArrowRightValign: 'center',
        soloArrowRightHOffset: 20,
        soloArrowRightVOffset: 0,
        shadow: 0,
        fullWidth: 'on',
        fullScreen: 'off',
        stopLoop: 'off',
        stopAfterLoops: -1,
        stopAtSlide: -1,
        shuffle: 'off',
        autoHeight: 'off',
        forceFullWidth: 'on',
        fullScreenAlignForce: 'off',
        minFullScreenHeight: 0,
        hideNavDelayOnMobile: 1500,
        hideThumbsOnMobile: 'off',
        hideBulletsOnMobile: 'off',
        hideArrowsOnMobile: 'off',
        hideThumbsUnderResolution: 0,
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        startWithSlide: 0,
        fullScreenOffsetContainer: ''
    });

    $('#social-share').jsSocials({
        shares: ["email", "twitter", "facebook", "googleplus", "pinterest"]
    });

    $('.rateit').bind('rated', function (e) {
        e.preventDefault();
        let ri = $(this);
        let value = ri.rateit('value');
        ri.closest('form').find('[name="vote"]').val(value);
    });
});
var ajaxShowRequest = function (formData, jqForm, options) {
    jqForm.find('[type="submit"]').append('<i class="fa fa-spinner fa-spin ml-2" style="color: #ffffff;"></i>');
    //let queryString = $.param(formData);
    return true;
};
var
    ajaxShowResponse = function (response, statusText, xhr, $form) {
        if (response.csrf_form) {
            $form.find('input[name="' + response.csrf_form.csrf_name + '"]').val(response.csrf_form.csrf_value);
            $('meta[name="csrf_form_token"]').attr('content', response.csrf_form.csrf_value);
        }
        $form.find('.fa-spin').remove();
        if (typeof response.type !== 'undefined') {
            toastr[response.type](response.message);
            if (response.type === "warning") {
                $form.find('.form-group').removeClass('has-warning');
                $form.find('.text-danger').remove();
                $.each(response.validation, function (key, val) {
                    $form.find('[name="' + key + '"]').after(val).parent().addClass('has-warning');
                });
            } else {
                $form.find('.form-group').removeClass('has-warning');
                $form.find('.text-danger').remove();
                //$form.reset();
                setTimeout(function () {
                    if (response.url_redirect) location.href = response.url_redirect;
                }, 2000);
            }
        }
    };

var ajaxFormSubmit = function () {
    $('form[method="post"]').ajaxForm({
        //target:        '#output1',   // target element(s) to be updated with server response
        beforeSubmit: ajaxShowRequest,  // pre-submit callback
        success: ajaxShowResponse,  // post-submit callback
        type: 'POST',        // 'get' or 'post', override for form's 'method' attribute
        dataType: 'JSON'        // 'xml', 'script', or 'json' (expected server response type)
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit
        // $.ajax options can be used here too, for example:
        //timeout:   3000
    });
};
var dthen1 = new Date("12/25/17 11:59:00 PM");
start = "08/04/15 03:02:11 AM";
start_date = Date.parse(start);
var dnow1 = new Date(start_date);
if (CountStepper > 0)
    ddiff = new Date((dnow1) - (dthen1));
else
    ddiff = new Date((dthen1) - (dnow1));
gsecs1 = Math.floor(ddiff.valueOf() / 1000);

var iid1 = "countbox_1";
CountBack_slider(gsecs1, "countbox_1", 1);