jQuery(document).ready(function() {
   "use strict"; /* Navigation */

   /*product price slider*/
    jQuery(".price-slider").owlCarousel({
        autoPlay: false,
        items: 1,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [900, 1],
        itemsTablet: [640, 1],
        itemsMobile: [390, 1],
        navigation: true,
        navigationText: ['<a class="flex-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>', '<a class="flex-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>'],
        slideSpeed: 500,
        pagination: false

    });

});