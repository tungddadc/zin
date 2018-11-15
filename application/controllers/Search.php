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
        //$keyword = xss_clean($keyword);
        $data['page'] = $page;
        $data['limit'] = $limit = 36;
        $data['keyword'] = $oneItem['title'] = $keyword;
        $oneItem = (object) $oneItem;
        $data['oneItem'] = $oneItem;
        //Get data category current
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'search'        => $keyword,
            'limit'         => $limit,
            'page'          => $page
        ];
        $data['data'] = $this->_data_product->getData($params);
        $data['total'] = $total = $this->_data_product->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlSearch($keyword);
        $paging['first_url'] =  getUrlSearch($keyword);
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
            'url'               => getUrlSearch($keyword),
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
