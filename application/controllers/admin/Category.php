<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends Admin_Controller
{
    protected $_data;
    protected $category_tree;

    const STATUS_CANCEL = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;
    public function __construct()
    {
        parent::__construct();
        //tải thư viện
        //$this->lang->load('category');
        $this->load->model(['category_model']);
        $this->_data = new Category_model();
    }

    public function get_list($data){
        $this->session->set_userdata('type',$this->_method);
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . 'index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function post(){
        $data['heading_title'] = "Danh mục bài viết";
        $data['heading_description'] = "Danh sách danh mục";
        $this->get_list($data);
    }

  public function faq(){
    $data['heading_title'] = "Danh mục hỏi đáp";
    $data['heading_description'] = "Danh sách danh mục";
    $this->get_list($data);
  }

    public function product(){
        $data['heading_title'] = "Danh mục sản phẩm";
        $data['heading_description'] = "Danh sách danh mục";
        $this->get_list($data);
    }

    public function brand(){
        $data['heading_title'] = "Danh mục thương hiệu";
        $data['heading_description'] = "Danh sách thương hiệu";
        $this->get_list($data);
    }


    public function _queue($categories, $parent_id = 0, $char = ''){
        if(!empty($categories)) foreach ($categories as $key => $item)
        {
            if ($item->parent_id == $parent_id)
            {
                $tmp['title'] = $char.$item->title;
                $tmp['value'] = $item;
                $this->category_tree[] = $tmp;
                unset($categories[$key]);
                $this->_queue($categories,$item->id,$char.'  '.$item->title.' <i class="fa fa-fw fa-caret-right"></i> ');
            }

        }
    }

    public function _queue_select($categories, $parent_id = 0, $char = ''){
        if(!empty($categories)) foreach ($categories as $key => $item)
        {
            if ($item->parent_id == $parent_id)
            {
                $tmp['title'] = $parent_id ? '  |--'.$char.$item->title : $char.$item->title;
                $tmp['id'] = $item->id;
                $tmp['thumbnail'] = $item->thumbnail;
                $this->category_tree[] = $tmp;
                unset($categories[$key]);
                $this->_queue_select($categories,$item->id,$char.'--');
            }
        }
    }



    public function ajax_list(){
        $this->checkRequestPostAjax();
        $data = array();
        $pagination = $this->input->post('pagination');
        $page = $pagination['page'];
        $total_page = isset($pagination['pages']) ? $pagination['pages'] : 1;
        $limit = !empty($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 1;

        $queryFilter = $this->input->post('query');
        $params = [
            'parent_id' => !empty($queryFilter['category_id']) ? $queryFilter['category_id'] : '',
            'type'      => $this->session->userdata('type'),
            'search'    => !empty($queryFilter['generalSearch']) ? $queryFilter['generalSearch'] : '',
            'limit'     => 2000
        ];
        if(isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
            $params = array_merge($params,['is_status' => $queryFilter['is_status']]);

        $listAll = $this->_data->getData($params);

        if(empty($queryFilter)){
            $this->_queue($listAll);
            $listData = $this->category_tree;
            $offset = ($page-1)*$limit;
            if(!empty($listData))
                $listData = array_slice($listData,$offset,$limit);
        }else{
            $listData = $listAll;
        }

        if(!empty($listData)) foreach ($listData as $category) {
            if(empty($queryFilter)){
                $item = $category['value'];
                $title = $category['title'];
            }else{
                $item = $category;
                $title = $category->title;
            }
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['title'] = $title;
            $row['is_status'] = $item->is_status;
            $row['updated_time'] = $item->updated_time;
            $row['created_time'] = $item->created_time;
            $data[] = $row;
        }

        $output = [
            "meta" => [
                "page"      => $page,
                "pages"     => $total_page,
                "perpage"   => $limit,
                "total"     => $this->_data->getTotal($params),
                "sort"      => "asc",
                "field"     => "id"
            ],
            "data" =>  $data
        ];

        $this->returnJson($output);
    }

    public function ajax_load($type = ''){
        $term = $this->input->get("q");
        $id = $this->input->get('id')?$this->input->get('id'):0;
        if(empty($type)) $this->session->userdata('type');
        $params = [
            'type' => !(empty($type)) ? $type : null,
            'is_status'=> 1,
            'not_in' => ['id' => $id],
            'limit'=> 2000
        ];

        if($type === 'brand') $params = array_merge($params,['search' => $term]);
        $list = $this->_data->getData($params);
        if($type === 'brand'){
            $listTree = $list;
        }else{
            $this->_queue_select($list);
            $listTree = $this->category_tree;
            if(!empty($term)){
                $searchword = $term;
                $matches = array();
                foreach($listTree as $k=>$v) {
                    if(preg_match("/\b$searchword\b/i", $v['title'])) {
                        $matches[$k] = $v;
                    }
                }
                $listTree = $matches;
            }
        }
        $output = [];
        if(!empty($listTree)) foreach ($listTree as $item) {
            $item = (object) $item;
            $output[] = ['id'=>$item->id, 'text'=>$item->title];
        }
        $this->returnJson($output);
    }

    private function save_language($id, $data){
        if(!empty($data)) foreach ($data as $lang_code => $item){
            $data_trans = array_merge($item,['id'=>$id,'language_code' => $lang_code]);
            if(!$this->_data->insertOnUpdate($data_trans, $this->_data->table_trans)){
                $message['type'] = 'error';
                $message['message'] = "Thêm {$this->_data->table_trans} thất bại !";
                log_message('error', $message['message'] . '=>' . json_encode($data_trans));
                $this->returnJson($message);
            }
        }
    }
    public function ajax_add(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $data_trans = $data['language'];
        unset($data['language']);
        if($id = $this->_data->save($data)){
            $this->save_language($id, $data_trans);
            $message['type'] = 'success';
            $message['message'] = "Thêm mới thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Thêm mới thất bại !";
        }
        $this->returnJson($message);
    }

    public function ajax_edit(){
        $this->checkRequestPostAjax();
        $id = $this->input->post('id');
        if(!empty($id)){
            $output['data_info'] = $this->_data->single(['id' => $id],$this->_data->table);
            $output['data_language'] = $this->_data->getDataAll(['id' => $id],$this->_data->table_trans);
            $output['data_category'] = $this->_data->getSelect2($output['data_info']->parent_id);
            $this->returnJson($output);
        }
    }

    public function ajax_update(){
        $this->checkRequestPostAjax();
        $data = $this->_convertData();
        $id = $data['id'];
        $data_trans = $data['language'];
        unset($data['language']);
        if($this->_data->update(['id' => $id],$data, $this->_data->table)){
            $this->save_language($id, $data_trans);
            $message['type'] = 'success';
            $message['message'] = "Cập nhật thành công !";
        }else{
            $message['type'] = 'error';
            $message['message'] = "Cập nhật thất bại !";
        }
        $this->returnJson($message);
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

    private function _validation(){
        $this->checkRequestPostAjax();
        $language_rules = [];
        if(!empty($this->config->item('language_name'))) foreach ($this->config->item('language_name') as $lang_code => $lang_name){
            if ($lang_code === $this->config->item('language_default')) {
                $language_rules = [
                    [
                        'field' => "language[$lang_code][title]",
                        'label' => "Tiêu đề ($lang_name)",
                        'rules' => "trim|required|min_length[2]|max_length[{$this->config->item('SEO_title_maxlength')}]"
                    ],[
                        'field' => "language[$lang_code][slug]",
                        'label' => "Đường dẫn ($lang_name)",
                        'rules' => "trim|required"
                    ],[
                        'field' => "language[$lang_code][description]",
                        'label' => "Tóm tắt ($lang_name)",
                        'rules' => 'trim|required'
                    ],[
                        'field' => "language[$lang_code][meta_title]",
                        'label' => "Tiêu đề SEO ($lang_name)",
                        'rules' => "trim|required|min_length[2]|max_length[{$this->config->item('SEO_title_maxlength')}]"
                    ],[
                        'field' => "language[$lang_code][meta_description]",
                        'label' => "Mô tả SEO ($lang_name)",
                        'rules' => "trim|required|min_length[2]|max_length[{$this->config->item('SEO_description_maxlength')}]"
                    ]
                ];
            }
        }
        $rules = [];
        $rules = array_merge($rules, $language_rules);
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $message['type'] = "warning";
            $message['message'] = "Vui lòng kiểm tra lại thông tin vừa nhập.";
            $valid = array();
            if(!empty($rules)) foreach ($rules as $item){
                if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $message['validation'] = $valid;
            $this->returnJson($message);
        }
    }

    private function _convertData(){
        $this->_validation();
        $data = $this->input->post();
        $data['type'] = $this->session->userdata('type');
        if(!empty($data['is_status'])) $data['is_status'] = 1;else $data['is_status'] = 0;
        if(empty($data['parent_id'])) $data['parent_id'] = 0;
        if(isset($data['album'])) {
            $data['banner'] = json_encode($data['album']);
            unset($data['album']);
        }
        return $data;
    }
}