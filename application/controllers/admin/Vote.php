<?php
/**
 * Developer: linhth
 * Controller bài viết
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends Admin_Controller
{
    protected $_data;
    protected $_data_user;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('vote_model', 'users_model'));
        $this->_data = new Vote_model();
        $this->_data_user = new Users_model();
    }

    public function index()
    {
        $data['heading_title'] = "Quản lý đánh giá";
        $data['heading_description'] = "Danh sách đánh giá";
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . 'index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    /*
     * Ajax trả về datatable
     * */
    public function ajax_list()
    {
        $this->checkRequestPostAjax();
        $data = array();
        $pagination = $this->input->post('pagination');
        $page = $pagination['page'];
        $total_page = isset($pagination['pages']) ? $pagination['pages'] : 1;
        $limit = !empty($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 1;

        $queryFilter = $this->input->post('query');
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];
        if (isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
            $params = array_merge($params, ['is_status' => $queryFilter['is_status']]);

        $listData = $this->_data->getData($params);
        if (!empty($listData)) foreach ($listData as $item) {
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['email'] = $item->email;
            $row['vote'] = $item->vote;
            $row['message'] = $item->message;
            $row['is_status'] = $item->is_status;
            $row['created_time'] = $item->created_time;
            $data[] = $row;
        }

        $output = [
            "meta" => [
                "page" => $page,
                "pages" => $total_page,
                "perpage" => $limit,
                "total" => $this->_data->getTotal(),
                "sort" => "asc",
                "field" => "id"
            ],
            "data" => $data
        ];

        $this->returnJson($output);
    }

    public function ajax_add()
    {
        $data_store = $this->_convertData();
        if($id = $this->_data->save($data_store)){
            $message['type'] = 'success';
            $message['message'] = "Thêm mới thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Thêm mới thất bại !";
        }
        $this->returnJson($message);
    }

    public function ajax_update()
    {
        $data_store = $this->_convertData();
        $response = $this->_data->update(array('id' => $this->input->post('id')), $data_store, $this->_data->table);
        if ($response != false) {
            $message['type'] = 'success';
            $message['message'] = "Cập nhật thành công !";
        } else {
            $message['type'] = 'error';
            $message['message'] = "Cập nhật thất bại !";
        }
        $this->returnJson($message);
    }

    public function ajax_edit()
    {
        $this->checkRequestPostAjax();
        $id = $this->input->post('id');
        $data['data_info'] = $oneItem = $this->_data->getById($id);
        if(!empty($oneItem->user_id)) $data['data_user'] = $this->_data_user->getSelect2($oneItem->user_id);
        $this->returnJson($data);
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
    /*
     * Xóa một bản ghi
     * */
    public function ajax_delete()
    {
        $this->checkRequestPostAjax();
        $ids = (int)$this->input->post('id');
        $response = $this->_data->deleteArray('id', $ids);
        if ($response != false) {
            $message['type'] = 'success';
            $message['message'] = "Xóa thành công !";
        } else {
            $message['type'] = 'error';
            $message['message'] = "Xóa thất bại !";
            log_message('error', $response);
        }
        $this->returnJson($message);
    }
    /*
       * Kiêm tra thông tin post lên
       * */
    private function _validate()
    {
        $this->checkRequestPostAjax();
        $rules = array(
            array(
                'field' => "name",
                'label' => "Tên",
                'rules' => "required|trim"
            ),
            array(
                'field' => "email",
                'label' => "email",
                'rules' => "required|trim|valid_email"
            ),
            array(
                'field' => "vote",
                'label' => "Đánh giá",
                'rules' => "required|trim"
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === false) {
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

    private function _convertData()
    {
        $this->_validate();
        $data = $this->input->post();
        if(!empty($data['is_status'])) $data['is_status'] = 1;else $data['is_status'] = 0;
        return $data;
    }
}
