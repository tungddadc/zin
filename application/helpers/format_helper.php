<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('formatMoney')) {
    function formatMoney($price, $default = true){
        $_this =& get_instance();
        return !empty($price)?"<number>".number_format($price,0,'','.')."</number>đ":(($default == true)?'Liên hệ':'');
    }
}

if (!function_exists('showMoney')) {
    function showMoney($item){
        $_this =& get_instance();
        if(!empty($item->price_sale)){
            $textPrice = '<b>'.formatMoney($item->price_sale).'</b> <small>'.formatMoney($item->price).'</small>';
        }elseif(!empty($item->price)){
            $textPrice = '<b>'.formatMoney($item->price).'</b>';
        }else{
            $textPrice = "<b>Liên hệ</b>";
        }
        return $textPrice;
    }
}
if (!function_exists('getYoutubeKey')) {
    function getYoutubeKey($url){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = $match[1];
        return trim($youtube_id);
    }
}
if (!function_exists('formatCoin')) {
    function formatCoin($price){
        return floatval($price);
    }
}