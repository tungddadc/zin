<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends Admin_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        //tải thư viện
        //$this->lang->load('category');
        $this->load->model(['category_model']);
        $this->_data = new Users_model();
        $this->_data_group = new Groups_model();
    }

    public function index(){
        $data['heading_title'] = "Quản lý thành viên";
        $data['heading_description'] = 'Danh sách thành viên';
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
            'group_id'  => !empty($queryFilter['group_id']) ? $queryFilter['group_id'] : '',
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
            $row['title'] = $item->title;
            $row['is_status'] = $item->active;
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

    public function ajax_add(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $category_ids = $data['category_id'];
        unset($data['category_id']);
        if($id = $this->_data->save($data)){
            $this->saveCategory($id,$category_ids);
            $message['type'] = 'success';
            $message['message'] = "Thêm mới thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Thêm mới thất bại !";
        }
        $this->returnJson($message);
    }

    private function saveCategory($user_id, $category_ids){
        $data = [];
        if(!empty($category_ids)) foreach ($category_ids as $group_id){
            $tmp['user_id'] = $user_id;
            $tmp['group_id'] = $group_id;
            $data[] = $tmp;
        }
        $this->_data->save($data, $this->_data_category);
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
                'field' => 'fullname',
                'label' => 'Họ và tên',
                'rules' => 'trim'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique['.$this->_data->_dbprefix.'users.email]',
                'errors' => array(
                    'required' => '%s đã tồn tại. Vui lòng chọn %s khác.',
                )
            ),
            array(
                'field' => 'phone',
                'label' => 'Số điện thoại',
                'rules' => 'trim|regex_match[/^[0-9.-]{0,18}+$/]'
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|is_unique['.$this->_data->_dbprefix.'users.username]',
                'errors' => array(
                    'required' => '%s đã tồn tại. Vui lòng chọn %s khác.',
                )
            ),
            array(
                'field' => 'password',
                'lable' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 're-password',
                'lable' => 'Re Password',
                'rules' => 'trim|required|matches[password]'
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
        unset($data['re-password']);
        return $data;
    }
}