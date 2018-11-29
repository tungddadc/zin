<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->load->library('image_lib');
        $source = MEDIA_PATH . "STK-TCM.jpg";
        $sourceNew = MEDIA_PATH_THUMB . "STK-TCM-crop.jpg";

        $imageSize = $this->image_lib->get_image_properties($source, TRUE);

        $width = "200";
        $height = "200";

        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $sourceNew;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;

        $config['width'] = $width;
        $config['height'] = $height;
        $config['y_axis'] = ($imageSize['height'] - $height) / 2;
        $config['x_axis'] = ($imageSize['width'] - $width) / 2;

        $this->image_lib->initialize($config);

        if(!$this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        }
    }
}
