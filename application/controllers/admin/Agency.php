<?php
/**
 * Developer: linhth
 * Controller bài viết
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Agency extends Admin_Controller
{
  protected $_data;
  public $location_model;

  public function __construct()
  {
    parent::__construct();

    //tải file ngôn ngữ//tải model
    $this->load->model(array('agency_model', 'location_model'));
    $this->_data = new Agency_model();
    $this->location_model = new Location_model();
  }

  public function index()
  {
    $data['heading_title'] = "Quản lý đại lý";
    $data['heading_description'] = "Danh sách đại lý";
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
      $row['title'] = $item->title;
      $row['address'] = $item->address;
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

  public function ajax_add()
  {
    $data_store = $this->_convertData();
    if ($id = $this->_data->save($data_store)) {
      $this->_message = array(
        'type' => 'success',
        'message' => 'Thêm mới thành công!',
      );
    } else {
      $this->_message = array(
        'type' => 'error',
        'message' => 'Thêm mới thành công!'
      );
    }
    $this->returnJson($this->_message);
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
    if (!empty($oneItem->city_id)) {
      $oneCity = $this->location_model->getCityById($oneItem->city_id);
      $data['city_id'] = array(array('id' => $oneCity->id, 'text' => $oneCity->title));
    }
    if (!empty($oneItem->district_id)) {
      $oneDistrict = $this->location_model->getDistrictById($oneItem->district_id);
      $data['district_id'] = array(array('id' => $oneDistrict->id, 'text' => $oneDistrict->title));
    }
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
        'field' => "title",
        'label' => "Tên",
        'rules' => "required|trim"
      ),
      array(
        'field' => "city_id",
        'label' => "Thành phố",
        'rules' => "required|trim"
      ),array(
        'field' => "district_id",
        'label' => "Quận huyện",
        'rules' => "required|trim"
      ),array(
        'field' => "address",
        'label' => "Địa chỉ",
        'rules' => "required|trim"
      ),array(
        'field' => "longitude",
        'label' => "Kinh độ",
        'rules' => "required|trim"
      ),array(
        'field' => "latitude",
        'label' => "Vĩ độ",
        'rules' => "required|trim"
      ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() === false) {
      $valid = array();
      if (!empty($rules)) foreach ($rules as $item) {
        if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
      }
      $this->_message = array(
        'type' => 'warning',
        'message' => 'Vui lòng kiểm tra lại thông tin vừa nhập.',
        'validation' => $valid,
      );
      $this->returnJson($this->_message);
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
