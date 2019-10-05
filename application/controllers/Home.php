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
        $data['home_product'] = $this->listProduct();
        $data['home_news'] = $this->listNews();
        $data['main_content'] = $this->load->view($this->template_path . 'home/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    private function listProduct()
    {
        $keyCacheProduct = "home_product";
        $data = $this->getCache($keyCacheProduct);
        if (empty($data)) {
            $this->load->model('product_model');
            $categoryModel = new Category_model();
            $productModel = new Product_model();
            $allCategoryProduct = $categoryModel->_all_category('product');
            $listCateChild = $categoryModel->getListChild($allCategoryProduct, 0);
            $listCategory = array();
            if (!empty($listCateChild)) foreach ($listCateChild as $item) {
                $categoryModel->_list_category_child_id = [];
                $categoryModel->_recursive_child_id($allCategoryProduct, $item->id);
                $listCateId = $categoryModel->_list_category_child_id;
                $params = array(
                    'lang_code' => $this->session->userdata('public_lang_code'),
                    'is_status' => 1,
                    'is_featured' => 1,
                    'category_id' => $listCateId,
                    'limit' => 4
                );
                $listCategory[] = $item;
                $data['listCategoryChild'][$item->id] = $categoryModel->getListChild($allCategoryProduct, $item->id);
                $data['listProduct'][$item->id] = $productModel->getData($params);
                unset($item);
            }
            $data['listCategory'] = $listCategory;
            $this->setCache($keyCacheProduct, $data, 60 * 30);//30 phút
        }
        return $data;
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
        $key = "home_listnews";
        $data = $this->getCache($key);
        if(empty($data)){
            $this->load->model(['post_model']);
            $postModel = new Post_model();
            $params = array(
                'lang_code' => $this->session->userdata('public_lang_code'),
                'is_status' => 1,
                'limit' => 3,
                'order' => ['created_time' => 'DESC']
            );
            $data = $postModel->getData($params);
            $this->setCache($key,$data,60*60);
        }

        return $data;
    }


}
