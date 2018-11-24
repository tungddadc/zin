<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 17/12/2017
 * Time: 12:08 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends Admin_Controller
{
    protected $_data;
    protected $_data_account;
    protected $_name_controller;

    const STATUS_CANCEL = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('ion_auth'));
        $this->lang->load('comments');
        $this->load->model(['comments_model', 'users_model']);
        $this->_data = new Comments_model();
        $this->_data_account = new Users_model();
        $this->_name_controller = $this->router->fetch_class();
    }

    public function index()
    {
        $data['heading_title'] = ucfirst($this->_name_controller);
        $data['heading_description'] = "Danh sách $this->_name_controller";
        /*Breadcrumbs*/
        $this->breadcrumbs->push('Home', base_url());
        $this->breadcrumbs->push($data['heading_title'], '#');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*Breadcrumbs*/
        $data['main_content'] = $this->load->view($this->template_path . $this->_name_controller . '/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    /*
     * Ajax trả về datatable
     * */
    public function ajax_list()
    {
        $this->checkRequestPostAjax();
        $pagination = $this->input->post('pagination');
        $page = $pagination['page'];
        $total_page = isset($pagination['pages']) ? $pagination['pages'] : 1;
        $limit = !empty($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 1;

        $queryFilter = $this->input->post('query');
        $params = [
            'search'    => !empty($queryFilter['generalSearch']) ? $queryFilter['generalSearch'] : '',
            'page' => $page,
            'limit' => $limit,
            'parent_id' => 0

        ];
        if(isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
            $params = array_merge($params,['is_status' => $queryFilter['is_status']]);


        $list = $this->_data->getData($params);
        $data = array();
        if (!empty($list)) foreach ($list as $item) {
            $oneUser = $this->_data_account->getById($item->account_id, '*', $this->session->admin_lang);
            $row = array();
            $row['checkID'] = $item->id;
            $row['id'] = $item->id;
            $row['fullname'] = (!empty($oneUser)) ? $oneUser->fullname : '';
            $row['content'] = $item->content;
            $row['is_status'] = $item->is_status;
            $row['updated_time'] = $item->updated_time;
            $row['created_time'] = $item->created_time;
            $data[] = $row;
        }

        $output = [
            "meta" => [
                "page" => $page,
                "pages" => $total_page,
                "perpage" => $limit,
                "total" => $this->_data->getTotal(),
                "sort" => "asc",
                "field" => "id"
            ],
            "data" => $data
        ];

        $this->returnJson($output);

    }

    public function ajax_edit($id)
    {
        $data['comment'] = (array)$this->_data->getById($id);
        $oneUser = $this->_data_account->getById($data['comment']['account_id'], '*', $this->session->admin_lang);
        $data['comment']['account_id'] = !empty($oneUser) ? $oneUser->fullname : '';
        $data['comment']['created_time'] = timeAgo($data['comment']['created_time']);
        // dd($data);
        die(json_encode($data));
    }

    public function ajax_ListRepCommnet($id)
    {
        $data['data'] = $this->_data->get_by_comment_id($id);
        echo $this->load->view($this->template_path . 'comments/item_list_rep_comment', $data, TRUE);
        exit;
    }

    public function ajax_ListRep()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $data = $this->input->post();
            $data['account_id'] = 1;
            $data['is_status'] = 1;
            $html = '';
            if (!empty($data)) {
                $html = '<li id="list">
        <div class="comment-avatar"><img src="https://gravatar.com/avatar/412c0b0ec99008245d902e6ed0b264ee?s=80" alt=""></div>
        <div class="comment-box">
        <div class="comment-head">
        <h6 class="comment-name by-reply"><a href="javascript:;">Admin</a></h6>
        <a href="javascript:;"><i class="fa fa-trash"></i></a>                        
        </div>
        <div class="comment-content">' . $data['content'] . '</div>
        </div>
        </li>';
                $response = $this->_data->save($data);
                $status = true;
                $data_mess = array(
                    'stauts' => $status,
                    'html' => $html,
                    'mess' => 'Bình luận thành công'
                );
            } else {
                $data_mess = array(
                    'mess' => 'Lỗi vui lòng thử lại'
                );
            }
            echo json_encode($data_mess);
        }
        exit;
    }

    public function ajax_update_field()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->input->post('id');
            $field = $this->input->post('field');
            $value = $this->input->post('value');
            $response = $this->_data->update(['id' => $id], [$field => $value]);
            if ($response != false) {
                $message['type'] = 'success';
                $message['message'] = 'Cập nhật thành công!';
            } else {
                $message['type'] = 'error';
                $message['message'] = 'Cập nhật không thành công!';
            }
            print json_encode($message);
        }
        exit;
    }

    public function ajax_delete()
    {
        $this->checkRequestPostAjax();
        $id = (int)$this->input->post('id');
        $response = $this->_data->delete(['id' => $id]);
        if ($response != false) {
            //Xóa translate của comments
            $this->_data->delete(["id" => $id], $this->_data->table_trans);
            // Xóa parent_id comments
            $this->_data->delete(["parent_id" => $id], $this->_data->table_trans);
            // log action

            $message['type'] = 'success';
            $message['message'] = 'Xóa thành công!';
        } else {
            $message['type'] = 'error';
            $message['message'] = 'Xóa không thành công';
            $message['error'] = $response;
            log_message('error', $response);
        }
        die(json_encode($message));
    }


}
