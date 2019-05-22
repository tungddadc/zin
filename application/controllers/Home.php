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
        $this->load->model('category_model');
    }

    public function index(){
        $data['home_product_latest'] = $this->listProductLatest();
        $data['home_product_sale'] = $this->listProductSale();
        $data['home_product_featured'] = $this->listProductFeatured();
        $data['home_news'] = $this->listNews();
        $data['main_content'] = $this->load->view($this->template_path . 'home/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    private function listProductLatest(){
        $this->load->model('product_model');
        $productModel = new Product_model();
        $params = array(
            'lang_code' => $this->session->userdata('public_lang_code'),
            'is_status' => 1,
            'limit' => 8,
            'order' => ['created_time', 'DESC']
        );
        $data = $productModel->getData($params);
        return $data;
    }

    private function listProductSale(){
        $this->load->model('product_model');
        $productModel = new Product_model();
        $params = array(
            'lang_code' => $this->session->userdata('public_lang_code'),
            'is_status' => 1,
            'limit' => 8,
            'order' => ['created_time', 'DESC']
        );
        $data = $productModel->getData($params);
        return $data;
    }

    private function listProductFeatured(){
        $this->load->model('product_model');
        $productModel = new Product_model();
        $params = array(
            'lang_code' => $this->session->userdata('public_lang_code'),
            'is_status' => 1,
            'is_featured' => 1,
            'limit' => 8,
            'order' => ['created_time', 'DESC']
        );
        $data = $productModel->getData($params);
        return $data;
    }

    private function listNews(){
        $this->load->model(['post_model']);
        $postModel = new Post_model();
        $categoryModel = new Category_model();
        $params = array(
            'lang_code' => $this->session->userdata('public_lang_code'),
            'is_status' => 1,
            'limit' => 3,
            'order' => ['created_time' => 'DESC']
        );
        return $postModel->getData($params);
    }

    private function listProductByCat(){
        $this->load->model(['category_model','product_model']);
        $_product_model = new Product_model();
        $_cat_model = new Category_model();

    }

}
