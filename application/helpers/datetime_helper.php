<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('timeAgo')) {
    function timeAgo($datetime, $format = false) {
        if(strtotime($datetime) < 0) return $datetime = date('d/m/Y',strtotime("+3 month"));
        if($format !== false) return date($format,strtotime($datetime));
        $today = time();
        if(!is_numeric($datetime)) $createdday= strtotime($datetime);
        else $createdday = $datetime;
        $datediff = abs($today - $createdday);
        $difftext="";
        $years = floor($datediff / (365*60*60*24));
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours= floor($datediff/3600);
        $minutes= floor($datediff/60);
        $seconds= floor($datediff);
        //năm checker
        if($difftext=="")
        {
            if($years>1)
                $difftext=$years." năm trước";
            elseif($years==1)
                $difftext=$years." năm trước";
        }
        //month checker
        if($difftext=="")
        {
            if($months>1)
                $difftext=$months." tháng trước";
            elseif($months==1)
                $difftext=$months." tháng trước";
        }
        //month checker
        if($difftext=="")
        {
            if($days>1)
                $difftext=$days." ngày trước";
            elseif($days==1)
                $difftext=$days." ngày trước";
        }
        //hour checker
        if($difftext=="")
        {
            if($hours>1)
                $difftext=$hours." giờ trước";
            elseif($hours==1)
                $difftext=$hours." giờ trước";
        }
        //minutes checker
        if($difftext=="")
        {
            if($minutes>1)
                $difftext=$minutes." phút trước";
            elseif($minutes==1)
                $difftext=$minutes." phút trước";
        }
        //seconds checker
        if($difftext=="")
        {
            if($seconds>1)
                $difftext=$seconds." giây trước";
            elseif($seconds==1)
                $difftext=$seconds." giây trước";
        }
        return $difftext;
    }
}