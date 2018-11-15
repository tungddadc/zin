<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        //tải model
        $this->load->model(['page_model']);
        $this->_data = new Page_model();
        //Check xem co chuyen lang hay khong thi set session lang moi
        if ($this->input->get('lang'))
            $this->_lang_code = $this->input->get('lang');
        else
            $this->_lang_code = $this->session->public_lang_code;
    }

    public function index($slug)
    {
        $id = $this->_data->slugToId($slug);
        $oneItem = $this->_data->getById($id, '', $this->session->public_lang_code);
        if (empty($oneItem)) show_404();
        if ($this->input->get('lang')) redirect(getUrlPage($oneItem));
        $data['oneItem'] = $oneItem;
        switch ($oneItem->layout) {
            case 'lienhe':
                $this->contact();
        }
        //add breadcrumbs
        $this->breadcrumbs->push($this->lang->line('home'), base_url());
        $this->breadcrumbs->push($oneItem->title, getUrlPage($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();

        $data['SEO'] = array(
            'meta_title' => $oneItem->meta_title,
            'meta_description' => !empty($oneItem->meta_title) ? $oneItem->meta_description : '',
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlPage($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        );
        if (!empty($oneItem->layout)) $layoutView = '-' . $oneItem->layout;
        else $layoutView = '';
        $data['main_content'] = $this->load->view($this->template_path . 'page/page' . $layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    private function contact()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->library('email');
            $emailTo = $this->settings['email'];
            $emailToBCC = '';
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email'
                ),

                array(
                    'field' => 'full_name',
                    'label' => 'Họ và tên',
                    'rules' => 'required|trim'
                ),

                array(
                    'field' => 'phone',
                    'label' => 'Số điện thoại',
                    'rules' => 'trim|required|numeric|min_length[10]|max_length[14]|regex_match[/^(09|012|08|03|016)\d{8,}/]'
                ),

                array(
                    'field' => 'content',
                    'label' => 'Nội dung',
                    'rules' => 'required|trim'
                ),

            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == true) {

                $emailFrom = $this->input->post('email');
                $nameFrom = $this->input->post('full_name');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $title = "Thông tin liên hệ";
                $content = $this->input->post('content');

                $data = $this->input->post();

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

    public function _404(){
        redirect('404.html','','301');
    }

    public function notfound(){
        $data['main_content'] = $this->load->view($this->template_path . 'page/_404', NULL, TRUE);
        $this->load->view($this->template_main, $data);
    }
}
