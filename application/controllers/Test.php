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
        exit;
        $this->load->library('image_lib');
        $source = MEDIA_PATH . "STK-TCM.jpg";
        $sourceNew = MEDIA_PATH_THUMB . "STK-TCM-crop.jpg";

        $imageSize = $this->image_lib->get_image_properties($source, TRUE);

        $width = "200";
        $height = "200";

        $config1 = $config2 = array();

        $config1['image_library']     = 'gd2';
        $config1['source_image']      = $source;
        $config1['new_image']         = $sourceNew;
        $config1['maintain_ratio']    = TRUE;
        $config1['width']             = $width;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config1);
        $this->image_lib->resize();

        $this->image_lib->clear();

        $config2['image_library'] = 'gd2';
        $config2['source_image']  = './project_pics/resize/'.$filename;
        $config2['new_image']     = './project_pics/crop/'.$filename;
        $config2['width']         = 650;
        $config2['height']        = 450;
        $config2['x_axis']        = 0;
        $config2['y_axis']        = 0;

        $this->image_lib->initialize($config2);
        $this->image_lib->crop();
    }
}
