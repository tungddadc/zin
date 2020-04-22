<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BREADCRUMB CONFIG
| -------------------------------------------------------------------
| This file will contain some breadcrumbs' settings.
|
| $config['crumb_divider']		The string used to divide the crumbs
| $config['tag_open'] 			The opening tag for breadcrumb's holder.
| $config['tag_close'] 			The closing tag for breadcrumb's holder.
| $config['crumb_open'] 		The opening tag for breadcrumb's holder.
| $config['crumb_close'] 		The closing tag for breadcrumb's holder.
|
| Defaults provided for twitter bootstrap 2.0
*/

$config['crumb_divider'] = '<li class="m-nav__separator"> - </li>';
$config['tag_open'] = '<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">';
$config['tag_close'] = '</ul>';
$config['crumb_open'] = '<li class="m-nav__item">';
$config['crumb_first_open'] = '<li class="m-nav__item m-nav__item--home">';
$config['crumb_last_open'] = '<li class="m-nav__item">';
$config['crumb_close'] = '</li>';

$config['frontend_crumb_divider'] = '<span>/</span>';
$config['frontend_tag_open'] = '<ul>';
$config['frontend_tag_close'] = '</ul>';
$config['frontend_crumb_open'] = '<li>';
$config['frontend_crumb_last_open'] = '<li class="active">';
$config['frontend_crumb_close'] = '</li>';
/* End of file breadcrumbs.php */
/* Location: ./application/config/breadcrumbs.php */
