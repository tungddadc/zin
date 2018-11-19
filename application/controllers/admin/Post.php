<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends Admin_Controller
{
    protected $_data;
    protected $_data_category;

    const STATUS_CANCEL = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;
    public function __construct()
    {
        parent::__construct();
        //tải thư viện
        //$this->lang->load('category');
        $this->load->model(['category_model','post_model']);
        $this->_data = new Post_model();
        $this->_data_category = new Category_model();
    }

    public function index(){
        $data['heading_title'] = "Quản lý bài viết";
        $data['heading_description'] = "Danh sách bài viết";
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . 'index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function ajax_list(){
        $this->checkRequestPostAjax();
        $data = array();
        $pagination = $this->input->post('pagination');
        $page = $pagination['page'];
        $total_page = isset($pagination['pages']) ? $pagination['pages'] : 1;
        $limit = !empty($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 1;

        $queryFilter = $this->input->post('query');
        $params = [
            'category_id'   => !empty($queryFilter['category_id']) ? $queryFilter['category_id'] : '',
            'type'          => $this->session->userdata('type'),
            'page'          => $page,
            'limit'         => $limit
        ];
        if(isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
            $params = array_merge($params,['is_status' => $queryFilter['is_status']]);

        $listData = $this->_data->getData($params);
        if(!empty($listData)) foreach ($listData as $item) {
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['title'] = $item->title;
            $row['is_featured'] = $item->is_featured;
            $row['is_status'] = $item->is_status;
            $row['updated_time'] = $item->updated_time;
            $row['created_time'] = $item->created_time;
            $data[] = $row;
        }

        $output = [
            "meta" => [
                "page"      => $page,
                "pages"     => $total_page,
                "perpage"   => $limit,
                "total"     => $this->_data->getTotal(),
                "sort"      => "asc",
                "field"     => "id"
            ],
            "data" =>  $data
        ];

        $this->returnJson($output);
    }

    public function ajax_load(){
        $term = $this->input->get("q");
        $id = $this->input->get('id')?$this->input->get('id'):0;
        $params = [
            'is_status'=> 1,
            'not_in' => ['id' => $id],
            'search' => $term,
            'limit'=> 10
        ];
        $data = $this->_data->getData($params);
        $output = [];
        if(!empty($data)) foreach ($data as $item) {
            $output[] = ['id'=>$item->id, 'text'=>$item->title];
        }
        $this->returnJson($output);
    }

    private function save_language($id, $data){
        if(!empty($data)) foreach ($data as $lang_code => $item){
            $data_trans = array_merge($item,['id'=>$id,'language_code' => $lang_code]);
            if(!$this->_data->insertOnUpdate($data_trans, $this->_data->table_trans)){
                $message['type'] = 'error';
                $message['message'] = "Thêm {$this->_data->table_trans} thất bại !";
                log_message('error', $message['message'] . '=>' . json_encode($data_trans));
                $this->returnJson($message);
            }
        }
    }

    private function save_category($id, $data){
        if(!empty($data)) foreach ($data as $category_id){
            $data_category = ["{$this->_data->table}_id" => $id, 'category_id' => $category_id];
            if(!$this->_data->insertOnUpdate($data_category, $this->_data->table_category)){
                $message['type'] = 'error';
                $message['message'] = "Thêm {$this->_data->table_category} thất bại !";
                log_message('error', $message['message'] . '=>' . json_encode($data_category));
                $this->returnJson($message);
            }
        }
    }
    public function ajax_add(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $data['viewed'] = rand(1000,9999);
        $data_trans = $data['language'];
        $data_category = $data['category_id'];
        unset($data['language']);
        unset($data['category_id']);
        if($id = $this->_data->save($data)){
            $this->save_language($id, $data_trans);
            $this->save_category($id, $data_category);
            $message['type'] = 'success';
            $message['message'] = "Thêm mới thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Thêm mới thất bại !";
        }
        $this->returnJson($message);
    }

    public function ajax_edit(){
        $this->checkRequestPostAjax();
        $id = $this->input->post('id');
        if(!empty($id)){
            $output['data_info'] = $this->_data->single(['id' => $id],$this->_data->table);
            $output['data_language'] = $this->_data->getDataAll(['id' => $id],$this->_data->table_trans);
            $output['data_category'] = $this->_data->getSelect2Category($id, $this->session->userdata('admin_lang'));
            $this->returnJson($output);
        }
    }

    public function ajax_update(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $id = $data['id'];
        $data_trans = $data['language'];
        $data_category = $data['category_id'];
        unset($data['category_id']);
        unset($data['language']);
        if($this->_data->update(['id' => $id],$data, $this->_data->table)){
            $this->save_language($id, $data_trans);
            $this->save_category($id, $data_category);
            $message['type'] = 'success';
            $message['message'] = "Cập nhật thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Cập nhật thất bại !";
        }
        $this->returnJson($message);
    }

    public function ajax_update_field(){
        $this->checkRequestPostAjax();
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        $response = $this->_data->update(['id' => $id], [$field => $value]);
        if($response != false){
            $message['type'] = 'success';
            $message['message'] = "Cập nhật thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Cập nhật thất bại !";
        }
        $this->returnJson($message);
    }

    public function ajax_delete(){
        $this->checkRequestPostAjax();
        $ids = (int)$this->input->post('id');
        $response = $this->_data->deleteArray('id',$ids);
        if($response != false){
            $message['type'] = 'success';
            $message['message'] = "Xóa thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Xóa thất bại !";
            log_message('error',$response);
        }
        $this->returnJson($message);
    }

    private function _validation(){
        $this->checkRequestPostAjax();
        $language_rules = [];
        if(!empty($this->config->item('language_name'))) foreach ($this->config->item('language_name') as $lang_code => $lang_name){
            if ($lang_code === $this->config->item('language_default')) {
                $language_rules = [
                    [
                        'field' => "language[$lang_code][title]",
                        'label' => "Tiêu đề ($lang_name)",
                        'rules' => "trim|required|min_length[2]"
                    ],[
                        'field' => "language[$lang_code][slug]",
                        'label' => "Đường dẫn ($lang_name)",
                        'rules' => "trim|required"
                    ],[
                        'field' => "language[$lang_code][description]",
                        'label' => "Tóm tắt ($lang_name)",
                        'rules' => 'trim|required'
                    ],[
                        'field' => "language[$lang_code][meta_title]",
                        'label' => "Tiêu đề SEO ($lang_name)",
                        'rules' => "trim|required|min_length[2]|max_length[{$this->config->item('SEO_title_maxlength')}]"
                    ],[
                        'field' => "language[$lang_code][meta_description]",
                        'label' => "Mô tả SEO ($lang_name)",
                        'rules' => "trim|required|min_length[2]|max_length[{$this->config->item('SEO_description_maxlength')}]"
                    ],[
                        'field' => "language[$lang_code][content]",
                        'label' => "Nội dung ($lang_name)",
                        'rules' => "required"
                    ]
                ];
            }
        }
        $rules = [];
        $rules = array_merge($rules, $language_rules);
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $message['type'] = "warning";
            $message['message'] = "Vui lòng kiểm tra lại thông tin vừa nhập.";
            $valid = array();
            if(!empty($rules)) foreach ($rules as $item){
                if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $message['validation'] = $valid;
            $this->returnJson($message);
        }
    }

    private function _convertData(){
        $this->_validation();
        $data = $this->input->post();
        if(!empty($data['is_status'])) $data['is_status'] = 1;else $data['is_status'] = 0;
        if(!empty($data['is_featured'])) $data['is_featured'] = 1;else $data['is_featured'] = 0;
        return $data;
    }
}