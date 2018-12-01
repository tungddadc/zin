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
        //$this->output->cache(5);
        $this->load->view($this->template_main, $data);
    }

    private function listProduct(){
        $this->load->model('product_model');
        $categoryModel = new Category_model();
        $productModel = new Product_model();
        $allCategoryProduct = $categoryModel->getDataByCategoryType($this->_all_category,'product');
        $listCateChild = $categoryModel->getListChildLv1($allCategoryProduct,0);
        $listCategory = array();
        if(!empty($listCateChild)) foreach ($listCateChild as $item){
            if(!in_array($item->id, array(1,58,59))){
                $categoryModel->_list_category_child_id = [];
                $categoryModel->_recursive_child_id($this->_all_category,$item->id);
                $listCateId = $categoryModel->_list_category_child_id;
                $params = array(
                    'lang_code' => $this->session->userdata('public_lang_code'),
                    'is_status' => 1,
                    'category_id'=> $listCateId,
                    'limit' => $item->id == 9 ? 6 : 4
                );
                $listCategory[] = $item;
                $data['listCategoryChild'][$item->id] = $categoryModel->getListChildLv1($this->_all_category, $item->id);
                $keyCacheProduct = "_listProduct_{$item->id}_{$this->session->userdata('public_lang_code')}";
                $listProduct = $this->cache->get($keyCacheProduct);
                if(empty($listProduct)){
                    $listProduct = $productModel->getData($params);
                    $this->cache->save($keyCacheProduct,$listProduct,60*30);//30 phút
                }
                $data['listProduct'][$item->id] = $listProduct;
            }
            unset($item);
        }
        $data['listCategory'] = $listCategory;
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
        $this->load->model(['post_model']);
        $postModel = new Post_model();
        $categoryModel = new Category_model();
        $params = array(
            'lang_code' => $this->session->userdata('public_lang_code'),
            'is_status' => 1,
            'limit' => 3
        );
        return $postModel->getData($params);
    }


}
