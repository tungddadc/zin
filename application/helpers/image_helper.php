<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getImageThumb')) {
    function getImageThumb($image = '',$width = '',$height= '', $crop = false, $watermark = true){
        if(is_array(json_decode($image))){
            $imageArray = json_decode($image);
            $image = $imageArray[0];
        }
        if(empty($image)) {
            $width = !empty($width)?$width:200;
            $height = !empty($height)?$height:200;
            $image =  "no_image.png";
        }
        $image = str_replace(MEDIA_NAME,'',$image);
        $sourceImage = MEDIA_PATH . $image;
        $sourceImage = str_replace('\\','/',$sourceImage);

        if(!file_exists($sourceImage)){
            $width = !empty($width)?$width:200;
            $height = !empty($height)?$height:200;
            $sourceImage = MEDIA_PATH . "no_image.png";
        }
        $CI =& get_instance();
        if($width != 0 && $height != 0){
            $size = sprintf('-%dx%d', $width, $height);
            $part = explode('.', $image);
            $ext = '.'.end($part);
            $newImage = str_replace($ext,$size.$ext, $image);
            $newPathImage = MEDIA_PATH_THUMB.DIRECTORY_SEPARATOR.$newImage;
            $newPathImage = str_replace('\\','/',$newPathImage);
            if ( !file_exists( $newPathImage ) ) {
                if(!is_dir(dirname($newPathImage))){
                    mkdir(dirname($newPathImage), 0755, TRUE);
                }

                // CONFIGURE IMAGE LIBRARY
                $CI->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $sourceImage;
                $config['new_image'] = $newPathImage;
                $config['maintain_ratio'] = TRUE;
                $config['create_thumb'] = FALSE;
                $config['height'] = $height;
                $config['width'] = $width;
                $imageSize = getimagesize($sourceImage);
                $imageWidth = intval($imageSize[0]);
                $imageHeight = intval($imageSize[1]);
                $dim = ($imageWidth / $imageHeight) - ($width / $height);
                $config['master_dim'] = ($dim > 0) ? "height" : "width";
                $CI->image_lib->initialize($config);
                if (!$CI->image_lib->resize()) {
                    log_message('error',$CI->image_lib->display_errors());
                    return str_replace('\\','/',MEDIA_URL.DIRECTORY_SEPARATOR.$image);
                } else {
                    $CI->image_lib->clear();
                    if(!empty($watermark)){
                        $config_watermark['image_library']       = 'gd2';
                        $config_watermark['source_image']       = $newPathImage;
                        $config_watermark['wm_type']       = 'overlay';
                        $config_watermark['wm_opacity']     = 60;
                        //$config_watermark['wm_padding']     = 30;
                        $config_watermark['wm_vrt_alignment'] = 'middle';
                        $config_watermark['wm_hor_alignment'] = 'center';
                        $config_watermark['wm_overlay_path'] = getWatermark($width,$height);
                        $CI->image_lib->initialize($config_watermark);
                        $CI->image_lib->watermark();
                        $CI->image_lib->clear();
                    }

                    if($crop == true){
                        $image_config['image_library'] = 'gd2';
                        $image_config['source_image'] = $newPathImage;
                        $image_config['new_image'] = $newPathImage;
                        $image_config['quality'] = "100%";
                        $image_config['maintain_ratio'] = FALSE;
                        $image_config['width'] = $width;
                        $image_config['height'] = $height;
                        $imageSize = getimagesize($newPathImage);
                        $imageWidth = intval($imageSize[0]);
                        $imageHeight = intval($imageSize[1]);
                        $cropStartX = ( $imageWidth / 2) - ( $width /2 );
                        $cropStartY = ( $imageHeight/ 2) - ( $height/2 );
                        $image_config['x_axis'] = $cropStartX;
                        $image_config['y_axis'] = $cropStartY;
                        $CI->image_lib->initialize($image_config);
                        if (!$CI->image_lib->crop()) {
                            log_message('error',$CI->image_lib->display_errors());
                        }
                        $CI->image_lib->clear();
                        return str_replace('\\','/',MEDIA_URL.DIRECTORY_SEPARATOR.$image);
                    }

                }
            }
            return str_replace('\\','/',MEDIA_URL.DIRECTORY_SEPARATOR.$newImage);
        }
        else {
            $newPathImage = MEDIA_PATH_THUMB.$image;
            if(!is_dir(dirname($newPathImage))){
                mkdir(dirname($newPathImage), 0755, TRUE);
                copy($sourceImage, $newPathImage);
            }
            return str_replace('\\','/',MEDIA_URL.$image);
        }
    }
}

if (!function_exists('getWatermark')) {
    function getWatermark($width = '',$height= ''){
        $width = intval(250/2);
        $height = intval(300/2);
        $image = 'logo-watermark.png';
        $source_image = MEDIA_PATH . $image;
        $size = sprintf('-%dx%d', $width, $height);
        $part = explode('.', $image);
        $ext = '.'.end($part);
        $newImage = str_replace($ext,$size.$ext, $image);
        $newPathImage = MEDIA_PATH_THUMB.$newImage;

        if(!file_exists($newPathImage)) {
            $CI =& get_instance();
            $CI->load->library('image_lib');
            $config_watermark['image_library'] = 'gd2';
            $config_watermark['source_image'] = $source_image;
            $config_watermark['new_image'] = $newPathImage;
            $config_watermark['maintain_ratio'] = TRUE;
            $config_watermark['create_thumb'] = FALSE;
            $config_watermark['height'] = $height;
            $config_watermark['width'] = $width;
            $CI->image_lib->initialize($config_watermark);
            if (!$CI->image_lib->resize()) {
                log_message('error', $CI->image_lib->display_errors());
            }
            $CI->image_lib->clear();
        }
        return str_replace('\\', '/', $newPathImage);
    }
}