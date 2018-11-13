<?php
/**
 * Developer: linhth
 * Controller bài viết
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends Admin_Controller
{
  protected $_data;
  protected $user_model;

  public function __construct()
  {
    parent::__construct();

    //tải file ngôn ngữ//tải model
    $this->load->model(array('voucher_model', 'users_model'));
    $this->_data = new Voucher_model();
    $this->user_model = new Users_model();
  }

  public function index()
  {
    //chỉ lấy ra những category thuộc mục product
    $data = [];
    $data['main_content'] = $this->load->view($this->template_path . 'voucher/index', $data, TRUE);
    $this->load->view($this->template_main, $data);
  }


  public function ajax_add()
  {
    $data_store = $this->_convertData();
    if (!empty($data_store['user_use'])) $data_user = $data_store['user_use'];
    if ($id = $this->_data->save($data_store)) {
      // log action
      if (!empty($data_user)) $this->insert_account_gift($id, $data_user);

      $this->_message=array(
        'type'=>'success',
        'message'=>'Thêm mới voucher thành công!',
      );
    } else {
      $this->_message=array(
        'type'=>'error',
        'message'=>'Thêm mới voucher thành công!'
      );
    }
    $this->returnJson($this->_message);
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
      'limit' => $limit
    ];
    if (isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
      $params = array_merge($params, ['is_status' => $queryFilter['is_status']]);

    $listData = $this->_data->getData($params);
    if (!empty($listData)) foreach ($listData as $item) {
      $row = array();
      $row['checkID'] = $item->id;
      $row['id'] = $item->id;
      $row['code'] = $item->code;
      $row['value'] = $item->value;
      $row['is_status'] = $item->is_status;
      $row['updated_time'] = $item->updated_time;
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

  public function ajax_update()
  {
    $data_store = $this->_convertData();
    $data_user = $data_store['user_use'];
    $response = $this->_data->update(array('id' => $this->input->post('id')), $data_store, $this->_data->table);
    if ($response != false) {
      $this->insert_account_gift($this->input->post('id'),  $data_user);
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
     $data['user_use'] = array();
    if (!empty($oneItem->user_use)) {
      $dataAccount = $this->user_model->getUserByField('id',$oneItem->user_use);
      $data['user_use'] = array(array('id' => $dataAccount->id, 'text' => $dataAccount->email . '(' . $dataAccount->fullname . ')'));
    }

    $this->returnJson($data);
  }


  /*
   * Xóa một bản ghi
   * */
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

  // Thêm vào bảng account_gift
  private function insert_account_gift($id, $account)
  {
    $this->_data->delete(array('type_id' => $id, 'account_id' => $account), 'user_voucher');

    $tmp['account_id'] = $account;
    $tmp['type_id'] = $id;
    $this->user_model->save($tmp, 'user_voucher');

    return;
  }


//  Check xem mã đã tồn tại hay chưa
  function ajax_check_code()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

      $code = $this->input->post('code');
      if (!empty($code)) $result = $this->_data->check_code($code);
      echo $result;
      exit();
    }
  }

  /*
     * Kiêm tra thông tin post lên
     * */
  private function _validate()
  {
    $this->checkRequestPostAjax();
    $this->form_validation->set_rules('value', 'Giá trị', 'required');
    $rules=array(
      array(
        'field' => "code",
        'label' => "Mã voucher",
        'rules' => "required"
      ),array(
        'field' => "value",
        'label' => "Giá trị",
        'rules' => "required"
      ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() === false) {
      $valid = array();
      if(!empty($rules)) foreach ($rules as $item){
        if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
      }
      $this->_message = array(
        'type' => 'warning',
        'message' => 'Vui lòng nhập đúng thông tin!',
        'validation' => $valid,
      );
      $this->returnJson($this->_message);
    }
  }

  private function _convertData()
  {
    $this->_validate();
    $data = $this->input->post();
    $data_store = array();
    foreach ($data as $key => $value) {
      $data_store[$key] = $value;
    }
    if (!isset($data['user_use'])) $data_store['user_use'] = '';
//    dd($data_store);
    return $data_store;
  }
}
