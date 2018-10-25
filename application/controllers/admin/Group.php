<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Group extends Admin_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        //$this->lang->load('group');
        $this->load->model(['groups_model']);
        $this->_data = new Groups_model();
    }

    public function index(){
        $data['heading_title'] = "Quản lý nhóm";
        $data['heading_description'] = 'Danh sách nhóm quyền';
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . $this->_method, $data, TRUE);
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
            'page'      => $page,
            'limit'     => $limit
        ];
        if(isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
            $params = array_merge($params,['is_status' => $queryFilter['is_status']]);
        $listData = $this->_data->getData($params);
        if(!empty($listData)) foreach ($listData as $item) {
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['description'] = $item->description;
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
        $this->checkRequestGetAjax();
        $term = $this->input->get("q");
        $params = [
            'is_status'=> 1,
            'search' => $term,
            'limit'=> 10
        ];
        $data = $this->_data->getData($params);
        $output = [];
        if(!empty($data)) foreach ($data as $item) {
            $output[] = ['id'=>$item->id, 'text'=>$item->name];
        }
        $this->returnJson($output);
    }

    public function ajax_add(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        unset($data['group_id']);
        if($id = $this->_data->save($data)){
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
            $dataItem = $this->_data->getById($id);
            unset($dataItem->password);
            $output['data'] = $dataItem;
            $this->returnJson($output);
        }
    }

    public function ajax_update(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        if($this->_data->update(['id' => $data['id']],$data, $this->_data->table)){
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
        if((is_array($ids) && in_array(1,$ids)) || $ids == 1){
            $message['type'] = 'error';
            $message['message'] = "Bạn không có quyền xóa Admin !";
            $this->returnJson($message);
        }else{
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
    }

    private function _validation(){

        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Tên nhóm',
                'rules' => 'trim|required|is_unique['.$this->_data->_dbprefix.'groups.name]'
            )
        );
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
        return $data;
    }
}