<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $config['num_links'] = 3;
    $config['enable_query_strings'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    /*SET PARAM PAGE*/
    $config['page_query_string'] = FALSE;
    $config['query_string_segment'] = 'page';
    /*SET PARAM PAGE*/
    $config['reuse_query_string'] = TRUE;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="javascript:;" title="Trang hiện tại">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="last">';
    $config['last_tag_close'] = '</li>';
    $config['first_link'] = '&laquo;';
    $config['last_link'] = '&raquo;';
    $config['prev_link'] = '&lsaquo;';
    $config['next_link'] = '&rsaquo;';
    $config['display_pages'] = true;