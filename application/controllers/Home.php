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

    private function listNews(){
        $this->load->model(['post_model']);
        $postModel = new Post_model();
        $params = array(
            'lang_code' => $this->session->userdata('public_lang_code'),
            'is_status' => 1,
            'limit' => 3,
            'order' => ['created_time' => 'DESC']
        );
        return $postModel->getData($params);
    }

    private function listProduct(){
        $this->load->model('product_model');
        $categoryModel = new Category_model();
        $productModel = new Product_model();
        $allCategoryProduct = $categoryModel->_all_category('product');
        $listCateChild = $categoryModel->getListChild($allCategoryProduct,0);
        $listCategory = array();
        if(!empty($listCateChild)) foreach ($listCateChild as $item){
            $categoryModel->_list_category_child_id = [];
            $categoryModel->_recursive_child_id($allCategoryProduct,$item->id);
            $listCateId = $categoryModel->_list_category_child_id;
            $params = array(
                'lang_code' => $this->session->userdata('public_lang_code'),
                'is_status' => 1,
                'category_id'=> $listCateId,
                'order' => ['created_time' => 'DESC'],
                'limit' => 6
            );
            $listCategory[] = $item;
            $data['listCategoryChild'][$item->id] = $categoryModel->getListChild($allCategoryProduct, $item->id);
            $keyCacheProduct = "_listProduct_{$item->id}_{$this->session->userdata('public_lang_code')}";

            $listProduct = $this->cache->get($keyCacheProduct);
            if(empty($listProduct)){
                $listProduct = $productModel->getData($params);
                $this->cache->save($keyCacheProduct,$listProduct,60*30);//30 phút
            }
            $data['listProduct'][$item->id] = $listProduct;
            unset($item);
        }
        $data['listCategory'] = $listCategory;
        return $data;
    }

}
