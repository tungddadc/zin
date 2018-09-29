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

$config['crumb_divider'] = '';
$config['tag_open'] = '<ol class="breadcrumb">';
$config['tag_close'] = '</ol>';
$config['crumb_open'] = '<li typeof="v:Breadcrumb">';
$config['crumb_last_open'] = '<li class="active" property="v:title">';
$config['crumb_close'] = '</li>';

$config['frontend_crumb_divider'] = '';
$config['frontend_tag_open'] = '<ul vocab="http://schema.org/" typeof="BreadcrumbList">';
$config['frontend_tag_close'] = '</ul>';
$config['frontend_crumb_open'] = '<li property="itemListElement" typeof="ListItem">';
$config['frontend_crumb_last_open'] = '<li property="itemListElement" typeof="ListItem" class="active">';
$config['frontend_crumb_close'] = '</li>';
/* End of file breadcrumbs.php */
/* Location: ./application/config/breadcrumbs.php */
