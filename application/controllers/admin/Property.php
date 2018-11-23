<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Property extends Admin_Controller
{
    protected $_data;

    const STATUS_CANCEL = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;
    public function __construct()
    {
        parent::__construct();
        //tải thư viện
        //$this->lang->load('property');
        $this->load->model(['property_model']);
        $this->_data = new Property_model();
    }

    public function get_list($data){
        $this->session->set_userdata('type',$this->_method);
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . 'index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function banner(){
        $data['heading_title'] = "Quản lý banner/slider";
        $data['heading_description'] = "Danh sách banner/slider";
        $this->get_list($data);
    }

    public function color(){
        $data['heading_title'] = "Quản lý thuộc tính";
        $data['heading_description'] = "Danh sách thuộc tính màu sắc";
        $this->get_list($data);
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
            'type'      => $this->session->userdata('type'),
            'search'    => !empty($queryFilter['generalSearch']) ? $queryFilter['generalSearch'] : '',
            'limit'     => 2000
        ];
        if(isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
            $params = array_merge($params,['is_status' => $queryFilter['is_status']]);

        $listData = $this->_data->getData($params);
        if(!empty($listData)) foreach ($listData as $item) {
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['title'] = $item->title;
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
                "total"     => $this->_data->getTotal($params),
                "sort"      => "asc",
                "field"     => "id"
            ],
            "data" =>  $data
        ];

        $this->returnJson($output);
    }

    public function ajax_load($type = ''){
        $this->checkRequestGetAjax();
        $term = $this->input->get("q");
        if(empty($type)) $this->session->userdata('type');
        $params = [
            'type' => !(empty($type)) ? $type : null,
            'is_status'=> 1,
            'limit'=> 2000
        ];
        $list = $this->_data->getData($params);
        $output = [];
        if(!empty($list)) foreach ($list as $item) {
            $item = (object) $item;
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
    public function ajax_add(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $data_trans = $data['language'];
        unset($data['language']);
        if($id = $this->_data->save($data)){
            $this->save_language($id, $data_trans);
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
            $this->returnJson($output);
        }
    }

    public function ajax_update(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $id = $data['id'];
        $data_trans = $data['language'];
        unset($data['language']);
        if($this->_data->update(['id' => $id],$data, $this->_data->table)){
            $this->save_language($id, $data_trans);
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
                        'label' => "Tên thuộc tính ($lang_name)",
                        'rules' => "trim|required"
                    ],[
                        'field' => "language[$lang_code][description]",
                        'label' => "Mô tả ($lang_name)",
                        'rules' => 'trim|required'
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
        $data['type'] = $this->session->userdata('type');
        if(!empty($data['is_status'])) $data['is_status'] = 1;else $data['is_status'] = 0;
        return $data;
    }
}