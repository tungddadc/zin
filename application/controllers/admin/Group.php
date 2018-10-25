<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Group extends Admin_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        //$this->lang->load('group');
        $this->load->model(['groups_model']);
        $this->_data = new Groups_model();
    }

    public function index(){
        $data['heading_title'] = "Quản lý nhóm";
        $data['heading_description'] = 'Danh sách nhóm quyền';
        $data['main_content'] = $this->load->view($this->template_path . $this->_controller . DIRECTORY_SEPARATOR . $this->_method, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function ajax_list(){
        $this->checkRequestPostAjax();
        $data = array();
        $pagination = $this->input->post('pagination');
        $page = $pagination['page'];
        $total_page = isset($pagination['pages']) ? $pagination['pages'] : 1;
        $limit = !empty($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 1;
        $params = [
            'page'      => $page,
            'limit'     => $limit
        ];
        $listData = $this->_data->getData($params);
        if(!empty($listData)) foreach ($listData as $item) {
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['description'] = $item->description;
            $row['is_status'] = $item->active;
            $row['updated_time'] = $item->updated_time;
            $row['created_time'] = $item->created_time;
            $data[] = $row;
        }

        $output = [
            "meta" => [
                "page"      => $page,
                "pages"     => $total_page,
                "perpage"   => $limit,
                "total"     => $this->_data->getTotal(),
                "sort"      => "asc",
                "field"     => "id"
            ],
            "data" =>  $data
        ];

        $this->returnJson($output);
    }

    public function ajax_load(){
        $this->checkRequestGetAjax();
        $term = $this->input->get("q");
        $params = [
            'is_status'=> 1,
            'search' => $term,
            'limit'=> 10
        ];
        $data = $this->_data->getData($params);
        $output = [];
        if(!empty($data)) foreach ($data as $item) {
            $output[] = ['id'=>$item->id, 'text'=>$item->name];
        }
        $this->returnJson($output);
    }
}