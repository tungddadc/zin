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
            $params['is_status'] = 1;
            $params['lang_code'] = $this->_lang_code;
            $params['in'] = $listProductId;
            $params['limit'] = 10;
            $data['data'] = $this->_data->getData($params);
        }

        $data['main_content'] = $this->load->view($this->template_path . 'product/wishlist', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function compare(){
        $key = 'product_compare';
        $dataId = get_cookie($key);
        $listProductId = json_decode($dataId, true);
        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['in'] = $listProductId;
        $params['limit'] = 10;
        $data['data'] = $this->_data->getData($params);
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
        $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_data_category->_all_category(),$data['oneCategory']->id);
        if(!empty($data['oneParent'])){
            $data['list_category_child'] = $this->_data_category->getCategoryChild($data['oneParent']->id,$this->session->public_lang_code);
        }
        $data['oneItem'] = $oneItem;
        $data['onePrev'] = $this->_data->getPrevById($oneItem->id,'',$this->_lang_code);
        $data['oneNext'] = $this->_data->getNextById($oneItem->id,'',$this->_lang_code);
        $data['data_detail'] = $this->_data->getDetail($id);
        if(!empty($oneItem->data_similar)){
            $listIdSimilar = json_decode($oneItem->data_similar);
            $data['data_similar'] = $this->_data->getData(['in' => $listIdSimilar,'limit' => 5]);
        }
        if(!empty($oneItem->data_related)){
            $listIdRelated = json_decode($oneItem->data_related);
            $data['data_related'] = $this->_data->getData(['in' => $listIdRelated,'limit' => 5]);
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
    public function ajax_load_comment(){
        $this->checkRequestPostAjax();
        $productId = $this->input->post('product_id');
        $page = $this->input->post('page');
        $limit = 5;
        $params = [
            'is_status' => 1,
            'product_id' => $productId,
            'limit' => $limit,
            'page' => $page
        ];
        $this->load->model('comments_model');
        $commentModel = new Comments_model();
        $data['data'] = $commentModel->getData($params);
        print $this->load->view($this->template_path . 'product/_ajax_load_comment', $data, TRUE);
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
        $data['name'] = $this->input->post('name') ? $this->input->post('name') : $this->session->userdata('username');
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
            'account_id' => $this->session->userdata('user_id'),
            'product_id' => $this->input->post('product_id')
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

    public function ajax_action_compare(){
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

    public function ajax_remove_product_compare()
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

}
