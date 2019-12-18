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
    protected $_data;
    protected $_lang_code;

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

    public function index($slug, $page = 1)
    {
        $id = $this->_data->slugToId($slug);
        $oneItem = $this->_data->getById($id, '', $this->session->public_lang_code);
        if (empty($oneItem)) show_404();
        if ($this->input->get('lang')) redirect(getUrlPage($oneItem));
        $data['oneItem'] = $oneItem;
        if ($oneItem->layout == 'daily') {
            $data['data'] = $this->agency();
        }
        if ($oneItem->layout == 'news') {
            $data['dataNews'] = $this->news($oneItem, $page);
        }
        if ($oneItem->layout == 'faq') {
            $data['dataFaqs'] = $this->faq($oneItem, $page);
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

    private function agency()
    {
        $this->load->model('agency_model');
        $agencyModel = new Agency_model();
        $params = array(
            'is_status' => 1,
            'limit' => 100
        );
        $data = $agencyModel->getData($params);
        return $data;
    }

    private function news($oneItem, $page = 1)
    {
        $this->load->model('post_model');
        $postModel = new Post_model();
        $limit = 10;
        $params = array(
            'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code' => $this->_lang_code,
            'limit' => $limit,
            'order' => ['created_time' => 'desc'],
            'page' => $page
        );
        $data['data'] = $postModel->getData($params);
        $data['total'] = $postModel->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlPage(['slug' => $oneItem->slug, 'page' => 1]);
        $paging['first_url'] = getUrlPage(['slug' => $oneItem->slug]);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        return $data;
    }

    private function faq($oneItem, $page = 1)
    {
        $this->load->model('faq_model');
        $postModel = new Faq_model();
        $limit = 10;
        $params = array(
            'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code' => $this->_lang_code,
            'limit' => $limit,
            'order' => ['created_time' => 'desc'],
            'page' => $page,
            'key_search' => !empty($this->input->get('key_search')) ? $this->input->get('key_search') : ''
        );
        $data['data'] = $postModel->getData($params);
        $data['total'] = $postModel->getTotal($params);
        /*Pagination*/
        $this->load->library('pagination');
        $paging['base_url'] = getUrlPage(['slug' => $oneItem->slug, 'page' => 1]);
        $paging['first_url'] = getUrlPage(['slug' => $oneItem->slug]);
        $paging['total_rows'] = $data['total'];
        $paging['per_page'] = $limit;
        $this->pagination->initialize($paging);
        $data['pagination'] = $this->pagination->create_links();
        return $data;
    }

    public function _404()
    {
        redirect('404.html', '', '301');
    }

    public function ajax_load_comment()
    {
        $this->checkRequestPostAjax();
        $productId = $this->input->post('product_id');
        $page = $this->input->post('page');
        $limit = 5;
        $params = [
            'is_status' => 1,
            'product_id' => $productId,
            'limit' => $limit,
            'page' => $page,
            'type' => 'page'
        ];
        $this->load->model('comments_model');
        $commentModel = new Comments_model();
        $listData = $commentModel->getData($params);
        $data['data'] = $commentModel->_recursive($listData, 0);
        print $this->load->view($this->template_path . 'product/_ajax_load_comment', $data, TRUE);
    }

    public function ajax_save_comment()
    {
        $this->checkRequestPostAjax();
        if ($this->session->userdata('is_logged') != true) {
            $message['type'] = 'error';
            $message['message'] = "Bạn phải đăng nhập để thực hiện thao tác này !";
            $this->returnJson($message);
        }

        $rules = array(
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'name',
                'label' => 'Tên',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'content',
                'label' => 'Nội dung',
                'rules' => 'required|trim'
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() != false) {
            $data = $this->input->post();
            if (!empty($data['parent_id'])) $data['is_status'] = 1;
            $data['type'] = 'page';
            if (!empty($data)) {
                $this->load->model('comments_model');
                $commentModel = new Comments_model();
                if ($commentModel->save($data)) {
                    $message['type'] = 'success';
                    $message['message'] = "Bạn vừa bình luận thành công.";
                } else {
                    $message['type'] = 'error';
                    $message['message'] = "Lỗi không bình luận được.";
                }
                $this->returnJson($message);
            }
        } else {
            $message['type'] = "warning";
            $message['message'] = "Vui lòng kiểm tra lại thông tin";
            $valid = array();
            if (!empty($rules)) foreach ($rules as $item) {
                if (form_error($item['field'])) $valid[$item['field']] = form_error($item['field']);
            }
            $message['validation'] = $valid;
            $this->returnJson($message);
        }

    }

    public function notfound()
    {
        $data['main_content'] = $this->load->view($this->template_path . 'page/_404', NULL, TRUE);
        $this->load->view($this->template_main, $data);
    }
}
