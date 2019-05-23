

var flagSearch = true;
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
        district_id.change(function () {
            CART.fee_ship();
        })
    }

}
var FUNC = {
    ajaxShowRequest: function (formData, jqForm, options) {
        if(jqForm.find('[type="submit"]').length > 0) jqForm.find('[type="submit"]').append(' <i class="fa fa-spinner fa-spin ml-2" style="color: #ffffff;"></i>');
        //let queryString = $.param(formData);
        return true;
    },
    ajaxShowResponse: function (response, statusText, xhr, $form) {
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
    },
    formatMoney: function (money) {
        return money.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + 'đ'
    },
    showPopupNewsletter: function (show) {
        if($('#popup_newsletter').length > 0){
            if (show) {
                $('#popup_newsletter').show();
                $('#overlay').show();
            } else {
                $('#popup_newsletter').hide();
                $('#overlay').hide();
            }
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
                    _container.html(resultFind.html());
                }
                FUNC.ajax_loader();
                window.history.pushState({path: url}, '', url);

                if(goto){
                    $('html, body').animate({
                        scrollTop: $(goto).offset().top - 110
                    }, 1000);
                }

            }
        });
    },
    show_quick_view: function (url_product_detail) {
        let content_view = '#ajax-quickview';
        let container_popup = $('#fancybox-content  .product-essential');
        $.ajax({
            url: url_product_detail,
            type: 'GET',
            dataType: 'html',
            success: function (result) {
                let resultFind = $(result).find(content_view);
                if(resultFind.length > 0){
                    container_popup.html(resultFind);
                    UI.zoomImageProduct();
                    UI.ajaxFormSubmit();
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
                    CART.list_cart();
                    toastr[response.type](response.message);
                }
            }
        });
        return false;
    },
    add_more: function (id,_this) {
        let quantity = $(_this).closest('.custom').find('input[name="quantity"]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'cart/add',
            data: {product_id: id,quantity:quantity},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    CART.updateCountHeader();
                    toastr[response.type](response.message);
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
                $('.cart_count').html(data.total_item )
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
                        blockPrice.find('.special-price .price').text(FUNC.formatMoney(data.price));
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
        if(mobileDetect == true){
            $('.cart-icon a').click(function (e) {
                e.preventDefault();
                if ($('.top-cart-content').length > 0) {
                    $('.top-cart-content').show();
                } else {
                    CART.list_cart();
                }

            });
        }else{
            $('.cart-icon').hover(function () {
                if ($('.top-cart-content').length > 0) {
                    $('.top-cart-content').show();
                } else {
                    CART.list_cart();
                }

            });
        }
    },
    hide_cart: function (_this) {
        $('.k_list_cart').empty();
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
    fee_ship: function(){
        if($('#shipping-zip-form').length > 0){
            let city_id = $('[name="city_id"]').val();
            let district_id = $('[name="district_id"]').val();
            let total_weight = $('[name="total_weight"]').val();
            let warehouse = $('[name="warehouse"]').val();
            let total_money = $('.fee_ship').data('total');
            $.ajax({
                url:base_url+'cart/ajax_get_fee',
                type:'POST',
                data: {warehouse:warehouse,weight:total_weight,city_id:city_id,district_id:district_id,total:total_money},
                dataType:'json',
                success:function (data) {
                    if(data.success == true){
                        let fee = data.fee.fee;
                        $('.fee_ship').text(FUNC.formatMoney(fee));
                        $('.price_sale').text(FUNC.formatMoney(total_money + fee));
                    }
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
var WISHLIST = {
    add: function () {
        $(document).on('click','.link-wishlist',function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            $.ajax({
                type:'POST',
                url: base_url + 'product/ajax_save_wishlist',
                data: {product_id:product_id},
                dataType: 'JSON',
                success: function (response) {
                    if (typeof response.type !== 'undefined') {
                        toastr[response.type](response.message);
                    }
                }
            });
        });
    },
    delete: function (_this) {
        let elementItem = $(_this).closest('tr');
        let product_id = elementItem.data('id');
        $.ajax({
            type:'POST',
            url: base_url + 'product/ajax_delete_wishlist',
            data: {product_id:product_id},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if(response.type === 'success') elementItem.remove();
                }
            }
        });
        return false;
    },
    deleteAll: function () {
        $.ajax({
            type:'POST',
            url: base_url + 'product/ajax_deleteAll_wishlist',
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if(response.type === 'success') $('#wishlist-table tbody').remove();
                }
            }
        });
        return false;
    },
    init: function () {
        WISHLIST.add();
    }
};
var COMPARE = {
    add: function () {
        $(document).on('click','.link-compare',function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            $.ajax({
                type:'POST',
                url: base_url + 'product/ajax_add_compare',
                data: {product_id:product_id},
                dataType: 'JSON',
                success: function (response) {
                    if (typeof response.type !== 'undefined') {
                        toastr[response.type](response.message);
                    }
                }
            });
        });
    },
    delete: function (_this) {
        let elementItem = $(_this).closest('tr');
        let product_id = elementItem.data('id');
        $.ajax({
            type:'POST',
            url: base_url + 'product/ajax_delete_compare',
            data: {product_id:product_id},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if(response.type === 'success') elementItem.remove();
                }
            }
        });
        return false;
    },
    deleteAll: function () {
        $.ajax({
            type:'POST',
            url: base_url + 'product/ajax_deleteAll_compare',
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if(response.type === 'success') $('#wishlist-table tbody').remove();
                }
            }
        });
        return false;
    },
    init: function () {
        COMPARE.add();
    }
};
var UI = {
    activeMenu: function(){
        let href = window.location.origin + window.location.pathname;
        $('ul>li a[href="' + href + '"]').parent().addClass('active');
        if(urlCurrentMenu) $('ul>li a[href="' + urlCurrentMenu + '"]').parent().addClass('active');
    },
    search: function(el){
        let keyword = el.val();
        if (keyword.length > 0) {
            window.location.href = base_url+'search/'+keyword;
        }else{
            toastr['warning']('Vui lòng nhập từ khóa để tìm kiếm !');
        }
    },
    loadSearchAutocomplete: function(page){
        let formEl = $('#search_mini_form');
        let keyword = formEl.find('input[name="search"]').val();
        if(keyword){
            $.ajax({
                type:'POST',
                url: base_url + 'search_autocomplete',
                data: {keyword:keyword,page:page},
                dataType: 'HTML',
                success: function (content) {
                    if(content){
                        formEl.find('.product_search').append(content);
                    }
                }
            });
            return false;
        }
    },
    searchBox: function(){
        let container  = $('#search_mini_form');
        $('header').find('button.btnSearch').click(function(e) {
            e.preventDefault();
            let inputElement = $(this).parent().parent().find('input[name="search"]');
            UI.search(inputElement);
        });

        container.find('input[name="search"]').keydown(function (e) {
            if (e.keyCode === 13) {
                let inputElement = $(this);
                UI.search(inputElement);
            }
        });

        container.find('input[name="search"]').keyup(function () {
            container.find('.product_search').html('').addClass('go_in');
            UI.loadSearchAutocomplete(1);
        });

        container.find('input[name="search"]').focusin(function() {
            container.find('.product_search').addClass('go_in').fadeIn(500);
        });

        container.find('input[name="search"]').focusout(function() {
            container.find('.product_search').removeClass('go_in').fadeOut(500);
        });

        let page = 1;
        container.find('.product_search').scroll(function () {
            let divHeight = $(this).innerHeight();
            let scrollPosition = $(this).scrollTop();
            let scrollHeight = this.scrollHeight;
            if (scrollPosition +  divHeight  >=  scrollHeight) {
                page+=1;
                console.log(page);
                UI.loadSearchAutocomplete(page);
            }
        });


    },
    ajaxFormSubmit: function(){
        $('form[method="post"]').ajaxForm({
            beforeSubmit: FUNC.ajaxShowRequest,
            success: FUNC.ajaxShowResponse,
            type: 'POST',
            dataType: 'JSON',
            /*clearForm: true,*/
            /*resetForm: true,*/
            /*$.ajax options can be used here too, for example:*/
            timeout:   500
        });
    },
    zoomImageProduct: function () {
        /* Zoom image */
        if (jQuery('#product-zoom').length > 0) {
            jQuery('#product-zoom').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750,
                gallery: 'gallery_01'
            });
        }
        if (jQuery('#gallery_01').length > 0) {
            jQuery("#gallery_01 .slider-items").owlCarousel({
                autoplay: false,
                items: 4, //10 items above 1000px browser width
                itemsDesktop: [1024, 3], //5 items between 1024px and 901px
                itemsDesktopSmall: [900, 2], // 3 items betweem 900px and 601px
                itemsTablet: [600, 3], //2 items between 600 and 0;
                itemsMobile: [320, 2],
                navigation: true,
                navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
                slideSpeed: 500,
                pagination: false
            });
        }
    },
    stickyMenuMain: function(){
        let header = document.getElementById('menu-main');
        let sticky = header.offsetTop;
        jQuery('.mega-menu-category').slideUp();
        window.onscroll = function() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
                /*jQuery('.mega-menu-category').slideUp();*/
            } else {
                header.classList.remove("sticky");
            }
            if(window.pageYOffset == 0){
                /*jQuery('.mega-menu-category').slideDown();*/
            }
        };
    },
    stickyBox: function(){
        if($('.sticky_box').length > 0){
            $('.sticky_box').stick_in_parent();
        }
    },
    socialShare: function(){
        if($('#social-share').length > 0){
            $('#social-share').jsSocials({
                shares: ["email", "twitter", "facebook", "googleplus", "pinterest"]
            });
        }
    },
    voteStar: function(){
        if($('.rateit').length > 0){
            $('.rateit').bind('rated', function (e) {
                e.preventDefault();
                let ri = $(this);
                let value = ri.rateit('value');
                ri.closest('form').find('[name="vote"]').val(value);
            });
        }
    },
    loadComment: function (page) {
        let container = $('#comments');
        if(container.length > 0){
            let product_id = container.data('id');
            container.find('.cmt-list').html('<div class="text-center"><i class="fa fa-spinner fa-spin ml-2" style=" margin-left:5px;color: #be1e2d;"></i></div>');
            setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'product/ajax_load_comment',
                    data: {product_id: product_id,page:page},
                    success: function (html) {
                        container.find('.cmt-list').html(html);
                    }

                })
            },1000);
        }
        return false;
    },
    show_random_realtime: function(){
        if(typeof is_realtime_visitor !== "undefined" && is_realtime_visitor == true){
            setInterval(function () {
                let number_random = Math.floor((Math.random() * 10) + (Math.random() * 3));
                console.log(number_random);
                toastr.options.positionClass = "toast-bottom-left";
                toastr.info('Có '+ number_random + ' người đang xem sản phẩm này !','',{timeOut: 10000});
            },15000);
        }
    },
    init: function () {
        // UI.stickyMenuMain();
        UI.activeMenu();
        UI.searchBox();
        UI.stickyBox();
        UI.socialShare();
        UI.voteStar();
        UI.ajaxFormSubmit();
        UI.zoomImageProduct();
        UI.loadComment(1);
        UI.show_random_realtime();
    }
};
jQuery(document).ready(function () {
    UI.init();
    WISHLIST.init();
    COMPARE.init();
    if(window.location.hash === '#reviews_tabs'){
        let tabClick = window.location.hash;
        $('[href="'+tabClick+'"]').tab('show');
        setTimeout(function () {
            $('html, body').animate({
                scrollTop: $(tabClick).offset().top - 120
            }, 1000);
        }, 500);
    }
    $('a[href*="#"]').click(function (e) {
        e.preventDefault();
        let href = $(this).attr('href').split('#');
        let tabClick = '#' + href[href.length-1];
        $(this).tab('show');
        $('[href="#'+ href[href.length-1] +'"]').parent().addClass('active');
        setTimeout(function () {
            $('html, body').animate({
                scrollTop: $(tabClick).offset().top - 120
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

    LOC.loadCity();
    LOC.loadDistrict();

    $(document).on('change','select[name*="filter_"]',function () {
        let form_parent = $(this).closest('form');
        let url = form_parent.attr('action') + '?' + form_parent.serialize();
        FUNC.ajax_load_content_animation(url,'#content_ajax','#content_ajax');
    });

    $(document).on('change','select[name="warehouse"]',function () {
        CART.fee_ship();
    });

    $(document).on('click','ul.pagination li a',function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        FUNC.ajax_load_content_animation(url,'#content_ajax','#content_ajax');
    });
    $(document).on('click','.link-quickview',function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        FUNC.show_quick_view(url);
        $('body').addClass('fixed');
        $('#overlay').show();
        $('#fancybox-wrap').show();
    });
    $('#fancybox-wrap').on('click','#fancybox-close',function (e) {
        e.preventDefault();
        $('#overlay').hide();
        $('#fancybox-wrap').hide();
        $('.zoomContainer').hide();
        $('body').removeClass('fixed');
    });

    CART.payment_collapse();

    if($('.showmore').closest('.panel-body').find('.add-to-box').length <= 1){
        $('.showmore').addClass('hidden');
    }

    $('.buy-more').on('click','.showmore a',function(e) {
        e.preventDefault();
        let _this = $(this);
        _this.parent().css({
            height: 0
        });
        _this.closest('.panel-body').css({
            'max-height': '2000px'
        });
    });

    $('.comment-fr').on('click', '.reply-btn', function(e) {
        e.preventDefault();
        $(this).closest('.comment-fr');
        let container = $(this).closest('.comment-fr');
        container.find('.hc-comment form.form-comment').remove();
        let form = container.find('form.form-comment');
        let cmtID = $(this).attr('data-id'), name = $(this).closest('.hc-comment').children('.head').find('.name').text();
        let clone = form.clone();
        clone.find('textarea').val("@"+name+': ');
        clone.append('<input type="hidden" name="parent_id" id="comment-id" value="'+cmtID+'">');
        $(this).parent().after(clone);
        clone.find('textarea').focus();
        container.ajaxForm({
            beforeSubmit: FUNC.ajaxShowRequest,
            success: FUNC.ajaxShowResponse,
            type: 'POST',
            dataType: 'JSON',
            /*clearForm: true,*/
            /*resetForm: true,*/
            /*$.ajax options can be used here too, for example:*/
            timeout:   500
        });
    });

    $('.view-more').on('click','a', function(e) {
        e.preventDefault();
        let _this = $(this);
        _this.parent().css({
            height: 0
        });
        _this.closest('ul').css({
            'max-height': '4000px'
        }).stop(true,true).fadeIn('slow');
    });

    $('.accessories-slider').owlCarousel({
        items:2,
        loop:true,
        responsiveClass:true,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:2,
            }
        }
    })
    getAgencyNear();
    filterAgency();
    $('#spanImg').on('click',function () {
        $('.ask_form input[type="file"]').trigger('click');
    });

    if ( $('.top-agency__abs').length > 0) {
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: '.',
            decimal: ',',
            prefix: '',
            suffix: ''
        };
        var total_agency = new CountUp("total_agency", 0, parseInt($('#total_agency').data('val')), 0,5, options);
        var serve_customer = new CountUp("serve_customer", 0, parseInt($('#serve_customer').data('val')), 0,5, options);
        // $(window).scroll(function () {
            var hT = $('.top-banners').offset().top,
              hH = $('.top-banners').outerHeight(),
              wH = $(window).height(),
              wS = $(this).scrollTop();
            if (wS > (hT + hH - wH)) {
                setTimeout(total_agency.start(), 1000);
                setTimeout(serve_customer.start(), 1000);
            }
        // });
    }
});

function getAgencyNear() {
    $('.list-agency__title a').on('click',function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
        } else {

            alert('Geolocation is not supported by this browser.');
        }
    });

    if(typeof ddgannhat!="undefined" && ddgannhat=='1'){
        $('html, body').animate({
            scrollTop: $('.form_filter').offset().top
        }, 1000, function() {
            // Callback after animation
            // Callback after animation
            $('.list-agency__title a').trigger('click');
        });
    }
}
function showLocation(position) {

    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.ajax({
        type:'POST',
        url: base_url +  'agency/agencyNear',
        data:{lat:latitude,log:longitude},
        success:function(data){
            if(data){
                $(".list-agency__content").html(data);
            }else{
                $(".list-agency__content").html('Not Available');
            }
        }
    });
}
function filterAgency() {
    $('.form_filter [name="city_id"],.form_filter [name="district_id"]').on('change',function () {
        let params={
            city_id:$('[name="city_id"]').val(),
            district_id:$('[name="district_id"]').val(),
        };
        $.ajax({
            type:'POST',
            url: base_url +  'agency/listAgency',
            data:params,
            success:function(data){
                if(data){
                    $(".list-agency__content").html(data);
                }else{
                    $(".list-agency__content").html('Không có cửa hàng, đại lý nào phù hợp');
                }
            }
        });
    });
}
function live_search(key_search) {
    if (key_search.length > 3) {
        if (flagSearch) {
            flagSearch = false;
            $.ajax({
                async: true,
                cache: false,
                type: 'POST',
                url: base_url +  'agency/filterAgency',
                dataType: 'html',
                data: {key_search: key_search},
                success: function (data) {
                    $('.result').html(data);
                    $('.result').addClass('gogo');
                    flagSearch = true;
                }
            });
        }
    }else{
        $('.result').removeClass('gogo');
    }

    $(window).click(function (e) {
        if ($('.result').has(e.target).length == 0 && !$('.result').is(e.target)) {
            $('.result').removeClass('gogo');
        }
    });
}

CART.hover_cart();

$(document).ready(function() {

    var sync1 = $("#sync1");
    var sync2 = $("#sync2");

    sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    });

    sync2.owlCarousel({
        items : 4,
        itemsDesktop      : [1199,4],
        itemsDesktopSmall     : [979,4],
        itemsTablet       : [768,3],
        itemsMobile       : [479,2],
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
            el.find(".owl-item").eq(0).addClass("synced");
        }
    });

    function syncPosition(el){
        var current = this.currentItem;
        $("#sync2")
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced")
        if($("#sync2").data("owlCarousel") !== undefined){
            center(current)
        }
    }

    $("#sync2").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
    });

    function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for(var i in sync2visible){
            if(num === sync2visible[i]){
                var found = true;
            }
        }

        if(found===false){
            if(num>sync2visible[sync2visible.length-1]){
                sync2.trigger("owl.goTo", num - sync2visible.length+2)
            }else{
                if(num - 1 === -1){
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if(num === sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
            sync2.trigger("owl.goTo", num-1)
        }

    }

});
