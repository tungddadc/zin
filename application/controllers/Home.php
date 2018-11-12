<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];
      $data = array(
        array(
          'id' => 1,
          'qty' => 1,
          'price' =>10000,
          'name' => 'sản phẩm 1',
          'slug' => 'san-pham-1',
          'image' => 'anh1.jpg',
          //'options' => array('model' => isset($params['model'])?$params['model']:'','size' => isset($params['size'])?$params['size']:'', 'color' => isset($params['color'])?$params['color']:'')
        ),
        array(
          'id' => 2,
          'qty' => 1,
          'price' =>20000,
          'name' => 'sản phẩm 2',
          'image' => 'anh1.jpg',
          'slug' => 'san-pham-2',
          //'options' => array('model' => isset($params['model'])?$params['model']:'','size' => isset($params['size'])?$params['size']:'', 'color' => isset($params['color'])?$params['color']:'')
        ),array(
          'id' => 3,
          'qty' => 1,
          'price' =>30000,
          'name' => 'sản phẩm 3',
          'image' => 'anh2.jpg',
          'slug' => 'san-pham-3',
          //'options' => array('model' => isset($params['model'])?$params['model']:'','size' => isset($params['size'])?$params['size']:'', 'color' => isset($params['color'])?$params['color']:'')
        ),
      );
      // Them san pham vao gio hang
//      $this->cart->insert($data);
//
      dd($this->cart->contents());
        $data['main_content'] = $this->load->view($this->template_path . 'home/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }
}
