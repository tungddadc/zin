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

    $( ".wrap-popup .popup" ).append("<div class='banner-mainmenu banner-menu'><a class='img' href='#'><img alt='Banner menu 1' src='/public/images/banner-menu1.png'></a><a class='img' href='#'><img alt='Banner menu 1' src='/public/images/banner-menu2.png'></a><a class='img' href='#'><img alt='Banner menu 1' src='/public/images/banner-menu3.png'></a></div>");

  
});