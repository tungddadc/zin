<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 13/01/2018
 * Time: 2:06 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Search extends Public_Controller {

    protected $_data_post;
    protected $_data_product;
    protected $_lang_code;
    protected $_list_category_title_queue;
    protected $_link;
    public function __construct()
    {
        parent::__construct();
        //tải model
        $this->load->model(['product_model','post_model']);

        $this->_data_post = new Post_model();
        $this->_data_product = new Product_model();
        //Check xem co chuyen lang hay khong thi set session lang moi
        if($this->input->get('lang'))
            $this->_lang_code = $this->input->get('lang');
        else
            $this->_lang_code = $this->session->public_lang_code;
    }

    public function index($keyword = '',$page = 1){
        if(empty($keyword)) show_404();
        $keyword = xss_clean($keyword);
        $data['page'] = $page;
        $data['limit'] = $limit = 36;
        $data['keyword'] = $oneItem['title'] = $keyword;
        $oneItem = (object) $oneItem;
        $data['oneItem'] = $oneItem;
        /*Lay list cac thuoc tinh*/
        $this->load->model('property_model');
        $propertyModel = new Property_model();
        if(!$this->cache->get('_all_property_'.$this->session->public_lang_code)){
            $this->cache->save('_all_property_'.$this->session->public_lang_code,$propertyModel->getAll($this->session->public_lang_code),60*60*30);
        }
        $_all_property = $this->cache->get('_all_property_'.$this->session->public_lang_code);
        $data['property_format'] = $propertyModel->getDataByPropertyType($_all_property,'format');
        $data['property_type'] = $propertyModel->getDataByPropertyType($_all_property,'type');
        $data['property_color'] = $propertyModel->getDataByPropertyType($_all_property,'color');
        /*Lay list cac thuoc tinh*/
        //Get data category current
        $searchCategory = $this->input->get('search_category_id');
        $listCategoryId = null;
        if(!empty($searchCategory) && $searchCategory != 1){
            $this->load->model('category_model');
            $categoryModel = new Category_model();
            /*Lay list id con của category*/
            $categoryModel->_list_category_child_id = null;
            $categoryModel->_recursive_child_id($this->cache->get('_all_category_'.$this->session->public_lang_code),$searchCategory);
            $listCategoryId = $categoryModel->_list_category_child_id;
            /*Lay list id con của category*/
        }
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'search'        => $keyword,
            'category_id'   => $listCategoryId,
            'limit'         => $limit,
            'page'          => $page
        ];
        $data['data'] = $this->_data_product->getData($params);
        $data['total'] = $total = $this->_data_product->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlSearch(['title'=>$oneItem->title,'page' => 1]);
        $paging['first_url'] =  getUrlSearch($oneItem);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        /*Pagination*/

        //SEO Meta
        $data['SEO'] = array(
            'meta_title'        => $oneItem->title,
            'meta_description'  => "Search result: $oneItem->title",
            'meta_keyword'      => "Keyword $oneItem->title",
            'url'               => getUrlSearch($oneItem),
            'image'             => getImageThumb('',400,200)
        );
        $data['main_content'] = $this->load->view($this->template_path.'search/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function ajax_autocomplete(){
        $this->checkRequestPostAjax();
        $keyword = $this->input->post('keyword');
        $params = [
            'search' => $keyword,
            'is_status' => 1,
            'lang_code' => $this->session->userdata('public_lang_code'),
            'limit' => 5
        ];
        $data['data'] = $this->_data_product->getData($params);
        echo $this->load->view($this->template_path.'search/ajax_autocomplete', $data, TRUE);exit;
    }

    public function ajax_load_more(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $type = $this->input->post('type');
            $page = $this->input->post('page');
            $keyword = $this->input->post('keyword');
            $limit = 3;
            if($type === 'product') $data = $this->loadProduct($keyword, $limit, $page);
            else $data = $this->loadPost($keyword, $limit, $page);

            // Kiểm tra nếu là ajax request thì trả kết quả
            $html = $this->load->view($this->template_path.'search/_ajax_load_more', $data , TRUE);
            print $html;exit;
        }
    }

    private function sortArrayByKey(&$array,$key,$string = false,$asc = true){
        $array = json_decode(json_encode($array),TRUE);
        if($string){
            usort($array,function ($a, $b) use(&$key,&$asc)
            {
                if($asc)    return strcmp(strtolower($a{$key}), strtolower($b{$key}));
                else        return strcmp(strtolower($b{$key}), strtolower($a{$key}));
            });
        }else{
            usort($array,function ($a, $b) use(&$key,&$asc)
            {
                if($a[$key] == $b{$key}){return 0;}
                if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
                else     return ($a{$key} > $b{$key}) ? -1 : 1;

            });
        }
    }

    private function loadProduct($keyword, $limit ,$page){
        $this->_data_product = new Product_model();
        //Get data category current
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'search'        => $keyword,
            'limit'         => $limit,
            'page'          => $page
        ];
        $data['list_product'] = $this->_data_product->getData($params);
        $data['total_product'] = $this->_data_product->getTotal($params);

        return $data;
    }

    private function loadPost($keyword, $limit ,$page){
        $this->_data_post = new Post_model();
        //Get data category current
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'search'        => $keyword,
            'limit'         => $limit,
            'page'          => $page
        ];
        $data['list_post'] = $this->_data_post->getData($params);
        $data['total_post'] = $this->_data_post->getTotal($params);

        return $data;
    }

}
