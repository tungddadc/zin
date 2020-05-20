<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Intervention\Image\ImageManagerStatic as Image;

if (!function_exists('getImageThumb')) {
	function getImageThumb($image = '', $width = '', $height = '', $crop = false, $watermark = false)
	{
		if (empty($image)) {
			return MEDIA_URL . "no-image.jpg";
		}
		$image = trim($image);
		if (strpos($image, 'http')) return trim($image);
		$imageOrigin = MEDIA_PATH . "/" . $image;
		if (!empty($width) && !empty($height) && $crop == true) {
			$sizeText = sprintf('-%dx%d', $width, $height);
			$ext = pathinfo($image, PATHINFO_EXTENSION);
			$newImage = str_replace(".$ext", "$sizeText.$ext", $image);
			$pathThumb = MEDIA_PATH . '/thumb/' . $newImage;
			$pathThumb = str_replace('//', '/', $pathThumb);
			if (!file_exists($pathThumb)) {
				try {
					if (!is_dir(dirname($pathThumb))) {
						mkdir(dirname($pathThumb), 0755, TRUE);
					}
					// import the Intervention Image Manager Class
					// configure with favored image driver (gd by default)
					Image::configure(array('driver' => 'gd'));

					// and you are ready to go ...
					$image = Image::make($imageOrigin)->fit(intval($width), intval($height));
					$image->save($pathThumb);
				} catch (Exception $e) {
					dd($e);
				}
			}
			return MEDIA_URL . 'thumb/' . ltrim($newImage, '/');
		}
		return MEDIA_URL . $image;
	}
}

if (!function_exists('getWatermark')) {
	function getWatermark($width = '',$height= ''){
		$CI =& get_instance();
		$CI->load->model('setting_model');
		$settings = $CI->setting_model->getAll();
		$width = intval(250/2);
		$height = intval(300/2);
		$image = !empty($settings['watermark']) ? $settings['watermark'] : null;
		$image = ltrim($image,'/');
		if(!empty($image)){
			$source_image = MEDIA_PATH . $image;
			$size = sprintf('-%dx%d', $width, $height);
			$part = explode('.', $image);
			$ext = '.'.end($part);
			$newImage = str_replace($ext,$size.$ext, $image);
			$newPathImage = MEDIA_PATH . $newImage;

			if(!file_exists($newPathImage)) {
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
					log_message('error',"Error watermark image: $newPathImage =>" . $CI->image_lib->display_errors());
				}
				$CI->image_lib->clear();
			}
			return $newPathImage;
		}else{
			return false;
		}
	}
}
