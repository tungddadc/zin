<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 12/01/2018
 * Time: 3:58 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Public_Controller
{
  protected $cid = 0;
  protected $_lang_code;
  protected $_all_agency;
  protected $_data_race;

  public function __construct()
  {
    parent::__construct();

    if (empty($this->_user_login)) redirect(site_url('login'));

    $this->lang->load('auth');
    $this->load->library(array('ion_auth', 'hybridauth'));
    $this->load->model(array('users_model','order_model'));
    $this->_data = new Users_model();
    $this->_order = new Order_model();
    $this->_lang_code = $this->session->public_lang_code;
  }

  public function index()
  {
    $data = array();
    // Lấy 10 đơn hàng mới nhất
    $params=array(
      'user_id'=>$this->_user_login->id,
      'order'=>array('created_time'=>'DESC'),
      'limit'=>10
    );
    $data['data']=$this->_order->getDataOrder($params);
    $data['main_profile'] = $this->load->view($this->template_path . 'auth/profile/dashboard', $data, TRUE);
    $data['main_content'] = $this->load->view($this->template_path . 'auth/profile/index', $data, TRUE);
    $this->load->view($this->template_main, $data);
  }
  public function order($page=1){
    $limit=10;
    $params=array(
      'user_id'=>$this->_user_login->id,
      'order'=>array('created_time'=>'DESC'),
      'limit'=>$limit,
      'page'=>$page
    );
    $data['data']=$this->_order->getDataOrder($params);
    $data['total']=$this->_order->getTotal($params);
    /*Pagination*/
    $this->load->library('pagination');
    $paging['base_url'] = getUrlProfile('order');
      $paging['first_url'] = getUrlProfile('order');
    $paging['total_rows'] = $data['total'];
    $config['enable_query_strings'] = TRUE;
    $paging['per_page'] = $limit;
    $this->pagination->initialize($paging);
    $data['pagination'] = $this->pagination->create_links();
    $data['main_profile'] = $this->load->view($this->template_path . 'auth/profile/order/index', $data, TRUE);
    $data['main_content'] = $this->load->view($this->template_path . 'auth/profile/index', $data, TRUE);

    $this->load->view($this->template_main, $data);
  }

  public function orderDetail($id){
    $data=array();
    $data['data']=$this->_order->getOrderById($id);
    $data['orderDetail']=$this->_order->getDetailOrder($id);
    $data['main_profile'] = $this->load->view($this->template_path . 'auth/profile/order/detail', $data, TRUE);
    $data['main_content'] = $this->load->view($this->template_path . 'auth/profile/index', $data, TRUE);
    $this->load->view($this->template_main, $data);
  }
//  edit profile
  public function edit()
  {
    $data = array();
    $this->sb_update_profile();
    $data['main_profile'] = $this->load->view($this->template_path . 'auth/profile/edit', $data, TRUE);
    $data['main_content'] = $this->load->view($this->template_path . 'auth/profile/index', $data, TRUE);

    $this->load->view($this->template_main, $data);
  }

  // Change password
  public function changepassword()
  {
    $data = array();
    $data['csrf'] = $this->_get_csrf_nonce();
    $this->sb_change_password();

    $data['main_profile'] = $this->load->view($this->template_path . 'auth/profile/change-password', $data, TRUE);
    $data['main_content'] = $this->load->view($this->template_path . 'auth/profile/index', $data, TRUE);

    $this->load->view($this->template_main, $data);
  }

  public function agency()
  {
    $data = array();
    $this->sb_agency();

    $data['main_profile'] = $this->load->view($this->template_path . 'auth/profile/agency', $data, TRUE);
    $data['main_content'] = $this->load->view($this->template_path . 'auth/profile/index', $data, TRUE);

    $this->load->view($this->template_main, $data);
  }

  private function sb_change_password()
  {

    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      $this->form_validation->set_rules('old', 'Mật khẩu cũ', 'required');
      $this->form_validation->set_rules('new', 'Mật khẩu mới', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', 'Xác nhận mật khẩu', 'required');
      $rules = array(
        array(
          'field' => 'old',
          'label' => 'Mật khẩu cũ',
          'rules' => 'required'
        ),
        array(
          'field' => 'new',
          'label' => 'Mật khẩu mới',
          'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]'
        ),
        array(
          'field' => 'new_confirm',
          'label' => 'Xác nhận mật khẩu',
          'rules' => 'required'
        ),
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() != FALSE) {
        $identity = $this->session->userdata['identity'];
        $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
        if ($change) {
          //if the password was successfully changed

          $this->_message = array(
            'type' => 'success',
            'message' => 'Đã thay đổi mật khẩu thành công',
            'url_redirect' => current_url()
          );
        } else {
          $this->_message = array(
            'type' => 'warning',
            'message' => strip_tags($this->ion_auth->errors()),
          );
        }
      } else {

        $valid = array();
        if (!empty($rules)) foreach ($rules as $item) {
          if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
        }
        $this->_message = array(
          'type' => 'warning',
          'message' => 'Vui lòng nhập thông tin chính xác!',
          'validation' => $valid
        );
      }
      $this->returnJson($this->_message);
    }
  }

  private function sb_update_profile()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      $this->_validate();

      if ($this->form_validation->run() === true) {
        $dataStore = $this->input->post();
        if (!empty($data)) foreach ($data as $key => $val) {
          $dataStore[$key] = trim(strip_tags($val));
        }
        $responsive = $this->ion_auth->update($this->_user_login->id, $dataStore);
        if ($responsive === true) {
          $this->_message = array(
            'type' => 'success',
            'message' => 'Cập nhật thành công!',
          );
        } else {
          $this->_message = array(
            'type' => 'warning',
            'message' => 'Cập nhật không thành công!',
          );
        }

      } else {
        $this->_message = array(
          'type' => 'warning',
          'message' => 'Cập nhật không thành công!',
        );
      }
      $this->returnJson($this->_message);
    }
  }

  private function sb_agency()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      $rules = array(
        array(
          'field' => 'ac_name',
          'label' => 'Tên đại lý',
          'rules' => 'required|trim|min_length[3]|max_length[100]'
        ),
        array(
          'field' => 'ac_address',
          'label' => 'Địa chỉ đại lý',
          'rules' => 'required|trim|min_length[3]|max_length[100]'
        ),
        array(
          'field' => 'ac_shipping',
          'label' => 'Địa chỉ giao hàng',
          'rules' => 'required|trim|min_length[3]|max_length[100]'
        )
      , array(
          'field' => 'ac_business',
          'label' => 'Lĩnh vực kinh doanh',
          'rules' => 'required|trim|min_length[3]|max_length[100]'
        ),
        array(
          'field' => 'ac_hotline',
          'label' => 'Hotline',
          'rules' => 'required|trim|min_length[6]|max_length[20]|numeric'
        )
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == false) {
        $message['type'] = "warning";
        $message['message'] = $this->lang->line('mess_validation');
        $valid = array();
        if (!empty($rules)) foreach ($rules as $item) {
          if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
        }
        $this->_message = array(
          'type' => 'warning',
          'message' => 'Vui lòng kiểm tra lại thông tin !',
          'validation' => $valid,
        );
        $this->returnJson($this->_message);
      } else {
        $data = $this->input->post();
        if ($this->_data->update(array('id' => $this->_user_login->id), $data)) {
          $this->_data->update(array('user_id' => $this->_user_login->id), array('group_id' => 3), $this->_data->table_user_group);
          $this->_message = array(
            'type' => 'success',
            'message' => 'Đăng ký làm đại lý thành công. Chúng tôi sẽ xét duyệt sớm!',
            'url_redirect' => current_url(),
          );
        }else{
          $this->_message = array(
            'type' => 'warning',
            'message' => 'Đăng ký thất bại!',
          );
        }
      }
      $this->returnJson($this->_message);
    }

  }

  public function do_upload()
  {
    if (!empty($_FILES)) {
      $avatar = '';
      $dir = 'public/media/avatar';
      if (!is_dir($dir)) {
        mkdir('public/media/avatar', '0755');
      }
      chmod($dir, 755);
      $config['upload_path'] = $dir;
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size'] = '0';
      $config['max_width'] = '0';
      $config['max_height'] = '0';
      $config['encrypt_name'] = true;

//        dd($_FILES);
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('avatar')) {
        $data = $this->upload->data();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['full_path']; //get original image
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 1200;
        $this->load->library('image_lib', $config);
        if (!$this->image_lib->resize()) {
          $this->handle_error($this->image_lib->display_errors());
        }
        $avatar = 'avatar/' . $data['file_name'];
      }
      return $avatar;
    } else {
      return false;
    }
  }

  private function _validate()
  {
    $rules = array(

      array(
        'field' => 'phone',
        'label' => 'Số điện thoại',
        'rules' => 'required|trim|min_length[6]|max_length[20]|numeric'
      ), array(
        'field' => 'fullname',
        'label' => 'Họ và tên',
        'rules' => 'required|trim|min_length[3]|max_length[50]'
      ), array(
        'field' => 'address',
        'label' => 'Địa chỉ',
        'rules' => 'required|trim|min_length[3]|max_length[70]'
      ),
      array(
        'field' => 'agent',
        'label' => 'Tên cửa hàng đại lý',
        'rules' => 'trim|min_length[3]|max_length[255]'
      ),
      array(
        'field' => 'shipping_address',
        'label' => 'Địa chỉ giao hàng',
        'rules' => 'trim|min_length[3]|max_length[255]'
      ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == false) {
      $message['type'] = "warning";
      $message['message'] = $this->lang->line('mess_validation');
      $valid = array();
      if (!empty($rules)) foreach ($rules as $item) {
        if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
      }
      $this->_message = array(
        'type' => 'warning',
        'message' => 'Vui lòng kiểm tra lại thông tin !',
        'validation' => $valid,
      );
      $this->returnJson($this->_message);
    }
  }
}
