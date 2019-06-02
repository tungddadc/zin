/**************************************************************************
 * Common js

 **************************************************************************/
jQuery(document).ready(function() {
    /* Mega Menu */
    jQuery('.mega-menu-title').on('click',function(){
        if(jQuery('.mega-menu-category').is(':visible')){
            jQuery('.mega-menu-category').slideUp();
        } else {
            jQuery('.mega-menu-category').slideDown();
        }
    });


    jQuery('.mega-menu-category .nav > li').hover(function(){
        jQuery(this).addClass('active');
        jQuery(this).find('.popup').stop(true,true).fadeIn('slow');
    },function(){
        jQuery(this).removeClass('active');
        jQuery(this).find('.popup').stop(true,true).fadeOut('slow');
    });


    jQuery('.mega-menu-category .nav > li.view-more-cat').on('click',function(e){
        if(jQuery('.mega-menu-category .nav > li.more-menu').is(':visible')){
            jQuery('.mega-menu-category .nav > li.more-menu').stop().slideUp();
            jQuery(this).find('a').text('More');
        } else {
            jQuery('.mega-menu-category .nav > li.more-menu').stop().slideDown();
            jQuery(this).find('a').text('Close menu');
            jQuery(this).find('a').addClass('menu-hide');

        }
        e.preventDefault();
    });


    /* Bestsell slider */
    jQuery('#bestsell-slider .slider-items').owlCarousel({
        items: 3,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [768, 3],
        itemsTablet: [767, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    /* Featured slider */
    jQuery('#featured-slider .slider-items').owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [768, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    /* New arrivals slider */
    jQuery('#new-arrivals-slider .slider-items').owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [768, 3],
        itemsTablet: [767, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    /* Brand logo slider */
    jQuery('#brand-logo-slider .slider-items').owlCarousel({
        autoPlay: true,
        items: 6,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [320, 1],
        navigation: true,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    /* Category desc slider */
    jQuery('#category-desc-slider').owlCarousel({
        autoPlay: true,
        items: 1,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        slideSpeed: 500,
        pagination: true
    });

    /* List cat slider */
    jQuery('#list-cat').owlCarousel({
        autoPlay: true,
        items: 10,
        itemsDesktop: [1024, 10],
        itemsDesktopSmall: [768, 5],
        itemsTablet: [570, 3],
        itemsMobile: [320, 3],
        navigation: true,
        margin: 20,
        navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        slideSpeed: 500,
        pagination: false
    });
    /* Related products slider */
    jQuery('#related-products-slider .slider-items').owlCarousel({
        items: 3,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [320, 1],
        navigation: true,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    /* Upsell products slider */
    jQuery('#upsell-products-slider .slider-items').owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    /* testimonials slider */
    jQuery('#testimonials-slider .slider-items').owlCarousel({
        autoPlay: true,
        items: 1,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [900, 1],
        itemsTablet: [640, 1],
        itemsMobile: [390, 1],
        navigation: false,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed: 500,
        pagination: false

    });


    jQuery('#bestsellers4 .slider-items').owlCarousel({
        items : 1,
        itemsDesktop : [1024,1],
        itemsDesktopSmall : [900,1],
        itemsTablet: [767,1],
        itemsMobile : [360,1],
        navigation : false,
        navigationText: ['<a class=\"flex-prev\"></a>', '<a class=\"flex-next\"></a>'],
        slideSpeed : 500,
        pagination : true
    });


    /* Mobile menu */
    jQuery("#mobile-menu").mobileMenu({
        MenuWidth: 250,
        SlideSpeed: 300,
        WindowsMaxWidth: 767,
        PagePush: false,
        FromLeft: true,
        Overlay: true,
        CollapseMenu: true,
        ClassName: "mobile-menu"
    });
    /* side nav categories */
    if (jQuery('.subDropdown')[0]) {
        jQuery('.subDropdown').on("click", function() {
            jQuery(this).toggleClass('');
            jQuery(this).toggleClass('minus');
            jQuery(this).parent().find('ul').slideToggle();
        });
    }
    jQuery.extend(jQuery.easing, {
        easeInCubic: function(x, t, b, c, d) {
            return c * (t /= d) * t * t + b;
        },
        easeOutCubic: function(x, t, b, c, d) {
            return c * ((t = t / d - 1) * t * t + 1) + b;
        },
    });
    (function(jQuery) {
        jQuery.fn.extend({
            accordion: function() {
                return this.each(function() {
                    function activate(el, effect) {
                        jQuery(el).siblings(panelSelector)[(effect || activationEffect)](((effect == "show") ? activationEffectSpeed : false), function() {
                            jQuery(el).parents().show();
                        });
                    }
                });
            }
        });
    })(jQuery);
    jQuery(function(jQuery) {
        jQuery('.accordion').accordion();
        jQuery('.accordion').each(function(index) {
            var activeItems = jQuery(this).find('li.active');
            activeItems.each(function(i) {
                jQuery(this).children('ul').css('display', 'block');
                if (i == activeItems.length - 1) {
                    jQuery(this).addClass("current");
                }
            });
        });
    });
    /* Top Cart js */
    function slideEffectAjax() {
        jQuery('.top-cart-contain').mouseenter(function() {
            jQuery(this).find(".top-cart-content").stop(true, true).slideDown();
        });
        jQuery('.top-cart-contain').mouseleave(function() {
            jQuery(this).find(".top-cart-content").stop(true, true).slideUp();
        });
    }
    jQuery(document).ready(function() {
        slideEffectAjax();
    });

});
/*  UItoTop */
jQuery.fn.UItoTop = function(options) {
    var defaults = {
        text: '',
        min: 200,
        inDelay: 600,
        outDelay: 400,
        containerID: 'toTop',
        containerHoverID: 'toTopHover',
        scrollSpeed: 1200,
        easingType: 'linear'
    };
    var settings = jQuery.extend(defaults, options);
    var containerIDhash = '#' + settings.containerID;
    var containerHoverIDHash = '#' + settings.containerHoverID;
    jQuery('body').append('<a href="#" id="' + settings.containerID + '">' + settings.text + '</a>');
    jQuery(containerIDhash).hide().on("click", function() {
        jQuery('html, body').animate({
            scrollTop: 0
        }, settings.scrollSpeed, settings.easingType);
        jQuery('#' + settings.containerHoverID, this).stop().animate({
            'opacity': 0
        }, settings.inDelay, settings.easingType);
        return false;
    }).prepend('<span id="' + settings.containerHoverID + '"></span>').hover(function() {
        jQuery(containerHoverIDHash, this).stop().animate({
            'opacity': 1
        }, 600, 'linear');
    }, function() {
        jQuery(containerHoverIDHash, this).stop().animate({
            'opacity': 0
        }, 700, 'linear');
    });
    jQuery(window).scroll(function() {
        var sd = jQuery(window).scrollTop();
        if (typeof document.body.style.maxHeight === "undefined") {
            jQuery(containerIDhash).css({
                'position': 'absolute',
                'top': jQuery(window).scrollTop() + jQuery(window).height() - 50
            });
        }
        if (sd > settings.min) jQuery(containerIDhash).fadeIn(settings.inDelay);
        else jQuery(containerIDhash).fadeOut(settings.Outdelay);
    });
};
/* mobileMenu */
var isTouchDevice = ('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0);
jQuery(window).on("load", function() {
    if (isTouchDevice) {
        jQuery('#nav a.level-top').on("click", function(e) {
            jQueryt = jQuery(this);
            jQueryparent = jQueryt.parent();
            if (jQueryparent.hasClass('parent')) {
                if (!jQueryt.hasClass('menu-ready')) {
                    jQuery('#nav a.level-top').removeClass('menu-ready');
                    jQueryt.addClass('menu-ready');
                    return false;
                } else {
                    jQueryt.removeClass('menu-ready');
                }
            }
        });
    }
    jQuery().UItoTop();
});