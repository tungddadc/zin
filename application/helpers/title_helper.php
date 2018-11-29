<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getTitle')) {
    function getTitle($oneData){
        $_this =& get_instance();
        $_this->load->model('setting_model');
        $settings = $_this->setting_model->getAll();
        $title = !empty($oneData->meta_title)?$oneData->meta_title:(!empty($oneData->title)?$oneData->title:'');
        return str_replace('"','\'',$title)." - ".$settings['name'];
    }
}