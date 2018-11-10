<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Public_Controller
{
    protected $cid = 0;
    protected $_data;
    protected $_data_category;
    protected $_all_category;
    protected $category_tree;
    protected $_lang_code;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['category_model', 'product_model']);
        $this->_data = new Product_model();
        $this->_data_category = new Category_model();
        $this->_all_category = $this->_data_category->_all_category('product');
        $this->_lang_code = $this->session->userdata('public_lang_code');
    }

    public function category($id, $page = 1){
        $oneItem = $this->_data_category->getByIdCached($id);
        if (empty($oneItem)) show_404();

        if ($this->input->get('lang')) {
            redirect(getUrlCateProduct(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }

        $data['oneItem'] = $oneItem;
        $data['oneParent'] = $oneParent = $this->_data_category->_recursive_one_parent($this->_all_category,$id);
        /*$this->_data_category->_recursive_child($this->_all_category,$oneParent->id);
        $listCateChild = $this->_data_category->_list_category_child;*/
        /*Get level category*/
        $this->_data_category->_recursive_parent($this->_all_category, $oneItem->id);

        $data['list_category_child'] = $this->_data_category->getListChild($this->_all_category, $id);

        /*Lay list id con của category*/
        $this->_data_category->_list_category_child_id = null;
        $this->_data_category->_recursive_child_id($this->_all_category,$id);
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

        if(!empty($this->input->get('filter_format'))) $paramsFilter['filter_format'] = $this->input->get('filter_format');
        if(!empty($this->input->get('filter_color'))) $paramsFilter['filter_color'] = $this->input->get('filter_color');
        if(!empty($this->input->get('filter_type'))) $paramsFilter['filter_type'] = $this->input->get('filter_type');
        if(!empty($this->input->get('filter_genre'))) $paramsFilter['filter_genre'] = $this->input->get('filter_genre');

        switch ($this->input->get('filter_sort')) {
            case 'most_download':
                $paramsFilter['order'] = ['total_download' => 'DESC'];
                break;
            case 'most_favourite':
                $paramsFilter['order'] = ['total_favourite' => 'DESC'];
                break;
            default:
                $paramsFilter['order'] = ['created_time' => 'DESC'];
        }

        $limit = $data['limit'] = 36;
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
        $this->_data_category->_recursive_parent($this->_all_category, $id);
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
        $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_all_category,$data['oneCategory']->id);
        if(!empty($data['oneParent'])){
            $data['list_category_child'] = $this->_data_category->getCategoryChild($data['oneParent']->id,$this->session->public_lang_code);
        }
        $data['oneItem'] = $oneItem;


        $this->load->model('property_model');
        $propertyModel = new Property_model();
        if(!$this->cache->get('_all_property_'.$this->session->public_lang_code)){
            $this->cache->save('_all_property_'.$this->session->public_lang_code,$propertyModel->getAll($this->session->public_lang_code),60*60*30);
        }
        $_all_property = $this->cache->get('_all_property_'.$this->session->public_lang_code);
        $data['property_reason'] = $propertyModel->getDataByPropertyType($_all_property,'reason');


        /*List product related*/
        $this->_data_category->_recursive_child_id($this->_all_category,$oneCategoryParent->id);
        $listCateId = $this->_data_category->_list_category_child_id;
        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['not_in'] = $id;
        $params['limit'] = 8;
        $params['category_id'] = $listCateId;
        $data['list_related'] = $this->_data->getData($params);
        /*List product related*/


        //add breadcrumbs
        $this->breadcrumbs->push("Trang chủ", base_url());
        $this->_data_category->_recursive_parent($this->_all_category, $oneCategory->id);
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

    public function ajax_load_list(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $cateId = $this->input->post('id');
            $this->_data_category->_recursive_child_id($this->_all_category, $cateId);
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

    public function upload(){
        if($this->session->is_logged != true) redirect();
        $this->ajax_upload_product();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => "Upload file để kiếm tiền",
            'meta_description' => "Upload file để kiếm tiền",
            'meta_keyword' => "Upload file để kiếm tiền",
            'url' => current_url(),
            'image' => getImageThumb('', 400, 200)
        ];

        $data['main_content'] = $this->load->view($this->template_path . 'product/upload_product', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function edit($id)
    {
        if($this->session->is_logged != true) redirect();
        $this->ajax_upload_product();
        $data['oneItem'] = $this->_data->getById($id,'', $this->_lang_code);
        $data['data_category'] = $this->_data->getCategorySelect2($id);
        $data['data_property_tags'] = $this->_data->getTagsSelect2($id);
        $data['data_property_color'] = $this->_data->getPropertySelect2($id,'color');
        $data['data_property_color_mode'] = $this->_data->getPropertySelect2($id,'color_mode');
        $data['data_property_format'] = $this->_data->getPropertySelect2($id,'format');
        $data['data_property_type'] = $this->_data->getPropertySelect2($id,'type');
        $data['data_property_genre'] = $this->_data->getPropertySelect2($id,'genre');
        $data['main_content'] = $this->load->view($this->template_path . 'product/edit_product', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    private function ajax_upload_product(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $rules = array(
                array(
                    'field' => 'title[vi]',
                    'label' => 'Tiêu đề',
                    'rules' => 'required|trim'
                ),

                array(
                    'field' => 'description[vi]',
                    'label' => 'Mô tả ngắn',
                    'rules' => 'required|trim'
                ),
                /*array(
                    'field' => 'content[vi]',
                    'label' => 'Nội dung',
                    'rules' => 'required|trim'
                ),*/
                array(
                    'field' => 'url_download',
                    'label' => 'File',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'capacity',
                    'label' => 'Dung lượng file',
                    'rules' => 'required|trim'
                ),
                /*array(
                    'field' => 'size',
                    'label' => 'Kích thước độ phân giải',
                    'rules' => 'required|trim'
                ),*/
                array(
                    'field' => 'thumbnail',
                    'label' => 'Ảnh đại diện',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'category_id[]',
                    'label' => 'Chủ đề',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'property[genre][]',
                    'label' => 'Thể loại',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'property[type]',
                    'label' => 'Loại file',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'property[format]',
                    'label' => 'Định dạng file',
                    'rules' => 'required|trim'
                ),

                array(
                    'field' => 'property[color][]',
                    'label' => 'Màu sắc',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'property[color_mode]',
                    'label' => 'Chế độ màu',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'property[color_mode]',
                    'label' => 'Chế độ màu',
                    'rules' => 'required|trim'
                ),

            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                $dataStore = $this->_convertData();
                $this->load->model('account_model');
                $accountModel = new Account_model();

                if(!$accountModel->checkRegisterMakeMoney($this->session->userdata('account')['account_id'])){
                    unset($dataStore['price']);
                }

                if(!empty($dataStore['id'])){
                    $productId = $dataStore['id'];
                    unset($dataStore['id']);
                    //Up file lên gg drive
                    if(empty($this->encrypt_decrypt('decrypt',$dataStore['url_download']))){ //Check xem file có sửa thành file khác ko. Nếu là đường dẫn thì là có thay đổi
                        $dataStore['url_download'] = $this->uploadToGoogle($dataStore['url_download'],$this->toSlug($dataStore['title'][$this->session->public_lang_code]));
                    }
                    if ($this->_data->update(['id' => $productId],$dataStore)) {
                        $message['type'] = 'success';
                        $message['message'] = "Bạn đã sửa thành công !";
                    } else {
                        $message['type'] = 'error';
                        $message['message'] = "Sửa bài thất bại ! Vui lòng liên hệ báo cáo với ban quản trị.";
                    }
                }else{
                    //Up file lên gg drive
                    $dataStore['url_download'] = $this->uploadToGoogle($dataStore['url_download'],$this->toSlug($dataStore['title'][$this->session->public_lang_code]));
                    if ($this->_data->save($dataStore)) {
                        $message['type'] = 'success';
                        $message['message'] = "Bạn đã đăng thành công. Vui lòng chờ BQT duyệt !";
                    } else {
                        $message['type'] = 'error';
                        $message['message'] = "Đăng bài thất bại !";
                    }
                }

                die(json_encode($message));
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


    public function ajax_download_product(){
        if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('account_model');
            $accountModel = new Account_model();
            $productId = $this->input->post('product_id');
            $oneProduct = $this->_data->getById($productId, "{$this->_data->table}.url_download", $this->session->public_lang_code);

            $urlDownload = getUrlDownload($oneProduct->url_download);
            $settingLimitDownloadFree = $this->settings['config']['limit_download_free'];
            if($this->session->is_logged == true){
                $accountId = $this->session->userdata('account')['account_id'];
                $oneAccount = $accountModel->getUserByField('id',$accountId);
                $ipAddress = $this->input->ip_address();
                if(isset($oneAccount->is_vip) && $oneAccount->is_vip == true){
                    $message['type'] = 'success';
                    $message['message'] = 'Đây là tài khoản VIP download trực tiếp !';
                    $message['url_download'] = $urlDownload;
                    $accountModel->logDownload($ipAddress, $productId, $accountId);
                    echo json_encode($message);exit;
                }else{
                    $countLimitDownload = $accountModel->getCountDownloadByIp($ipAddress);
                    if($countLimitDownload >= $settingLimitDownloadFree){
                        $message['type'] = 'error';
                        $message['message'] = "Bạn đã quá giới hạn download $settingLimitDownloadFree lần / ngày / ip.";
                        echo json_encode($message);exit;
                    }
                    $accountModel->logDownload($ipAddress, $productId, $accountId);
                    $message['type'] = 'success';
                    $message['message'] = 'Đây là tài khoản thường download free !';
                    $message['url_download'] = $this->getShortUrl($urlDownload);
                    echo json_encode($message);exit;
                }
            }else{
                $message['type'] = 'warning';
                $message['message'] = "Bạn phải đăng nhập mới được tải !";
                echo json_encode($message);exit;
            }

        }
        exit;
    }

    private function getShortUrl($url){
        $long_url = urlencode($url);
        $api_token = '0d61bdcbd5bd3c8d30d49154034b98c24e7de606';
        $api_url = "https://megaurl.in/api?api={$api_token}&url={$long_url}";
        $result = @json_decode(file_get_contents($api_url),TRUE);
        if($result["status"] === 'error') {
            return $result["message"];
        } else {
            return $result["shortenedUrl"];
        }
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
            $oneParent = $this->_data_category->_recursive_one_parent($this->_all_category,$category_id);

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

    public function ajax_tag_load(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('tag_model');
            $tagModel = new Tag_model();
            $term = $this->input->get("q");
            $params = [
                'is_status'=> 1,
                'search' => $term,
                'limit'=> 100
            ];
            $list = $tagModel->getData($params);
            $json = [];
            if(!empty($list)) foreach ($list as $item) {
                $item = (object) $item;
                $json[] = ['id'=>$item->id, 'text'=>$item->title];
            }
            print json_encode($json);
        }
        exit;
    }
    private function _queue_select($categories, $parent_id = 0, $char = ''){
        foreach ($categories as $key => $item)
        {
            if ($item->parent_id == $parent_id)
            {
                $tmp['title'] = $parent_id ? '  |--'.$char.$item->title : $char.$item->title;
                $tmp['id'] = $item->id;
                $tmp['thumbnail'] = $item->thumbnail;
                $this->category_tree[] = $tmp;
                unset($categories[$key]);
                $this->_queue_select($categories,$item->id,$char.'--');
            }
        }
    }

    public function ajax_report(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('report_model');
            $reportModel = new Report_model();

            if($reportModel->insert($this->input->post())){
                $message['type'] = 'success';
                $message['message'] = "Bạn đã báo cáo thành công !";
                echo json_encode($message);exit;
            }else{
                $message['type'] = 'error';
                $message['message'] = "Bạn đã báo cáo không thành công !";
                echo json_encode($message);exit;
            }
        }
        exit;
    }

    private function uploadToGoogle($filePathFull){
        $arrPath = explode('/',$filePathFull);
        $this->load->library('google_drive');
        $ggDrive = new Google_drive();
        $fileName = end($arrPath);
        $filePath = MEDIA_PATH . str_replace($fileName,'',$filePathFull);
        $file = $ggDrive->upload($filePath, $fileName);
        if($file->id){
            unlink($filePath.$fileName);
        }
        return $this->encrypt_decrypt('encrypt',$file->id);
    }

    public function ajax_upload_google_drive(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->library('google_drive');
            $ggDrive = new Google_drive();
            $filePath = MEDIA_PATH . $this->input->post('path');
            $fileName = $this->input->post('files');
            $file = $ggDrive->upload($filePath, $fileName);
            if($file->id){
                unlink($filePath.$fileName);
            }
            echo json_encode([
                'id' => $this->encrypt_decrypt('encrypt',$file->id)
            ]);
        }
        exit;
    }

    public function google_drive_delete_file($fileId){
        $this->load->library('google_drive');
        $ggDrive = new Google_drive();
        return $ggDrive->deleteFile($fileId);
    }
    /*
     * Kiêm tra thông tin post lên
     * */

    private function _convertData(){
        //$this->_validate();
        $data = $this->input->post();
        $data_store = array();
        $arrLang = $this->config->item('cms_language');
        if (!empty($data)) foreach ($data as $key => $item) {
            if (is_array($item)){
                $keyLang = array_keys($item);
                if(!empty($keyLang[0]) && in_array($keyLang[0],array_keys($arrLang) )) foreach ($arrLang as $lang_code => $lang_name) {
                    if (in_array($key, array('content_more', 'content_tab')))
                        $data_store[$key][$lang_code] = !empty($item[$lang_code]) ? json_encode($item[$lang_code]) : '';
                    else
                        $data_store[$key][$lang_code] = trim($item[$lang_code]);
                }else $data_store[$key] = json_encode($item);
            } else {
                $data_store[$key] = $item;
            }
        }
        $data_store['meta_title']['vi'] = $data_store['title']['vi'];
        $data_store['slug']['vi'] = $this->toSlug($data_store['title']['vi']);
        $data_store['meta_description']['vi'] = $data_store['description']['vi'];
        if(isset($data['category_id'])) $data_store['category_id'] = $data['category_id'];
        if(isset($data['property'])) $data_store['property'] = $data['property'];
        if(isset($data['tags'])) $data_store['tags'] = $data['tags'];
        $data_store['is_status'] = 2;
        $data_store['account_id'] = $this->session->userdata('account')['account_id'];
        return $data_store;
    }

    public function download(){
        $idEncode = $this->input->get('hash',FALSE);
        if(!empty($idEncode)){
            $idDecode = $this->encrypt_decrypt('decrypt',$idEncode);
            $this->load->library('google_drive');
            $this->load->helper('download');
            $ggDrive = new Google_drive();
            $oneFile = $ggDrive->getFile($idDecode);
            if(empty($oneFile)){
                $message['type'] = 'error';
                $message['message'] = 'Lỗi file không tồn tại !';
                $this->session->set_flashdata('message',$message);
                redirect(base_url());
            }
            $contentDownload = $ggDrive->downloadFile($idDecode);
            force_download($oneFile->getName(),$contentDownload, $oneFile->getMimeType());
        }
        exit;
    }

}
