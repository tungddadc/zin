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
                    'field' => 'fullname',
                    'label' => 'họ và tên',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'trim|required|valid_email'
                ),
                /*array(
                    'field' => 'phone',
                    'label' => 'số điện thoại',
                    'rules' => 'trim|regex_match[/^[0-9.-]{0,18}+$/]'
                ),*/
                array(
                    'field' => 'content',
                    'label' => 'nội dung',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'g-recaptcha-response',
                    'label' => 'mã captcha',
                    'rules' => 'required'
                )

            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                //Check config setting reCaptcha
                $this->load->library('recaptcha');
                $captchaResponse = $this->input->post('g-recaptcha-response');
                $remoteIp = $this->input->ip_address();
                if($this->recaptcha->verify($captchaResponse,$remoteIp) == false){
                    $message['type'] = 'error';
                    $message['message'] = "Bạn chưa xác thực Captcha !";
                    die(json_encode($message));

                }
                //Check config setting reCaptcha


                $emailFrom = $this->input->post('email');
                $nameFrom = $this->input->post('fullname');
                //$phone = $this->input->post('phone');
                $title = $this->input->post('title');
                $content = $this->input->post('content');

                $contentHtml = '
                <h2>Dear ' . $this->settings['name'] . ' !</h2></br>
                <p>Họ và tên: ' . $nameFrom . '</p>
                <p>Nội dung: ' . $content . '</p>
            ';
                $this->email->from($emailFrom, $nameFrom);

                $this->email->to($emailTo);
                if (!empty($emailToCC)) $this->email->cc($emailToCC);
                if (!empty($emailToBCC)) $this->email->bcc($emailToBCC);

                $this->email->subject($title);
                $this->email->message($contentHtml);

                if ($this->email->send()) {
                    $message['type'] = 'success';
                    $message['message'] = "Gửi thông tin liên hệ thành công !";
                } else {
                    $message['type'] = 'error';
                    $message['message'] = 'Gửi thông tin liên hệ thất bại !';
                }
                die(json_encode($message));
            }else{
                $message['type'] = "warning";
                $message['message'] = $this->lang->line('mess_validation');
                $valid = array();
                if(!empty($rules)) foreach ($rules as $item){
                    if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
                }
                $message['validation'] = $valid;
                die(json_encode($message));
            }
        }
    }

    public function enquiry(){
        if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->library('email');
            $emailTo = $this->settings['contact'][$this->session->public_lang_code]['email'];
            $emailToCC = 'steven.mucian@gmail.com';
            $emailToBCC = '';

            $this->form_validation->set_rules('fullname', $this->lang->line('text_fullname'), 'trim|required');
            $this->form_validation->set_rules('phone', lang('form_text_phone'), 'trim|required|regex_match[/^[0-9.-]{0,18}+$/]');
            $this->form_validation->set_rules('content', lang('form_text_content'), 'trim|required');
            if ($this->form_validation->run() == true) {
                $this->load->model('enquiry_model');
                $enquiryModel = new Enquiry_model();


                $emailFrom = $this->input->post('email');
                $nameFrom = $this->input->post('fullname');
                $phone = $this->input->post('phone');
                $content = $this->input->post('content');

                $enquiryModel->save(array(
                    'fullname' => $nameFrom,
                    'phone' => $phone,
                    'content' => $content
                ));

                $contentHtml = '
                <h2>Dear ' . $this->settings['name'] . ' !</h2></br>
                <p>Họ và tên: ' . $nameFrom . '</p>
                <p>Phone: ' . $phone . '</p>
                <p>Nội dung: ' . $content . '</p>
            ';
                $this->email->from($emailFrom, $nameFrom);

                $this->email->to($emailTo);
                if (!empty($emailToCC)) $this->email->cc($emailToCC);
                if (!empty($emailToBCC)) $this->email->bcc($emailToBCC);

                $this->email->subject('Liên hệ');
                $this->email->message($contentHtml);

                if ($this->email->send()) {
                    $message['type'] = 'success';
                    $message['message'] = "Gửi thông tin liên hệ thành công !";
                } else {
                    //dd($this->email->print_debugger(array('headers')));
                    $message['type'] = 'error';
                    $message['message'] = 'Gửi thông tin liên hệ thất bại !';
                }
                die(json_encode($message));
            }else{
                $data['type'] = "warning";
                $data['message'] = "Vui lòng kiểm tra lại thông tin !";
                $data['data'] = $this->input->post();
                $valid['fullname'] = form_error('fullname');
                $valid['phone'] = form_error('phone');
                $valid['content'] = form_error('content');
                $data['validation'] = $valid;
                die(json_encode($data));
            }
        }
    }

    //button subscriber in footer
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
                    'rules' => 'trim|required|valid_email'
                )
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                if ($newsletterModel->save($data) != false) {
                    $message['type'] = 'success';
                    $message['message'] = $this->lang->line('mess_subscriber_success');
                } else {
                    $message['type'] = 'warning';
                    $message['message'] = $this->lang->line('mess_subscriber_exist');
                }
            } else {
                $message['type'] = "warning";
                $message['message'] = $this->lang->line('mess_validation');
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
