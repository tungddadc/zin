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
        $keyword = urldecode($keyword);
        $data['page'] = $page;
        $data['keyword'] = $oneItem['title'] = $keyword;
        $oneItem = (object) $oneItem;
        $data['oneItem'] = $oneItem;
        //Get data category current
        switch ($this->input->get('filter_sort')) {
            case 'oldest':
                $paramsFilter['order'] = ['created_time' => 'ASC'];
                break;
            case 'newest':
                $paramsFilter['order'] = ['created_time' => 'DESC'];
                break;
            case 'lowest':
                $paramsFilter['order'] = ['price_sort' => 'ASC'];
                break;
            case 'highest':
                $paramsFilter['order'] = ['price_sort' => 'DESC'];
                break;
        }
        $limit = $this->input->get('filter_limit');
        $data['limit'] = $limit = !empty($limit) ? $limit : 12;
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'search_custom' => $keyword,
            'limit'         => $limit,
            'page'          => $page,
        ];
        if(!empty($paramsFilter)) $params = array_merge($params,$paramsFilter);
        $data['data'] = $this->_data_product->getData($params);
        $data['total'] = $total = $this->_data_product->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlSearch($keyword).'/page';
        $paging['first_url'] =  getUrlSearch($keyword);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        /*Pagination*/

        //SEO Meta
        $data['SEO'] = array(
            'meta_title'        => $oneItem->title,
            'meta_description'  => "Kết quả tìm kiếm sản phẩm với từ khóa: $oneItem->title",
            'meta_keyword'      => "Kết quả tìm kiếm sản phẩm với từ khóa $oneItem->title",
            'url'               => getUrlSearch($keyword),
            'image'             => getImageThumb('',200,200)
        );
        $data['main_content'] = $this->load->view($this->template_path.'search/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function tags($keyword = '',$page = 1){
        if(empty($keyword)) show_404();
        //$keyword = xss_clean($keyword);
        $data['page'] = $page;
        $data['keyword'] = $oneItem['title'] = str_replace('-',' ',$keyword);
        $oneItem = (object) $oneItem;
        $data['oneItem'] = $oneItem;
        //Get data category current
        switch ($this->input->get('filter_sort')) {
            case 'oldest':
                $paramsFilter['order'] = ['created_time' => 'ASC'];
                break;
            case 'lowest':
                $paramsFilter['order'] = ['price_sort' => 'ASC'];
                break;
            case 'highest':
                $paramsFilter['order'] = ['price_sort' => 'DESC'];
                break;
            default:
                $paramsFilter['order'] = ['created_time' => 'DESC'];
        }
        $limit = $this->input->get('filter_limit');
        $data['limit'] = $limit = !empty($limit) ? $limit : 12;
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'tags'          => $oneItem->title,
            'limit'         => $limit,
            'page'          => $page
        ];
        if(!empty($paramsFilter)) $params = array_merge($params,$paramsFilter);
        $data['data'] = $this->_data_product->getData($params);
        $data['total'] = $total = $this->_data_product->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlTag($oneItem->title).'/page';
        $paging['first_url'] =  getUrlTag($oneItem->title);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        /*Pagination*/

        //SEO Meta
        $data['SEO'] = array(
            'meta_title'        => $oneItem->title,
            'meta_description'  => "Thông tin, hình ảnh, giá cả của: $oneItem->title. Linh kiện giá tốt, $oneItem->title chất lượng nhất",
            'meta_keyword'      => "$oneItem->title, $oneItem->title rẻ nhất, tốt nhất",
            'url'               => getUrlTag($keyword),
            'image'             => getImageThumb('',200,200)
        );
        $data['main_content'] = $this->load->view($this->template_path.'search/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function ajax_autocomplete(){
        $this->checkRequestPostAjax();
        $keyword = $this->input->post('keyword');
        $keyword = urldecode($keyword);
        $page = $this->input->post('page');
        $params = [
            'is_status'     => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code'     => $this->_lang_code,
            'search_custom' => $keyword,
            'limit'         => 10,
            'page'          => !empty($page) ? $page : 1
        ];
        $data['data'] = $this->_data_product->getData($params);
        print $this->load->view($this->template_path.'search/ajax_autocomplete', $data, TRUE);
        exit;
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
