<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Public_Controller
{
    protected $cid = 0;
    protected $_data;
    protected $_data_category;
    protected $category_tree;
    protected $_lang_code;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['category_model', 'product_model']);
        $this->_data = new Product_model();
        $this->_data_category = new Category_model();
        $this->_lang_code = $this->session->userdata('public_lang_code');
    }

    public function category($id, $page = 1){
        $oneItem = $this->_data_category->getByIdCached($id);
        if (empty($oneItem)) show_404();
        if ($oneItem->type !== 'product') show_404();
        if ($this->input->get('lang')) {
            redirect(getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }

        $data['oneItem'] = $oneItem;
        $data['oneParent'] = $oneParent = $this->_data_category->_recursive_one_parent($this->_data_category->_all_category(),$id);
        /*$this->_data_category->_recursive_child($this->_data_category->_all_category(),$oneParent->id);
        $listCateChild = $this->_data_category->_list_category_child;*/
        /*Get level category*/
        $this->_data_category->_recursive_parent($this->_data_category->_all_category(), $oneItem->id);

        $data['list_category_child'] = $this->_data_category->getListChild($this->_data_category->_all_category(), $id);

        /*Lay list id con của category*/
        $this->_data_category->_list_category_child_id = null;
        $this->_data_category->_recursive_child_id($this->_data_category->_all_category(),$id);
        $listCateId = $this->_data_category->_list_category_child_id;
        /*Lay list id con của category*/

        /*Lay list cac thuoc tinh*/
        /*$this->load->model('property_model');
        $propertyModel = new Property_model();
        if(!$this->cache->get('_all_property_'.$this->session->public_lang_code)){
            $this->cache->save('_all_property_'.$this->session->public_lang_code,$propertyModel->getAll($this->session->public_lang_code),60*60*30);
        }
        $_all_property = $this->cache->get('_all_property_'.$this->session->public_lang_code);
        $data['property_format'] = $propertyModel->getDataByPropertyType($_all_property,'format');
        $data['property_type'] = $propertyModel->getDataByPropertyType($_all_property,'type');
        $data['property_color'] = $propertyModel->getDataByPropertyType($_all_property,'color');
        $data['property_genre'] = $propertyModel->getGenre($_all_property,'genre',$oneParent->id);*/
        /*Lay list cac thuoc tinh*/
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
        $data['page'] = $page;
        $params = [
            'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code' => $this->_lang_code,
            'category_id' => ($id != 1) ? $listCateId : null,
            'limit' => $limit,
            'page' => $page
        ];
        if(!empty($paramsFilter)) $params = array_merge($params,$paramsFilter);
        $data['data'] = $this->_data->getData($params);
        $data['total'] = $this->_data->getTotal($params);

        /*List product viewed*/
        $this->_updateLastViewed($id);
        $listIdView = json_decode(get_cookie('last_viewed'), true);
        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['in'] = $listIdView;
        $params['not_in'] = $id;
        $params['limit'] = 4;
        $data['listProductViewed'] = $this->_data->getData($params);
        /*List product viewed*/

        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id, 'page' => 1]);
        $paging['first_url'] = getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        /*Pagination*/

        //add breadcrumbs
        $this->breadcrumbs->push("Trang chủ", base_url());
        $this->_data_category->_recursive_parent($this->_data_category->_all_category(), $id);
        if(!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item){
            $this->breadcrumbs->push($item->title, getUrlCateProduct($item));
        }
        $this->breadcrumbs->push($oneItem->title, getUrlCateProduct($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlCateProduct($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];

        if($oneParent->layout) $layoutView = '-'.$oneParent->layout;
        else $layoutView = '';

        $data['main_content'] = $this->load->view($this->template_path . 'product/category'.$layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);

    }

    public function brand($id, $page = 1){
        $oneItem = $this->_data_category->getByIdCached($id);
        if (empty($oneItem)) show_404();
        if ($oneItem->type !== 'brand') show_404();

        if ($this->input->get('lang')) {
            redirect(getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }

        $data['oneItem'] = $oneItem;
        $data['oneParent'] = $oneParent = $this->_data_category->_recursive_one_parent($this->_data_category->_all_category(),$id);
        /*$this->_data_category->_recursive_child($this->_data_category->_all_category(),$oneParent->id);
        $listCateChild = $this->_data_category->_list_category_child;*/
        /*Get level category*/
        $this->_data_category->_recursive_parent($this->_data_category->_all_category(), $oneItem->id);

        $data['list_category_child'] = $this->_data_category->getListChild($this->_data_category->_all_category(), $id);

        /*Lay list id con của category*/
        $this->_data_category->_list_category_child_id = null;
        $this->_data_category->_recursive_child_id($this->_data_category->_all_category(),$id);
        $listCateId = $this->_data_category->_list_category_child_id;
        /*Lay list id con của category*/

        /*Lay list cac thuoc tinh*/
        /*$this->load->model('property_model');
        $propertyModel = new Property_model();
        if(!$this->cache->get('_all_property_'.$this->session->public_lang_code)){
            $this->cache->save('_all_property_'.$this->session->public_lang_code,$propertyModel->getAll($this->session->public_lang_code),60*60*30);
        }
        $_all_property = $this->cache->get('_all_property_'.$this->session->public_lang_code);
        $data['property_format'] = $propertyModel->getDataByPropertyType($_all_property,'format');
        $data['property_type'] = $propertyModel->getDataByPropertyType($_all_property,'type');
        $data['property_color'] = $propertyModel->getDataByPropertyType($_all_property,'color');
        $data['property_genre'] = $propertyModel->getGenre($_all_property,'genre',$oneParent->id);*/
        /*Lay list cac thuoc tinh*/
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
        $data['page'] = $page;
        $params = [
            'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code' => $this->_lang_code,
            'category_id' => ($id != 1) ? $listCateId : null,
            'limit' => $limit,
            'page' => $page
        ];
        if(!empty($paramsFilter)) $params = array_merge($params,$paramsFilter);
        $data['data'] = $this->_data->getData($params);
        $data['total'] = $this->_data->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id, 'page' => 1]);
        $paging['first_url'] = getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        /*Pagination*/

        //add breadcrumbs
        $this->breadcrumbs->push("Trang chủ", base_url());
        $this->_data_category->_recursive_parent($this->_data_category->_all_category(), $id);
        if(!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item){
            $this->breadcrumbs->push($item->title, getUrlCateProduct($item));
        }
        $this->breadcrumbs->push($oneItem->title, getUrlCateProduct($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlCateProduct($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];

        if($oneParent->layout) $layoutView = '-'.$oneParent->layout;
        else $layoutView = '';

        $data['main_content'] = $this->load->view($this->template_path . 'product/category'.$layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);

    }

    public function detail($id){
        $oneItem = $this->_data->getById($id,'', $this->_lang_code);
        if (empty($oneItem)) redirect('404');
        $this->flushView($id,$oneItem->viewed);
        //Check xem co chuyen lang hay khong thi redirect ve lang moi
        if ($this->input->get('lang')) {
            redirect(getUrlProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }

        $data['oneCategory'] = $oneCategory = $this->_data->getOneCateIdById($id);
        $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_data_category->_all_category(),$data['oneCategory']->id);
        if(!empty($data['oneParent'])){
            $data['list_category_child'] = $this->_data_category->getCategoryChild($data['oneParent']->id,$this->session->public_lang_code);
        }
        $data['oneItem'] = $oneItem;
        $data['onePrev'] = $this->_data->getPrevById($oneItem->id,'',$this->_lang_code);
        $data['oneNext'] = $this->_data->getNextById($oneItem->id,'',$this->_lang_code);
        $data['data_detail'] = $this->_data->getDetail($id);
        $data['oneBrand'] = $this->_data_category->getByIdCached((int)$oneItem->brand);

        /*List product related*/
        $this->_data_category->_recursive_child_id($this->_data_category->_all_category(),$oneCategoryParent->id);
        $listCateId = $this->_data_category->_list_category_child_id;
        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['not_in'] = $id;
        $params['limit'] = 8;
        $params['category_id'] = $listCateId;
        $data['listProductBrand'] = $this->_data->getData($params);
        /*List product related*/

        /*List product viewed*/
        $this->_updateLastViewed($id);
        $listIdView = json_decode(get_cookie('last_viewed'), true);
        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['in'] = $listIdView;
        $params['not_in'] = $id;
        $params['limit'] = 8;
        $data['listProductViewed'] = $this->_data->getData($params);
        /*List product viewed*/

        //add breadcrumbs
        $this->breadcrumbs->push("Trang chủ", base_url());
        $this->_data_category->_recursive_parent($this->_data_category->_all_category(), $oneCategory->id);
        if(!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item){
            $this->breadcrumbs->push($item->title, getUrlCateProduct($item));
        }
        $this->breadcrumbs->push($oneItem->title, getUrlProduct($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_title) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];
        if(!empty($oneCategoryParent->layout)) $layoutView = '-'.$oneCategoryParent->layout;
        else $layoutView = '';

        $data['main_content'] = $this->load->view($this->template_path . 'product/detail'.$layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }
    private function flushView($id, $view){
        $this->_data->update(array('id' => $id),array('viewed'=>$view+1));
    }
    private function _updateLastViewed($id){
        $key = 'last_viewed';
        $data = get_cookie($key);
        if(!empty($data)){
            $data = json_decode($data, true);
            array_push($data,$id);
            $data = array_unique($data);
            set_cookie($key, json_encode($data), 0);
        }else {
            set_cookie($key, json_encode([$id]), 0);
        }
    }
    public function ajax_get_detail(){
        $this->checkRequestPostAjax();
        if($this->session->userdata('is_agency') == true){
            $productId = $this->input->post('id');
            $quantity = $this->input->post('quantity');
            $data = $this->_data->getPriceAgency($productId,$quantity);
            $this->returnJson(['price' => $data->price_agency]);
        }
        $this->returnJson(['price' => 0]);
    }
    public function ajax_load_list(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $cateId = $this->input->post('id');
            $this->_data_category->_recursive_child_id($this->_data_category->_all_category(), $cateId);
            $listCateId = $this->_data_category->_list_category_child_id;
            $params = [
                'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
                'lang_code' => $this->session->public_lang_code,
                'limit' => 8,
                'category_id' => $listCateId
            ];
            $data['ajax_data'] = $this->_data->getData($params);
            print $this->load->view($this->template_path . 'product/_load_list_product', $data, TRUE);
        }
        exit;
    }

    public function ajax_load_collection(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if($this->session->is_logged != true){
                $message['type'] = 'error';
                $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
                echo json_encode($message);exit;
            }
            $this->load->model('account_model');
            $accountModel = new Account_model();
            $accountId = $this->session->userdata('account')['account_id'];
            $data['product_id'] = $this->input->post('product_id');
            $listCollection = $accountModel->getCollectionByUser($accountId);
            if(empty($listCollection)){
                $data_store = array(
                    'title' => 'Bộ sưu tập mặc định',
                    'account_id' => $accountId
                );
                if(!$accountModel->insert($data_store, $accountModel->table_collection)){
                    $message['type'] = 'error';
                    $message['message'] = "Lỗi không thêm được bộ sưu tập !";
                    echo json_encode($message);exit;
                };
                $listCollection = $accountModel->getCollectionByUser($accountId);
            }
            $data['data'] = $listCollection;
            $message['type'] = 'success';
            $message['content'] = $this->load->view($this->template_path . 'product/_ajax_load_collection', $data, TRUE);
            echo json_encode($message);
        }
        exit;
    }

    public function ajax_save_favourite(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if($this->session->is_logged != true){
                $message['type'] = 'error';
                $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
                echo json_encode($message);exit;
            }
            $this->load->model('account_model');
            $accountModel = new Account_model();
            $data['account_id'] = $this->session->userdata('account')['account_id'];
            $data['product_id'] = $this->input->post('product_id');
            if($accountModel->save($data, $accountModel->table_collection)){
                $message['type'] = 'success';
                $message['message'] = "Bạn vừa thêm ";
                echo json_encode($message);exit;
            }
        }
        exit;
    }

    public function ajax_add_collection(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if($this->session->is_logged != true){
                $message['type'] = 'error';
                $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
                echo json_encode($message);exit;
            }
            $rules = array(
                array(
                    'field' => 'title',
                    'label' => 'tên bộ sưu tập',
                    'rules' => 'required|trim|max_length[150]'
                )
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                $this->load->model('account_model');
                $accountModel = new Account_model();
                $data['account_id'] = $this->session->userdata('account')['account_id'];
                $data['title'] = $this->input->post('title');
                if ($accountModel->insert($data, $accountModel->table_collection)) {
                    $message['type'] = 'success';
                    $message['message'] = "Bạn vừa thêm bộ sưu tập \"{$data['title']}\" thành công !";
                    echo json_encode($message);
                    exit;
                }
            }else{
                $message['type'] = "warning";
                $message['message'] = $this->lang->line('mess_validation');
                $valid = array();
                if(!empty($rules)) foreach ($rules as $item){
                    if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
                }
                $message['validation'] = $valid;
                die(json_encode($message));
            }
        }
        exit;
    }

    public function ajax_action_collection(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if($this->session->is_logged != true){
                $message['type'] = 'error';
                $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
                echo json_encode($message);exit;
            }
            //THêm và xóa product khỏi collectio account
            $this->load->model('account_model');
            $accountModel = new Account_model();
            $action = $this->input->post('action');
            $accountId = $this->session->userdata('account')['account_id'];
            $productId = $this->input->post('product_id');
            $collectionId = $this->input->post('collection_id');
            if($action === 'add'){
                $data_store = array(
                    'account_id' => $accountId,
                    'product_id' => $productId,
                    'collection_id' => $collectionId
                );
                if($accountModel->insert($data_store, $accountModel->table_account_collection)){
                    $message['type'] = 'success';
                    $message['message'] = "Bạn đã thêm ảnh vào mục yêu thích thành công !";
                    echo json_encode($message);exit;
                }else{
                    $message['type'] = 'error';
                    $message['message'] = "Lỗi không thêm được ảnh vào mục yêu thích !";
                    echo json_encode($message);exit;
                }
            }
            if($action === 'remove'){
                $condition = array(
                    'account_id' => $accountId,
                    'product_id' => $productId,
                    'collection_id' => $collectionId
                );
                if($accountModel->delete($condition, $accountModel->table_account_collection)){
                    $message['type'] = 'success';
                    $message['message'] = "Bạn xóa ảnh khỏi mục yêu thích thành công !";
                    echo json_encode($message);exit;
                }else{
                    $message['type'] = 'error';
                    $message['message'] = "Lỗi không xóa được ảnh khỏi mục yêu thích !";
                    echo json_encode($message);exit;
                }
            }

        }
        exit;
    }

    public function ajax_remove_product_collection()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if ($this->session->is_logged != true) {
                $message['type'] = 'error';
                $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
                echo json_encode($message);
                exit;
            }
        }
        exit;
    }

    public function ajax_category_load($type = null){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('category_model');
            $categoryModel = new Category_model();
            $term = $this->input->get("q");
            $params = [
                'category_type' => $type,
                'is_status'=> 1,
                'search' => $term,
                'limit'=> 1000
            ];
            $list = $categoryModel->getData($params);
            $this->_queue_select($list, 0);
            $json = [];
            if(!empty($this->category_tree)) foreach ($this->category_tree as $item) {
                $item = (object) $item;
                $json[] = ['id'=>$item->id, 'text'=>$item->title];
            }
            print json_encode($json);
        }
        exit;
    }

    public function ajax_property_load($type = null){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('property_model');
            $propertyModel = new Property_model();
            $term = $this->input->get("q");
            $category_id = $this->input->get('category_id');
            $oneParent = $this->_data_category->_recursive_one_parent($this->_data_category->_all_category(),$category_id);

            $params = [
                'property_type' => $type,
                'category_id' => !empty($oneParent->id) ? $oneParent->id : 0,
                'is_status'=> 1,
                'search' => $term,
                'limit'=> 100
            ];
            $list = $propertyModel->getData($params);
            $json = [];
            if(!empty($list)) foreach ($list as $item) {
                $item = (object) $item;
                $json[] = ['id'=>$item->id, 'text'=>$item->title];
            }
            print json_encode($json);
        }
        exit;
    }

}
