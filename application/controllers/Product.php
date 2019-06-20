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
        $this->load->model('property_model');
        $propertyModel = new Property_model();
        $allPropertyType = $propertyModel->getDataGroupBy();
        if(!empty($allPropertyType)) foreach ($allPropertyType as $item){
            $data['data_property'][$item['type']] = $propertyModel->_all_property($item['type']);
        }
        $paramsProperty = [];
        if(!empty($allPropertyType)) foreach ($allPropertyType as $item){
            $itemType = 'filter_'.$item['type'];
            if($this->input->get($itemType) !== null) array_push($paramsProperty,$this->input->get($itemType));
        }
        $paramsFilter['property_id'] = $paramsProperty;

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
            redirect(getUrlBrand(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }

        $data['oneItem'] = $oneItem;

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
            'brand_id' => $id,
            'limit' => $limit,
            'page' => $page
        ];
        if(!empty($paramsFilter)) $params = array_merge($params,$paramsFilter);
        $data['data'] = $this->_data->getData($params);
        $data['total'] = $this->_data->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlBrand(['slug' => $oneItem->slug, 'id' => $oneItem->id, 'page' => 1]);
        $paging['first_url'] = getUrlBrand(['slug' => $oneItem->slug, 'id' => $oneItem->id]);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        /*Pagination*/

        //add breadcrumbs
        $this->breadcrumbs->push("Trang chủ", base_url());
        $this->breadcrumbs->push($oneItem->title, getUrlBrand($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlBrand($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];

        $data['main_content'] = $this->load->view($this->template_path . 'product/category', $data, TRUE);
        $this->load->view($this->template_main, $data);

    }

    public function wishlist(){
        $data = [];
        if($this->session->userdata('is_logged') == true){
            $this->load->model('users_model');
            $userModel = new Users_model();
            $dataId = $userModel->getDataIdFavourite($this->session->userdata('user_id'));
            $listProductId = [];
            if(!empty($dataId)) foreach ($dataId as $item){
                $listProductId[] = $item->product_id;
            }
            if(!empty($listProductId)){
                $params['is_status'] = 1;
                $params['lang_code'] = $this->_lang_code;
                $params['in'] = $listProductId;
                $params['limit'] = 10;
                $data['data'] = $this->_data->getData($params);
            }
        }

        $data['main_content'] = $this->load->view($this->template_path . 'product/wishlist', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function compare(){
        $key = 'product_compare';
        $dataId = get_cookie($key);
        $listProductId = json_decode($dataId, true);
        $data = [];
        if(!empty($listProductId)){
            $params['is_status'] = 1;
            $params['lang_code'] = $this->_lang_code;
            $params['in'] = $listProductId;
            $params['limit'] = 10;
            $data['data'] = $this->_data->getData($params);
        }
        $data['main_content'] = $this->load->view($this->template_path . 'product/compare', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function detail($slug){
        $oneItem = $this->_data->getBySlugCustom($slug,$this->_lang_code);
        if (empty($oneItem)) show_404();
        $id = $oneItem->id;
        $this->flushView($id,$oneItem->viewed);
        //Check xem co chuyen lang hay khong thi redirect ve lang moi
        if ($this->input->get('lang')) {
            redirect(getUrlProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }

        $data['oneCategory'] = $oneCategory = $this->_data->getOneCateIdById($id);
        if(!empty($oneCategory)){
            $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_data_category->_all_category(),$oneCategory->id);
            if(!empty($data['oneParent'])){
                $data['list_category_child'] = $this->_data_category->getCategoryChild($data['oneParent']->id,$this->session->public_lang_code);
            }
        }
        $data['oneItem'] = $oneItem;
        $data['onePrev'] = $this->_data->getPrevById($oneItem->id,'',$this->_lang_code);
        $data['oneNext'] = $this->_data->getNextById($oneItem->id,'',$this->_lang_code);
        $data['data_detail'] = $this->_data->getDetail($id);
        if(!empty($oneItem->barcode))
            $data['data_stock'] = $this->getStockApi($oneItem->barcode);


        if(!empty($oneItem->data_similar)){
            $listIdSimilar = json_decode($oneItem->data_similar);
            $data['data_similar'] = $this->_data->getData(['in' => $listIdSimilar,'limit' => 5]);
        }else{
            $keySimilar = str_replace('-','',substr($oneItem->title,0,15));
            $data['data_similar'] = $this->_data->getData(['search_similar' => $keySimilar,'limit' => 5]);
        }



        if(!empty($oneItem->data_related)){
            $listIdRelated = json_decode($oneItem->data_related);
            $data['data_related'] = $this->_data->getData(['in' => $listIdRelated,'limit' => 5]);
        }else{
            $data['data_related'] = $this->_data->getData(['search_similar' => $oneItem->title,'limit' => 5]);
        }

        $data['oneBrand'] = $this->_data_category->getByIdCached((int)$oneItem->brand);
        $this->load->model('vote_model');
        $voteModel = new Vote_model();
        $data['data_vote'] = $voteModel->getVoteById($id);

        /*List product related*/
        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['not_in'] = $id;
        $params['brand_id'] = $oneItem->brand;
        $params['limit'] = 8;
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
        if(!empty($oneCategory)) {
            $this->_data_category->_recursive_parent($this->_data_category->_all_category(), $oneCategory->id);
            if (!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item) {
                $this->breadcrumbs->push($item->title, getUrlCateProduct($item));
            }
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
    public function ajax_load_comment(){
        $this->checkRequestPostAjax();
        $productId = $this->input->post('product_id');
        $page = $this->input->post('page');
        $limit = 5;
        $params = [
            'is_status' => 1,
          'type'=>'product',
            'product_id' => $productId,
            'limit' => $limit,
            'page' => $page
        ];
        $this->load->model('comments_model');
        $commentModel = new Comments_model();
        $listData = $commentModel->getData($params);
        $data['data'] = $commentModel->_recursive($listData,0);
        print $this->load->view($this->template_path . 'product/_ajax_load_comment', $data, TRUE);
    }

    public function ajax_save_comment(){
        $this->checkRequestPostAjax();
        if($this->session->userdata('is_logged') != true){
            $message['type'] = 'error';
            $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
            $this->returnJson($message);
        }

        $rules = array(
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'name',
                'label' => 'Tên',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'content',
                'label' => 'Nội dung',
                'rules' => 'required|trim'
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() != false) {
            $data = $this->input->post();
            if (!empty($data['parent_id'])) $data['is_status'] = 1;
          $data['type']='product';
            if (!empty($data)) {
                $this->load->model('comments_model');
                $commentModel = new Comments_model();
                if ($commentModel->save($data)) {
                    $message['type'] = 'success';
                    $message['message'] = "Bạn vừa bình luận thành công.";
                } else {
                    $message['type'] = 'error';
                    $message['message'] = "Lỗi không bình luận được.";
                }
                $this->returnJson($message);
            }
        }else{
            $message['type'] = "warning";
            $message['message'] = "Vui lòng kiểm tra lại thông tin";
            $valid = array();
            if(!empty($rules)) foreach ($rules as $item){
                if(form_error($item['field'])) $valid[$item['field']] = form_error($item['field']);
            }
            $message['validation'] = $valid;
            $this->returnJson($message);
        }

    }

    public function ajax_get_detail(){
        $this->checkRequestPostAjax();
        $productId = $this->input->post('id');
        $quantity = $this->input->post('quantity');
        if(!empty($this->session->userdata('user_id'))){
            $this->load->model('ion_auth_model');
            $ionAuth = new Ion_auth_model();
            $userId = $this->session->userdata('user_id');
            $oneGroup = $ionAuth->get_users_groups($userId)->result();
            if(empty($oneGroup) || $quantity < 15) return;
            $group_id = $oneGroup[0]->id;
            $oneProduct = $this->_data->getById($productId,'',$this->_lang_code);
            $price_agency = $group_id == 3 ? $oneProduct->price_agency : 0;
            $this->returnJson(['price' => $price_agency]);
        }
        $this->returnJson(['price' => 0]);
    }

    public function ajax_load_category(){
        $term = $this->input->get("q");
        $keyword = $this->input->get('id')?$this->input->get('id'):0;
        if(empty($type)) $this->session->userdata('type');
        $params = [
            'type' => !(empty($type)) ? $type : null,
            'is_status'=> 1,
            'search' => $term,
            'limit'=> 10
        ];
        $list = $this->_data->getData($params);
        $output = [];
        if(!empty($list)) foreach ($list as $item) {
            $item = (object) $item;
            $output[] = ['id'=>$item->id, 'text'=>$item->title];
        }
        $this->returnJson($output);
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
    public function ajax_vote(){
        $this->checkRequestPostAjax();
        if($this->session->userdata('is_logged') != true){
            $message['type'] = 'error';
            $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
            $this->returnJson($message);
        }
        $this->load->model('vote_model');
        $voteModel = new Vote_model();
        $data['ip_address'] = $this->input->ip_address();
        $data['vote'] = $this->input->post('vote');
        $data['id'] = $this->input->post('id');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['name'] = $this->input->post('name') ? $this->input->post('name') : $this->_user_login->fullname;
        if ($voteModel->insert($data)) {
            $message['type'] = 'success';
            $message['message'] = "Bạn vừa đánh giá {$data['vote']} sao cho sản phẩm này.";
        } else {
            $message['type'] = 'warning';
            $message['message'] = "Bạn đã đánh giá sản phẩm này rồi.";
        }
        die(json_encode($message));
    }
    public function ajax_save_wishlist(){
        $this->checkRequestPostAjax();
        if($this->session->userdata('is_logged') != true){
            $message['type'] = 'error';
            $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
            $this->returnJson($message);
        }
        $this->load->model('users_model');
        $userModel = new Users_model();
        if($userModel->saveFavourite($this->session->userdata('user_id'),$this->input->post('product_id'))){
            $message['type'] = 'success';
            $message['message'] = "Bạn vừa yêu thích sản phẩm này.";
            $this->returnJson($message);
        }else{
            $message['type'] = 'error';
            $message['message'] = "Bạn đã yêu thích sản phẩm này rồi.";
            $this->returnJson($message);
        }
    }

    public function ajax_delete_wishlist(){
        $this->checkRequestPostAjax();
        if($this->session->userdata('is_logged') != true){
            $message['type'] = 'error';
            $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
            $this->returnJson($message);
        }
        $this->load->model('users_model');
        $userModel = new Users_model();
        $params = [
            'account_id' => (int) $this->session->userdata('user_id'),
            'product_id' => (int) $this->input->post('product_id')
        ];
        if($userModel->delete($params,$userModel->table_user_favourite)){
            $message['type'] = 'success';
            $message['message'] = "Bạn vừa xóa sản phẩm khỏi yêu thích thành công.";
            $this->returnJson($message);
        }else{
            $message['type'] = 'error';
            $message['message'] = "Xóa sản phẩm khỏi yêu thích thất bại.";
            $this->returnJson($message);
        }
    }

    public function ajax_deleteAll_wishlist(){
        $this->checkRequestPostAjax();
        if($this->session->userdata('is_logged') != true){
            $message['type'] = 'error';
            $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
            $this->returnJson($message);
        }
        $this->load->model('users_model');
        $userModel = new Users_model();
        $params = [
            'account_id' => (int) $this->session->userdata('user_id'),
        ];
        if($userModel->delete($params,$userModel->table_user_favourite)){
            $message['type'] = 'success';
            $message['message'] = "Bạn vừa xóa toàn bộ sản phẩm khỏi yêu thích thành công.";
            $this->returnJson($message);
        }else{
            $message['type'] = 'error';
            $message['message'] = "Xóa toàn bộ sản phẩm khỏi yêu thích thất bại.";
            $this->returnJson($message);
        }
    }

    public function ajax_add_compare(){
        $this->checkRequestPostAjax();
        $product_id = $this->input->post('product_id');
        $key = 'product_compare';
        $data = get_cookie($key);
        if(!empty($data)){
            $data = json_decode($data, true);
            if(in_array($product_id,$data)){
                $message['type'] = 'warning';
                $message['message'] = "Bạn đã thêm sản phẩm vào so sánh rồi.";
                $this->returnJson($message);
            }
            array_push($data,$product_id);
            $data = array_unique($data);
            set_cookie($key, json_encode($data), 0);
        }else {
            set_cookie($key, json_encode([$product_id]), 0);
        }
        $message['type'] = 'success';
        $message['message'] = "Bạn vừa thêm sản phẩm này để so sánh.";
        $this->returnJson($message);
    }

    public function ajax_delete_compare(){
        $this->checkRequestPostAjax();
        $key = 'product_compare';
        $dataId = get_cookie($key);
        $dataOld = json_decode($dataId, true);
        if($dataOld){
            $productId = (int) $this->input->post('product_id');
            $dataNew = array_diff($dataOld, [$productId]);
            set_cookie($key, json_encode($dataNew), 0);
            $message['type'] = 'success';
            $message['message'] = "Bạn vừa xóa sản phẩm khỏi danh sách so sánh thành công.";
            $this->returnJson($message);
        }else{
            $message['type'] = 'error';
            $message['message'] = "Xóa sản phẩm khỏi danh sách so sánh thất bại.";
            $this->returnJson($message);
        }
    }

    public function ajax_deleteAll_compare(){
        $this->checkRequestPostAjax();
        $key = 'product_compare';
        $dataId = get_cookie($key);
        $dataOld = json_decode($dataId, true);
        if($dataOld){
            delete_cookie($key);
            $message['type'] = 'success';
            $message['message'] = "Bạn vừa xóa toàn bộ sản phẩm khỏi danh sách so sánh thành công.";
            $this->returnJson($message);
        }else{
            $message['type'] = 'error';
            $message['message'] = "Xóa toàn bộ sản phẩm khỏi danh sách so sánh thất bại.";
            $this->returnJson($message);
        }
    }

    public function syncProduct(){
        $allProduct = $this->getAllProductApi();
        if(!empty($allProduct)) foreach ($allProduct as $item){
            $item = (array) $item;
            $barcode = strtoupper(trim($item['BarCode']));
            if(empty($this->_data->checkExistByField('barcode',$barcode))){
                $data['model'] = $item['ProductCode'];
                $data['barcode'] = $item['BarCode'];
                $data['price'] = $item['Price'];
                $data['price_sale'] = $item['PriceSale'];
                $data['price_agency'] = $item['PriceAgency'];
                $data['price_kl'] = $item['PriceKL'];
                $data['price_ek'] = $item['PriceEK'];
                $data['unit'] = $item['UnitNames'];
                $data['warranty'] = $item['Warranty'];
                $data['viewed'] = rand(1000,9999);

                $resultId = $this->_data->insert($data);
                if(!empty($resultId)){
                    $data_lang['id'] = $resultId;
                    $data_lang['title'] = $item['ProductName'];
                    $data_lang['meta_title'] = $item['ProductName'];
                    $data_lang['slug'] = $this->toSlug($data_lang['title']);
                    $data_lang['language_code'] = 'vi';
                    $this->_data->insert($data_lang,$this->_data->table_trans);
                }
                echo "Result ".$barcode ." => ". $resultId . "<br>\n";
            }
            else{
                unset($data);
                unset($data_lang);
                $id = $this->_data->getIdByBarcode($barcode);
                $data['model'] = $item['ProductCode'];
                $data['price'] = $item['Price'];
                $data['price_sale'] = $item['PriceSale'];
                $data['price_agency'] = $item['PriceAgency'];
                $data['price_kl'] = $item['PriceKL'];
                $data['price_ek'] = $item['PriceEK'];
                $data['unit'] = $item['UnitNames'];
                $data['warranty'] = $item['Warranty'];
                $data_lang['title'] = $item['ProductName'];
                //$data_lang['meta_title'] = $item['ProductName'];

                $this->_data->update(['barcode' => $barcode],$data);
                $result = $this->_data->update(['id' => $id,'language_code' => 'vi'],$data_lang,$this->_data->table_trans);
                echo "Update Result translate".$barcode ." => ". $result . "<br>\n";
            }
        }
        die('ok');
    }

    public function importExcel(){
        $this->load->library('PHPExcel');
        $filename = FCPATH . 'database/DSSP-2018-12-30-a.xlsx';
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load("$filename");

        $total_sheets = $objPHPExcel->getSheetCount();

        $allSheetName = $objPHPExcel->getSheetNames();
        $objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow    = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $arraydata = array();
        for ($row = 2; $row <= $highestRow;++$row)
        {
            for ($col = 0; $col <$highestColumnIndex;++$col)
            {
                $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arraydata[$row-2][$col]=$value;
            }
        }
        //$total = count($arraydata);
        if(!empty($arraydata)) foreach ($arraydata as $item){
            if(!empty($item[3])){
                $id = (int)$item[0];
                unset($data);
                unset($data_lang);
                if(!empty($id)){
                    $data['id'] = $id;
                    $data['barcode'] = $item[1];
                    $data['model'] = $item[2];
                    //$data['thumbnail'] = $item[5];
                    //$data['album'] = $item[7];
                    $result = $this->_data->update(['id' => $id],$data);
                    echo "Update Result ".$data['barcode'] ." => ". $result . "<br>\n";
                }else{
                    $data['barcode'] = $item[1];
                    $data['model'] = $item[2];
                    $data['thumbnail'] = $item[5];
                    //$data['album'] = $item[7];
                    $data['viewed'] = rand(1000,9999);
                    $resultId = $this->_data->insert($data);
                    if(!empty($resultId)){
                        $data_lang['id'] = $resultId;
                        $data_lang['title'] = $item[3];
                        $data_lang['meta_title'] = $item[3];
                        $slug = str_replace('https://zinlinhkien.com.vn/','',$item[4]);
                        $data_lang['slug'] = !empty($slug) ? $slug : $this->toSlug($data_lang['title']);
                        $data_lang['language_code'] = 'vi';
                        $this->_data->insert($data_lang,$this->_data->table_trans);
                    }
                    echo "Result ".$data['barcode'] ." => ". $resultId . "<br>\n";
                }
            }

        }
        exit;
    }


    private function getStockApi($barcode){
        $api = "http://112.213.91.39:81/api/Stock?barcode=$barcode";
        $data = $this->cUrl($api);
        return json_decode($data);
    }

    private function getAllProductApi(){
        $api = "http://112.213.91.39:81/api/Stock/GetAllProducts";
        $data = $this->cUrl($api);
        return json_decode($data);
    }

}
