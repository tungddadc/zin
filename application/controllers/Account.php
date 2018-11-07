<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 12/01/2018
 * Time: 3:58 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Public_Controller
{
  protected $cid = 0;
  protected $_data;
  protected $_lang_code;
  protected $_all_agency;

  public function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
  }

  public function ajax_login()
  {
    if($this->input->server('REQUEST_METHOD') == 'POST')
    {
      $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
      $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
      if ($this->form_validation->run() === TRUE)
      {
        // check to see if the user is logging in
        // check for "remember me"
        $remember = (bool)$this->input->post('remember');

        if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
        {
          //if the login is successful
          //redirect them back to the home page
          $this->session->is_logged = true;
          $message['type'] = 'success';
          $message['message'] = strip_tags($this->ion_auth->messages());
          echo json_encode($message);exit;
        }
        else
        {
          // if the login was un-successful
          // redirect them back to the login page
          $message['type'] = 'error';
          $message['message'] = strip_tags($this->ion_auth->errors());
          echo json_encode($message);exit;
        }
      }
      $message['type'] = 'warning';
      $message['message'] = lang('mess_validation');
      echo json_encode($message);exit;
    }
    exit;
  }

  public function ajax_register()
  {
    // validate form input
    $this->form_validation->set_rules('fullname', lang('text_fullname'), 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
    $this->form_validation->set_rules('phone', lang('form_text_phone'), 'trim');
    $this->form_validation->set_rules('address', lang('form_text_address'), 'trim');

    if ($this->form_validation->run() === TRUE)
    {
      $email = strtolower($this->input->post('email'));
      $identity = $email;
      $password = "Apec@20182019";

      $additional_data = array(
        'first_name' => $this->input->post('fullname'),
        'company' => $this->input->post('company'),
        'phone' => $this->input->post('phone'),
        'address' => $this->input->post('address'),
      );
    }
    if ($this->form_validation->run() === TRUE)
    {
      if(!$this->ion_auth->register($identity, $password, $email, $additional_data,array('group_id' => 3))){
        $message['type'] = 'error';
        $message['message'] = lang('mess_add_unsuccess');
        echo json_encode($message);exit;
      }
      $contentHtml = 'Thông tin đăng ký đã được gửi đến LUFA. LUFA sẽ liên hệ với Quý đối tác và gửi tài khoản đăng nhập qua email. Trân trọng.';
      $this->sendMail($email, "Đăng ký tài khoản !", $contentHtml);
      $message['type'] = 'success';
      $message['message'] = strip_tags($this->ion_auth->messages());
      echo json_encode($message);exit;
    }
    else
    {
      $message['type'] = 'warning';
      $message['message'] = lang('mess_validation');
      $message['valid'] = validation_errors();
      echo json_encode($message);exit;
    }
  }



  public function logout()
  {
    $logout = $this->ion_auth->logout();
    // redirect them to the login page
    $this->session->set_flashdata('message', $this->ion_auth->messages());
    redirect('/', 'refresh');
  }

  public function ajax_load_city(){
    $data = $this->_data->loadCity();
    $keyword = $this->toSlug($this->input->get("q"));
    $dataJson = [];
    if(!empty($data)) foreach ($data as $key => $item){
      if(!empty($keyword) && strpos($item->name,$keyword) !== false ){
        $dataJson[] = ['id'=>$item->code, 'text'=>$item->name];
      }
      if(empty($keyword)) $dataJson[] = ['id'=>$item->code, 'text'=>$item->name];
    }
    echo json_encode($dataJson);exit;
  }

  public function ajax_load_district($city_id){
    $dataJson = [];
    $data = $this->_data->loadDistrict($city_id);
    if(!empty($data)) foreach ($data as $key => $item){
      $dataJson[] = ['id'=>$item->code, 'text'=>$item->name];
    }
    echo json_encode($dataJson);exit;
  }

  public function ajax_list_agency(){
    if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $city_id = $this->input->post('city_id');
      $district_id = $this->input->post('district_id');
      $this->load->model('partner_model');
      $agencyModel = new Partner_model();
      $data['data'] = $agencyModel->getDataAgency($city_id, $district_id);
      echo $this->load->view($this->template_path . 'agency/_load_list_partner', $data, TRUE);
    }
    exit;
  }
  public function ajax_list_agency_json(){
    if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $city_id = $this->input->post('city_id');
      $district_id = $this->input->post('district_id');
      $this->load->model('partner_model');
      $agencyModel = new Partner_model();
      $data = $agencyModel->getDataAgency($city_id, $district_id);
      echo json_encode($data);
    }
    exit;
  }

}
