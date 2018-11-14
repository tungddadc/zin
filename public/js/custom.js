var LOC = {
    loadCity: function loadCity(dataSelected) {
        let city_id = $('select[name="city_id"]');
        if (city_id.length > 0) {
            city_id.select2({
                allowClear: true,
                placeholder: "Chọn tỉnh/thành phố",
                data: dataSelected,
                ajax: {
                    url: base_url + 'cart/ajax_load_city',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

        }
        city_id.change(function () {
            LOC.loadDistrict($(this).val());
        });
    },

    loadDistrict: function loadDistrict(city_id, dataSelected) {
        let district_id = $('select[name="district_id"]');
        if (district_id.length > 0) {
            district_id.select2({
                allowClear: true,

                placeholder: "Chọn quận huyện",
                data: dataSelected,
                ajax: {
                    url: base_url + 'cart/ajax_load_district/' + city_id,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        }

    }

}
var FUNC = {
    formatMoney: function (money) {
        return money.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + 'đ'
    },
    showPopupNewsletter: function (show) {
        if (show) {
            $('#popup_newsletter').show();
            $('#overlay').show();
        } else {
            $('#popup_newsletter').hide();
            $('#overlay').hide();
        }
    },
    ajax_loader: function() {
        $('body').toggleClass('fixed');
        $('#preloader').toggleClass('d-none');
    },
    ajax_load_content_animation: function (url, element, goto) {
        let _container = $(element);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            beforeSend: function () {
                FUNC.ajax_loader();
            },
            success: function (result) {
                let resultFind = $(result).find(element);

                if(resultFind.length > 0){
                    _container.html(resultFind);
                }
                FUNC.ajax_loader();
                window.history.pushState({path: url}, '', url);

                if(goto){
                    $('html, body').animate({
                        scrollTop: $(goto).offset().top
                    }, 1000);
                }

            }
        });
    }
};
var CART = {
    add: function (id,quantity) {
        $.ajax({
            type: 'POST',
            url: base_url + 'cart/add',
            data: {product_id: id,quantity:quantity},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    CART.updateCountHeader();
                    toastr[response.tgype](response.message);
                }
            }
        });
        return false;
    },
    delete: function (_this, id) {
        $.ajax({
            type: 'POST',
            url: base_url + 'cart/ajax_delete_item',
            data: {id: id},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    $(_this).closest('.item').fadeOut('slow', function () {
                        $(this).remove();
                        CART.updateCountHeader();
                        CART.list_cart();
                    });

                    toastr[response.type](response.message);
                }
            }
        });
        return false;
    },
    updateCountHeader: function () {
        $.ajax({
            type: 'GET',
            url: base_url + 'cart/ajax_total',
            dataType: 'json',
            success: function (data) {
                $('.mini-cart .cart_count').html(data.total_item + ' sản phẩm/' + FUNC.formatMoney(data.total_money))
            }
        })
    },
    loadPriceAgency: function (id, quantity) {
        let blockPrice = $('.price-block');
        if (blockPrice.length > 0) {
            $.ajax({
                type: 'POST',
                url: base_url + 'product/ajax_get_detail',
                data: {id: id, quantity: quantity},
                dataType: 'json',
                success: function (data) {
                    if(data.price > 0){
                        blockPrice.find('.price').text(FUNC.formatMoney(data.price));
                        blockPrice.find('input[name="price"]').val(data.price);
                    }
                }
            });
        }
    },
    quantity_reduced: function (_this) {
        let element = $(_this);
        let result = element.closest('.add-to-cart').find('input[name="quantity"]');
        let product_id = element.closest('.add-to-cart').data('id');
        let qty = parseInt(result.val());
        if (!isNaN(qty) && qty > 1) result.val(qty - 1);
        CART.loadPriceAgency(product_id, qty - 1);
        return false;
    },
    quantity_increase: function (_this) {
        let element = $(_this);
        let result = element.closest('.add-to-cart').find('input[name="quantity"]');
        let product_id = element.closest('.add-to-cart').data('id');
        let qty = parseInt(result.val());
        if (!isNaN(qty)) result.val(qty + 1);
        CART.loadPriceAgency(product_id, qty + 1);
        return false;
    },
    changeInputQuantity: function (_this) {
        let element = $(_this);
        let result = element.closest('.add-to-cart').find('input[name="quantity"]');
        let product_id = element.closest('.add-to-cart').data('id');
        let qty = parseInt(result.val());
        CART.loadPriceAgency(product_id, qty + 1);
        return false;
    },
    list_cart: function () {
        $.ajax({
            url: base_url + 'cart/load_list_cart',
            type: 'post',
            dataType: 'HTML',
            success: function (data) {
                $('.k_list_cart').html(data);
                $('.top-cart-content').show();
            }
        });
    },
    hover_cart: function () {

        $('.mini-cart').hover(function () {
            if ($('.top-cart-content').length > 0) {
                $('.top-cart-content').show();
            } else {
                CART.list_cart();
            }

        });
    },
    coupon_code:function () {
        $.ajax({
            url:base_url + 'cart/voucher',
            type:'POST',
            dataType:'json',
            data:{code:$('#coupon_code').val()},
            success:function (data) {
                let cls='text-danger';
                if(data.type=='success') {
                    cls='text-success';
                    $('.price_sale').html(data.price_sale);
                    $('[name="voucher_id"]').val(data.voucher);
                }
                $('.mess_coupon').html('<p class="'+cls+'"> '+data.message+'</p>');
            }
        });
    },
    payment_collapse:function () {
        //payment-collapse
        var pay = $('.payment-collapse');
        if (pay.length > 0) {
            pay.find('.item .head').click(function(e) {
                var ct = $(this).nextAll(".ct");
                if (ct.is(":hidden") === true) {
                    ct.parent('.item').parent().children().children('.ct').slideUp(200);
                    ct.parent('.item').parent().children().children('.head').removeClass("active");
                    $(this).addClass("active");
                    $('.payment-collapse .item').removeClass('active')
                    $(this).parent().addClass("active");

                    ct.slideDown(200);
                } else {
                    ct.slideUp(200);
                    $(this).removeClass("active");
                    $(this).parent().removeClass("active");
                }
            });
        }
    },
    check_out:function () {
        $('.text-danger').remove();
        let form=$('#check_out');
        $.ajax({
            url:base_url+'cart/checkout',
            type:'post',
            dataType:'json',
            data:form.serialize(),
            beforeSend:function () {
                $('.btn-proceed-checkout span').append('<i class="fa fa-spinner fa-spin ml-2" style=" margin-left:5px;color: #ffffff;"></i>');
            },
            success:function (data) {
                $('.btn-proceed-checkout span').find('i').remove();
                if(data.type!='success'){
                    $.each(data.validation,function (key,value) {
                        $('[name="'+key+'"]').closest('.input-box').append(value);
                    });
                    toastr[data.type](data.message);
                }else{
                    window.location.href=data.redirect_url;
                }

            }
        });
    }
};
jQuery(document).ready(function () {
    $('ul>li a[href="' + window.location.origin + window.location.pathname + '"]').parent().addClass('active');

    $('a[href*="#"]').click(function (e) {
        e.preventDefault();
        let tabClick = $(this).attr('href');
        $(this).tab('show');
        setTimeout(function () {
            $('html, body').animate({
                scrollTop: $(tabClick).offset().top - 80
            }, 1000);
        }, 500);
    });

    if (localStorage.getItem('show_popup_subscriber') !== 'hide') {
        FUNC.showPopupNewsletter(true);
    }
    $('input#notshowpopup').change(function () {
        if ($(this).val()) {
            setTimeout(function () {
                localStorage.setItem('show_popup_subscriber', 'hide');
                FUNC.showPopupNewsletter(false);
            }, 1000);
        }
    });
    $('#popup_newsletter').on('click', 'a.x', function () {
        FUNC.showPopupNewsletter(false);
    });

    CART.hover_cart();

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

    /*$('.sticky_box').stick_in_parent();*/

    LOC.loadCity();
    LOC.loadDistrict()

    $(document).on('change','select[name*="filter_"]',function () {
        let form_parent = $(this).closest('form');
        let url = form_parent.attr('action') + '?' + form_parent.serialize();
        FUNC.ajax_load_content_animation(url,'#content_ajax','#content_ajax');
    });


    $(document).on('click','.link-quickview',function (e) {
        e.preventDefault();
        $('body').addClass('fixed');
        $('#fancybox-overlay').show();
        $('#fancybox-wrap').show();
    });

    $('#fancybox-wrap').on('click','#fancybox-close',function (e) {
        e.preventDefault();
        $('#fancybox-overlay').hide();
        $('#fancybox-wrap').hide();
        $('body').removeClass('fixed');
    });

    CART.payment_collapse();
});
var ajaxShowRequest = function (formData, jqForm, options) {
    jqForm.find('[type="submit"]').append('<i class="fa fa-spinner fa-spin ml-2" style="color: #ffffff;"></i>');
    //let queryString = $.param(formData);
    return true;
};
var ajaxShowResponse = function (response, statusText, xhr, $form) {
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
            if (response.type === "success") {
                switch ($form.attr('id')) {
                    case 'product_addtocart_form':
                        CART.updateCountHeader();
                        break;

                    case 'form-order':
                        setTimeout(function () {
                            location.href = base_url;
                        }, 2000);
                        break;

                    default:
                        setTimeout(function () {
                            if (response.url_redirect) location.href = response.url_redirect;
                            else location.reload();
                        }, 2000);
                }
            }
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