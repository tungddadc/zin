$(document).ready(function() {
   "use strict"; /* Navigation */

   /*product price slider*/
    $(".price-slider").owlCarousel({
        autoPlay: true,
        autoplayHoverPause:true,
        loop:true,
        items: 1,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [900, 1],
        itemsTablet: [640, 1],
        itemsMobile: [390, 1],
        navigation: true,
        navigationText: ['<a class="flex-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>', '<a class="flex-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>'],
        slideSpeed: 5000,
        pagination: false

    });

     /*linh kien cung doi may*/
    $(".accessories-slider").owlCarousel({
        items:4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 2],
        itemsTablet: [640, 1],
        itemsMobile: [390, 1],
        loop:true,
        responsiveClass:true,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true
        
        });

});