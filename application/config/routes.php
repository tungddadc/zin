<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404.html'] = 'page/notfound';
$route['translate_uri_dashes'] = FALSE;
$route['sitemap.xml'] = 'seo/sitemap';
$route['admin'] = 'admin/dashboard';

$route['profile'] = 'profile/index';
$route['profile/detail-order/(:num)'] = 'profile/orderdetail/$1';
$route['cart'] = 'cart/index';

//Profile
$route['account'] = 'account/index';
//Profile
$route['(:any)-ag(:num)'] = 'agency/detail/$2';

/*Route tags*/
$route['tags/(:any)-t(:num)']   = 'product/tags/$2';
$route['tags/(:any)-t(:num)/page/(:num)']   = 'product/tags/$2/$3';
/*Route tags*/


/*Route post*/
$route['(:any)-c(:num)'] = 'news/category/$2';
$route['(:any)-c(:num)/page/(:num)'] = 'news/category/$2/$3';
$route['(:any)-d(:num)'] = 'news/detail/$2/';
/*Route post*/
/*Route post*/
$route['(:any)-cf(:num)'] = 'faq/category/$2';
$route['(:any)-cf(:num)/page/(:num)'] = 'faq/category/$2/$3';
$route['(:any)-df(:num)'] = 'faq/detail/$2/';
$route['(:any)-dqt(:num)'] = 'faq/question/$2/';
/*Route post*/
/*Route post*/
$route['(:any)-b(:num)'] = 'product/brand/$2';
$route['(:any)-b(:num)/page/(:num)'] = 'product/brand/$2/$3';
/*Route post*/


/* Route search */
$route['search_autocomplete']   = 'search/ajax_autocomplete';
$route['search/(:any)']   = 'search/index/$1';
$route['search/(:any)/page/(:num)']   = 'search/index/$1/$2';
/* Route search*/

//page
$route['(:any).html'] = 'page/index/$1';
$route['(:any).html/page/(:num)'] = 'page/index/$1/$2';
//page
/*Route product*/
$route['(:any)-cp(:num)'] = 'product/category/$2';
$route['(:any)-cp(:num)/page/(:num)'] = 'product/category/$2/$3';
$route['wishlist'] = 'product/wishlist';
$route['so-sanh-san-pham'] = 'product/compare';
$route['(:any)'] = 'product/detail/$1';
/*Route product*/
