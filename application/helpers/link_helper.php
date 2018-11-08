<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('site_admin_url')) {
    function site_admin_url($uri = '')
    {
        return BASE_ADMIN_URL . $uri;
    }
}
if (!function_exists('getUrlCateNews')) {
    function getUrlCateNews($optional){
        if(is_object($optional)) $optional = (array) $optional;
        $id = $optional['id'];
        $slug = $optional['slug'];
        $linkReturn = BASE_URL;
        $linkReturn .= "$slug-c$id";
        if(isset($optional['page'])) $linkReturn .= '/page/';
        return $linkReturn;
    }
}

if (!function_exists('getUrlNews')) {
    function getUrlNews($optional){
        if(is_object($optional)) $optional = (array) $optional;
        $id = $optional['id'];
        $slug = $optional['slug'];
        $linkReturn = BASE_URL;
        $linkReturn .= "$slug-d$id";
        if(isset($optional['page'])) $linkReturn .= '/page/';
        return $linkReturn;
    }
}
if (!function_exists('getUrlBrand')) {
    function getUrlBrand($optional){
        if(is_object($optional)) $optional = (array) $optional;
        $id = $optional['id'];
        $slug = $optional['slug'];
        $linkReturn = BASE_URL;
        $linkReturn .= "$slug-b$id";
        if(isset($optional['page'])) $linkReturn .= '/page/';
        return $linkReturn;
    }
}
if (!function_exists('getUrlPage')) {
    function getUrlPage($optional = []){
        if(is_object($optional)) $optional = (array) $optional;
        $linkReturn = BASE_URL;
        if(!empty($optional['slug'])) {
            $slug = $optional['slug'];
            $linkReturn .= "$slug.html";
        }
        return $linkReturn;
    }
}

if (!function_exists('getUrlCateProduct')) {
    function getUrlCateProduct($optional){
        if(is_object($optional)) $optional = (array) $optional;
        $id = $optional['id'];
        $slug = $optional['slug'];
        $linkReturn = BASE_URL;
        $linkReturn .= "$slug-cp$id";
        if(isset($optional['page'])) $linkReturn .= '/page/';
        return $linkReturn;
    }
}
if (!function_exists('getUrlProduct')) {
    function getUrlProduct($optional){
        if(is_object($optional)) $optional = (array) $optional;
        $id = $optional['id'];
        $slug = $optional['slug'];
        $linkReturn = BASE_URL;
        $linkReturn .= "$slug-p$id";
        return $linkReturn;
    }
}

if (!function_exists('getUrlAbout')) {
    function getUrlAbout($optional = []){
        if(is_object($optional)) $optional = (array) $optional;
        $_this =& get_instance();
        $_this->load->model('page_model','page');
        $linkReturn = BASE_URL.'about';
        if(!empty($optional['slug'])) {
            $slug = $optional['slug'];
            $linkReturn .= "/$slug";
        }
        return $linkReturn;
    }
}

if (!function_exists('getUrlTag')) {
    function getUrlTag($keyword){
        $_this =& get_instance();
        $_this->load->library('session');
        $_this->load->helper('url');
        $slug = $_this->toSlug($keyword);
        $linkReturn = BASE_URL."search/$slug";
        return $linkReturn;
    }
}

if (!function_exists('getUrlSearch')) {
    function getUrlSearch($keyword){
        $_this =& get_instance();
        $_this->load->library('session');
        $_this->load->helper('url');
        $slug = $_this->toSlug($keyword);
        $linkReturn = BASE_URL."search/$slug";
        return $linkReturn;
    }
}


if (!function_exists('getUrlDownload')) {
    function getUrlDownload($link){
        $linkReturn = MEDIA_URL.$link;
        return $linkReturn;
    }
}

if (!function_exists('getYoutubeKey')) {
    function getYoutubeKey($link){
        preg_match('/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"\'>]+)/',$link, $matches);
        return $matches[1];
    }
}

if (!function_exists('cutString')){
    function cutString($chuoi,$max){
        $length_chuoi = strlen($chuoi);
        if($length_chuoi <= $max){
            return $chuoi;
        }else{
            return mb_substr($chuoi,0,$max,'UTF-8').'...';
        }
    }
}

if (!function_exists('getUrlLogin')){
    function getUrlLogin(){
      $_this =& get_instance();
      return $_this->getUrlLogin();
    }
}