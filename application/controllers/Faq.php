<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Public_Controller
{
    protected $cid = 0;
    protected $_data;
    protected $_data_category;
    protected $_lang_code;
    protected $_all_category;

    public function __construct()
    {
        parent::__construct();
        //tải model
        $this->load->model(['category_model', 'faq_model']);
        $this->_data = new Faq_model();
        $this->_data_category = new Category_model();
        //$this->session->category_type = 'post';
        //Check xem co chuyen lang hay khong thi set session lang moi
        if ($this->input->get('lang'))
            $this->_lang_code = $this->input->get('lang');
        else
            $this->_lang_code = $this->session->public_lang_code;

        if (!$this->cache->get('_all_category_' . $this->session->public_lang_code)) {
            $this->cache->save('_all_category_' . $this->session->public_lang_code, $this->_data_category->getAll($this->session->public_lang_code), 60 * 60 * 30);
        }
        $this->_all_category = $this->cache->get('_all_category_' . $this->session->public_lang_code);
    }

    public function category($id, $page = 1)
    {
        $oneItem = $this->_data_category->getById($id, '*', $this->_lang_code);
        if (empty($oneItem)) show_404();
        $data['oneItem'] = $oneItem;
        $data['oneParent'] = $oneParent = $this->_data_category->_recursive_one_parent($this->_all_category, $id);
        if (!empty($oneParent)) $this->_data_category->_recursive_child($this->_all_category, $oneParent->id);
        /*Lay list id con của category*/
        $this->_data_category->_recursive_child_id($this->_all_category, $id);
        $data['listCateId'] = $listCateId = $this->_data_category->_list_category_child_id;
        /*Lay list id con của category*/
        $limit = 10;
        $params = array(
            'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
            'lang_code' => $this->_lang_code,
            'category_id' => $listCateId,
            'limit' => $limit,
            'key_search' => !empty($this->input->get('key_search')) ? $this->input->get('key_search') : '',
            'order' => ['created_time' => 'desc'],
            'page' => $page
        );
        $data['data'] = $this->_data->getData($params);
        $data['total'] = $this->_data->getTotal($params);

        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlCateFaq($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];
        $layoutView = '';
        if (!empty($oneItem->style)) $layoutView = '-' . $oneItem->style;
        $data['main_content'] = $this->load->view($this->template_path . 'faq/category' . $layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }


    public function detail($id)
    {
        $oneItem = $this->_data->getById($id, '', $this->_lang_code);
        if ($this->input->get('lang')) {
            redirect(getUrlNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }
        $data['oneCategory'] = $oneCategory = $this->_data->getOneCateIdById($id);

        $data['listCategory'] = $listCategory = $this->_data->getCateIdById($id);
        foreach ($data['listCategory'] as $key => $value) {
            $list_cate = $value;
            // dump($list_cate);
        }
        $list_category_child = array();
        if (!empty($data['oneCategory'])) $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_all_category, $data['oneCategory']->id);
        if (!empty($data['oneParent'])) {
            $data['list_category_child'] = $list_category_child = $this->_data_category->getCategoryChild($data['oneParent']->id, $this->session->public_lang_code);
        }

        $data['oneItem'] = $oneItem;
        $params['is_status'] = 1;
        $params['category_id'] = $oneCategory->id;
        $params['lang_code'] = $this->_lang_code;
        $params['limit'] = 5;
        $params['group_by'] = 'id';
        $params['order'] = ['created_time' => 'desc'];
        $params['not_in'] = $id;

        $data['list_related'] = $this->_data->getData(array_merge($params, $list_category_child));
        $params['order'] = array('is_featured' => 'DESC', 'created_time' => 'DESC');
        $data['list_fetured'] = $this->_data->getData($params);
        //add breadcrumbs
        $this->breadcrumbs->push("<i class='icon_house_alt'></i>", base_url());
        if (!empty($oneCategory)) $this->_data_category->_recursive_parent($this->_all_category, $oneCategory->id);
        if (!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item) {
            $this->breadcrumbs->push($item->title, getUrlCateNews($item));
        }
        $this->breadcrumbs->push($oneItem->title, getUrlNews($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_title) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];
        if (!empty($oneCategoryParent->style)) $layoutView = '-' . $oneCategoryParent->style;
        else {
            if (!empty($oneCategory->style)) $layoutView = '-' . $oneCategory->style;
            else $layoutView = '';
        }
        $data['main_content'] = $this->load->view($this->template_path . 'faq/detail' . $layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function question($id)
    {
        $this->load->model('question_model');
        $questionModel = new Question_model();
        $data['oneItem'] = $oneItem = $questionModel->getById($id);
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->title) ? $oneItem->title : $oneItem->title,
            'meta_description' => !empty($oneItem->title) ? $oneItem->title : $oneItem->title,
            'meta_keyword' => !empty($oneItem->title) ? $oneItem->title : '',
            'url' => getUrlQuestion($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];
        $data['main_content'] = $this->load->view($this->template_path . 'faq/question', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function add_ask()
    {
        $data = $this->_convertData();

        $this->load->model('question_model');
        $questionModel = new Question_model();
        $questionModel->save($data);
        $this->_message = array(
            'type' => 'success',
            'message' => 'Đặt đâu hỏi thành công.',
        );
        $this->returnJson($this->_message);
    }

    private function _validate()
    {
        $this->checkRequestPostAjax();
        $rules = array(
            array(
                'field' => "title",
                'label' => "Tiêu đề",
                'rules' => "required|trim"
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === false) {
            $valid = array();
            if (!empty($rules)) foreach ($rules as $item) {
                if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $this->_message = array(
                'type' => 'warning',
                'message' => 'Tiêu đề không được để trống.',
            );
            $this->returnJson($this->_message);
        }
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
        $data['is_status'] = 2;
        $data['account_id'] = $this->session->userdata['user_id'];
        $data['thumbnail'] = $this->do_upload();
        return $data;
    }

    public function do_upload()
    {
        if (!empty($_FILES)) {
            $avatar = '';
            $dir = 'public/media/ask';
            if (!is_dir($dir)) {
                mkdir('public/media/ask', '0755');
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
                $avatar = 'ask/' . $data['file_name'];
            }
            return $avatar;
        } else {
            return '';
        }
    }

}
