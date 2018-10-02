<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends Admin_Controller
{
    protected $_data;
    protected $_data_group;
    public function __construct()
    {
        parent::__construct();
        //tải thư viện
        $this->load->library(array('ion_auth'));
        //$this->lang->load('user');
        $this->load->model(['users_model','groups_model']);
        $this->_data = new Users_model();
        $this->_data_group = new Groups_model();
    }

    public function index(){
        $data['heading_title'] = "Quản lý thành viên";
        $data['heading_description'] = 'Danh sách thành viên';
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . $this->_method, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function profile(){
        $data['heading_title'] = "Thông tin của tôi";
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . $this->_method, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function activity(){
        $data['heading_title'] = "Hoạt động của tôi";
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . $this->_method, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function login(){
        if($this->ion_auth->logged_in() == true) redirect(site_admin_url());
        $this->load->view($this->template_path.'user/login');
    }

    public function ajax_login(){
        $this->checkRequestPostAjax();

        $identity = $this->input->post('identity');
        $rules[] = array(
            'field' => 'identity',
            'label' => str_replace(':', '', $this->lang->line('login_identity_label')),
            'rules' => filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'trim|required|valid_email' : 'trim|required'
        );
        $rules[] = array(
            'field' => 'password',
            'label' => str_replace(':', '', $this->lang->line('login_password_label')),
            'rules' => 'trim|required'
        );
        if(GG_CAPTCHA_MODE == TRUE){
            $rules[] = array(
                'field' => 'g-recaptcha-response',
                'label' => 'captcha',
                'rules' => 'required'
            );
        }

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() != false) {

            if (GG_CAPTCHA_MODE == TRUE){
                //Check config setting reCaptcha
                $this->load->library('recaptcha');
                $captchaResponse = $this->input->post('g-recaptcha-response');
                $remoteIp = $this->input->ip_address();
                if ($this->recaptcha->verify($captchaResponse, $remoteIp) == false) {
                    $message['type'] = 'error';
                    $message['message'] = "Bạn chưa xác thực Captcha !";
                    $this->returnJson($message);
                }
                //Check config setting reCaptcha
            }

            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //Set session for Moxie Manager Image
                $this->session->set_userdata('MyLoggedInKey', "true");
                $this->session->set_userdata('CodeIgniterAuthenticator.environment', ENVIRONMENT);
                $this->session->set_userdata('moxiemanager.filesystem.rootpath', MEDIA_PATH);
                $this->session->set_userdata('moxiemanager.storage.path', MEDIA_PATH);
                $this->session->set_userdata("identity", $this->input->post('identity'));
                //redirect them back to the home page
                $url_redirect = $this->input->post('url_redirect') ? $this->input->post('url_redirect') : site_admin_url();
                $message['type'] = 'success';
                $message['message'] = $this->ion_auth->messages();
                $message['url_redirect'] = $url_redirect;
                $this->returnJson($message);
            } else {
                $message['type'] = 'error';
                $message['message'] = $this->ion_auth->errors();
                $this->returnJson($message);
            }
        }else{
            $message['type'] = "warning";
            $message['message'] = "Vui lòng kiểm tra lại thông tin.";
            $valid = array();
            if(!empty($rules)) foreach ($rules as $item){
                if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $message['validation'] = $valid;
            $this->returnJson($message);
        }
    }

    public function logout(){
        $this->ion_auth->logout();
        redirect(site_admin_url('user/login'), 'refresh');
    }
}