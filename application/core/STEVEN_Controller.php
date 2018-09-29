<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 05/12/2017
 * Time: 4:24 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class STEVEN_Controller extends CI_Controller
{
    public $template_path = '';
    public $template_main = '';
    public $templates_assets = '';

    public function __construct()
    {
        parent::__construct();

        //Load library
        $this->load->library(array('session','form_validation','user_agent'));
        $this->load->helper(array('data','security','url','directory','file','form','datetime','language','debug'));
        $this->config->load('languages');
        //Load database
        $this->load->database();
        if(DEBUG_MODE == TRUE) {
            //Load third party
            $this->load->add_package_path(APPPATH.'third_party', 'codeigniter-debugbar');
            $this->output->enable_profiler(TRUE);
        }
    }

    public function toSlug($doc)
    {
        $str = addslashes(html_entity_decode($doc));
        $str = $this->toNormal($str);
        $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $str = preg_replace("/( )/", '-', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace("\/", '', $str);
        $str = str_replace("+", "", $str);
        $str = strtolower($str);
        $str = stripslashes($str);
        return trim($str, '-');
    }
    public function toNormal($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

}

class Admin_Controller extends STEVEN_Controller
{

    public function __construct()
    {
        parent::__construct();

        //set đường dẫn template
        $this->template_path = 'admin/';
        $this->template_main = $this->template_path.'_layout';
        $this->templates_assets = base_url().'admin/';

        //fix language admin tiếng việt
        $this->session->admin_lang = 'vi';


        //tải thư viện
        $this->load->library(array('ion_auth','breadcrumbs'));
        //load helper
        $this->load->helper(array('authorization', 'image', 'format','link'));
        //Load config
        $this->config->load('seo');
        $this->config->load('permission');

        $configMinify['assets_dir'] = 'public/admin';
        $configMinify['assets_dir_css'] = 'public/admin/css';
        $configMinify['assets_dir_js'] = 'public/admin/js';
        $configMinify['css_dir'] = 'public/admin/css';
        $configMinify['js_dir'] = 'public/admin/js';
        $this->load->library('minify', $configMinify);
        $this->minify->enabled = FALSE;

        $this->check_auth();
    }

    // add log action
    public function addLogAction($action, $note){
        $this->load->model("Log_action_model");
        $logActionModel = new Log_action_model();
        $data['action'] = $action;
        $data['note']   = $note;
        $data['uid']    = $this->session->user_id;
        $logActionModel->save($data);
    }

    public function check_auth(){
        if (!$this->ion_auth->logged_in()) {
            //chưa đăng nhập thì chuyển về page login
            redirect(BASE_ADMIN_URL.'auth/login?url='.urlencode(current_url()), 'refresh');
        }else{
            if($this->ion_auth->in_group(1) != true){
                if(!$this->session->admin_permission){
                    $this->load->model('Groups_model','group');
                    $groupModel = new Groups_model();
                    $group = $groupModel->get_group_by_userid((int) $this->session->userdata('user_id'));
                    $data = $groupModel->getById($group->group_id);
                    if(!empty($data)){
                        $this->session->admin_permission = json_decode($data->permission,true);
                        $this->session->admin_group_id = (int) $group->group_id;
                    }
                }
                $controller = $this->router->fetch_class();
                if(!in_array($controller,array('dashboard'))){
                    if(!$this->session->admin_permission[$controller]['view']){//check quyen view
                        redirect('admin/dashboard/notPermission');
                    }
                }
            }else{
                $this->session->admin_group_id = 1;//ID nhóm admin
            }
        }
    }

}

class Public_Controller extends STEVEN_Controller
{
    public $settings = array();
    public $_message = array();
    public $_controller;
    public $_method;
    public function __construct()
    {
        parent::__construct();

        //set đường dẫn template
        $this->template_path = 'public/default/';
        $this->template_main = $this->template_path.'_layout';
        $this->templates_assets = base_url();

        //load cache driver
        $this->load->driver('cache',array('adapter'=>'file'));

        //tải thư viện
        $this->load->library(array('minify','cart','breadcrumbs'));

        //load helper
        $this->load->helper(array('cookie','link','title','format','image'));

        //Detect mobile
        //$this->detectMobile = new Mobile_Detect();

        //Language
        $lang_code = $this->input->get('lang');
        $lang_cnf = $this->config->item('cms_lang_cnf');
        //set session language
        if(!empty($lang_code) && array_key_exists($lang_code,$lang_cnf)){
            $this->session->public_lang_code = $lang_code;
            $this->session->public_lang_full = $lang_cnf[$lang_code];
        }
        if(empty($this->session->public_lang_code)) {
            //không có lang code thì mặc định hiển thị tiếng việt
            $this->session->public_lang_code = 'vi';
            $this->session->public_lang_full = 'vietnamese';
        }

        $this->config->set_item('language', $this->session->public_lang_full);
        $this->lang->load(array('auth','ion_auth','frontend'));

        //đọc file setting
        $dataSetting = file_get_contents(FCPATH.'config'.DIRECTORY_SEPARATOR.'settings.cfg');
        $dataSetting = $dataSetting ? json_decode($dataSetting,true) : array();
        if(!empty($dataSetting)) foreach ($dataSetting as $key => $item){
            if($key === 'meta'){
                $oneMeta = $item[$this->session->public_lang_code];
                if(!empty($oneMeta)) foreach ($oneMeta as $keyMeta => $value){
                    $this->settings[$keyMeta] = str_replace('"','\'',$value);
                }
            } else
                $this->settings[$key] = $item;
        }
        //Set flash message
        $this->_message = $this->session->flashdata('message');
        if (MAINTAIN_MODE == TRUE) $this->load->view('public/coming_soon');
        $this->minify->enabled = FALSE;

        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();

        $configBreadcrumb['crumb_divider'] = $this->config->item('frontend_crumb_divider');
        $configBreadcrumb['tag_open'] = $this->config->item('frontend_tag_open');
        $configBreadcrumb['tag_close'] = $this->config->item('frontend_tag_close');
        $configBreadcrumb['crumb_open'] = $this->config->item('frontend_crumb_open');
        $configBreadcrumb['crumb_last_open'] = $this->config->item('frontend_crumb_last_open');
        $configBreadcrumb['crumb_close'] = $this->config->item('frontend_crumb_close');
        $this->breadcrumbs->init($configBreadcrumb);

    }

}