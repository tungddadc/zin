<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Public_Controller
{
    public function submit()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->library('email');
            $emailTo = $this->settings['contact'][$this->session->public_lang_code]['email'];
            $emailToCC = '';
            $emailToBCC = '';

            $rules = array(
                array(
                    'field' => 'full_name',
                    'label' => 'họ và tên',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'phone',
                    'label' => 'số điện thoại',
                    'rules' => 'trim|regex_match[/^[0-9.-]{0,18}+$/]'
                ),
                array(
                    'field' => 'content',
                    'label' => 'nội dung',
                    'rules' => 'trim|required'
                ),

            );
            if(GG_CAPTCHA_MODE == true){
                $rules = array_merge($rules,array(
                    'field' => 'g-recaptcha-response',
                    'label' => 'mã captcha',
                    'rules' => 'required'
                ));
            }
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                if(GG_CAPTCHA_MODE == true) {
                    //Check config setting reCaptcha
                    $this->load->library('recaptcha');
                    $captchaResponse = $this->input->post('g-recaptcha-response');
                    $remoteIp = $this->input->ip_address();
                    if ($this->recaptcha->verify($captchaResponse, $remoteIp) == false) {
                        $message['type'] = 'error';
                        $message['message'] = "Bạn chưa xác thực Captcha !";
                        die(json_encode($message));

                    }
                }
                //Check config setting reCaptcha

                $data = $this->input->post();
                $title = "Thông tin liên hệ";
                $contentHtml = $this->load->view($this->template_path . 'email/contact', $data, TRUE);
                $respon = $this->sendMail($emailTo, $title, $contentHtml);
                if ($respon === true) {
                    $this->_message = array(
                        'message' => 'Gửi thông tin liên hệ thành công !',
                        'type' => 'success',
                        'url_redirect' => current_url()
                    );
                } else {
                    $this->_message = array(
                        'message' => 'Gửi thông tin liên hệ không thành công !',
                        'type' => 'warning'
                    );
                }
            } else {
                $valid = array();
                if (!empty($rules)) foreach ($rules as $item) {
                    if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
                }
                $this->_message = array(
                    'message' => 'Gửi thông tin liên hệ không thành công !',
                    'type' => 'warning',
                    'validation' => $valid
                );
            }
            $this->returnJson($this->_message);
        }
    }

    public function subscriber()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('newsletter_model');
            $newsletterModel = new Newsletter_model();
            $data = $this->input->post();

            $rules = array(
                array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'trim|required|valid_email|is_unique['.$newsletterModel->_dbprefix.'newsletter.email]',
                    'errors' => array(
                        'is_unique' => 'Bạn đã đăng ký với %s này rồi.',
                    )
                )
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                if ($newsletterModel->save($data) != false) {
                    $message['type'] = 'success';
                    $message['message'] = "Đăng ký nhận tin khuyến mại thành công.";
                } else {
                    $message['type'] = 'warning';
                    $message['message'] = "Đăng ký thất bại.";
                }
            } else {
                $message['type'] = "warning";
                $message['message'] = "Vui lòng kiểm tra thông tin";
                $valid = array();
                if(!empty($rules)) foreach ($rules as $item){
                    if(form_error($item['field'])) $valid[$item['field']] = form_error($item['field']);
                }
                $message['validation'] = $valid;
            }
            die(json_encode($message));
        }
        exit;
    }
}
