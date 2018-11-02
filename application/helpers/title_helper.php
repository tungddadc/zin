<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getTitle')) {
    function getTitle($oneData){
        $_this =& get_instance();
        $dataSetting = file_get_contents(FCPATH.'config'.DIRECTORY_SEPARATOR.'settings.cfg');
        $dataSetting = $dataSetting ? json_decode($dataSetting,true) : array();
        $settings = [];
        if(!empty($dataSetting)) foreach ($dataSetting as $key => $item){
            if($key === 'meta'){
                $oneMeta = $item[$_this->session->userdata('public_lang_code')];
                if(!empty($oneMeta)) foreach ($oneMeta as $keyMeta => $value){
                    $settings[$keyMeta] = str_replace('"','\'',$value);
                }
            } else
                $settings[$key] = $item;
        }

        $title = !empty($oneData->meta_title)?$oneData->meta_title:(!empty($oneData->title)?$oneData->title:'');
        return str_replace('"','\'',$title)." - ".$settings['name'];
    }
}