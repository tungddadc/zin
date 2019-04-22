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
    public $settings = array();
    public $_controller;
    public $_method;
    public $_message = array();

    public function __construct()
    {
        parent::__construct();

        //Load library
        $this->load->library(array('session', 'form_validation', 'user_agent'));
        $this->load->helper(array('cookie', 'data', 'security', 'url', 'directory', 'file', 'form', 'datetime', 'language', 'debug','text'));
        $this->config->load('languages');
        //Load database
        $this->load->database();

        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();

        //load cache driver
        if (CACHE_MODE == TRUE) $this->load->driver('cache',array('adapter' => CACHE_ADAPTER, 'backup' => 'file', 'key_prefix' => CACHE_PREFIX_NAME));

    }

    public function checkRequestGetAjax()
    {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'))
            die('Not Allow');;
    }

    public function checkRequestPostAjax()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST'
            || empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
        )
            die('Not Allow');
    }

    public function returnJson($data = null)
    {
        if ($this->config->item('csrf_protection') == TRUE) {
            $csrf = [
                'csrf_form' => [
                    'csrf_name' => $this->security->get_csrf_token_name(),
                    'csrf_value' => $this->security->get_csrf_hash()
                ]
            ];
            if (empty($data)) $data = $this->_message;
            $data = array_merge($csrf, (array)$data);
        }
        die(json_encode($data));
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

    public function cUrl($url, array $post_data = array(), $delete = false, $verbose = false, $ref_url = false, $cookie_location = false, $return_transfer = true)
    {
        $pointer = curl_init();

        curl_setopt($pointer, CURLOPT_URL, $url);
        curl_setopt($pointer, CURLOPT_TIMEOUT, 40);
        curl_setopt($pointer, CURLOPT_RETURNTRANSFER, $return_transfer);
        curl_setopt($pointer, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.28 Safari/534.10");
        curl_setopt($pointer, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($pointer, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($pointer, CURLOPT_HEADER, false);
        curl_setopt($pointer, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($pointer, CURLOPT_AUTOREFERER, true);

        if ($cookie_location !== false) {
            curl_setopt($pointer, CURLOPT_COOKIEJAR, $cookie_location);
            curl_setopt($pointer, CURLOPT_COOKIEFILE, $cookie_location);
            curl_setopt($pointer, CURLOPT_COOKIE, session_name() . '=' . session_id());
        }

        if ($verbose !== false) {
            $verbose_pointer = fopen($verbose, 'w');
            curl_setopt($pointer, CURLOPT_VERBOSE, true);
            curl_setopt($pointer, CURLOPT_STDERR, $verbose_pointer);
        }

        if ($ref_url !== false) {
            curl_setopt($pointer, CURLOPT_REFERER, $ref_url);
        }

        if (count($post_data) > 0) {
            curl_setopt($pointer, CURLOPT_POST, true);
            curl_setopt($pointer, CURLOPT_POSTFIELDS, $post_data);
        }
        if ($delete !== false) {
            curl_setopt($pointer, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $return_val = curl_exec($pointer);

        $http_code = curl_getinfo($pointer, CURLINFO_HTTP_CODE);

        if ($http_code == 404) {
            return false;
        }

        curl_close($pointer);

        unset($pointer);

        return $return_val;
    }

    public function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'steven_secret_key';
        $secret_iv = 'steven_secret_iv';
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

}

class Admin_Controller extends STEVEN_Controller
{

    public function __construct()
    {
        parent::__construct();

        //set đường dẫn template
        $this->template_path = 'admin/';
        $this->template_main = $this->template_path . '_layout';
        $this->templates_assets = base_url() . 'public/admin/';

        //Language
        $this->switchLanguage($this->input->get('lang'));

        //tải thư viện
        $this->load->library(array('ion_auth', 'breadcrumbs'));
        //load helper
        $this->load->helper(array('authorization', 'image', 'format', 'link'));
        //Load config
        $this->config->load('seo');
        $this->config->load('permission');


        /*$configMinify['assets_dir'] = 'public/admin';
        $configMinify['assets_dir_css'] = 'public/admin/css';
        $configMinify['assets_dir_js'] = 'public/admin/js';
        $configMinify['css_dir'] = 'public/admin/css';
        $configMinify['js_dir'] = 'public/admin/js';
        $this->load->library('minify', $configMinify);
        $this->minify->enabled = FALSE;*/

        $this->check_auth();
    }

    public function check_auth()
    {
        //die('check auth');
        if (($this->_controller !== 'user'
                || ($this->_controller === 'user' && !in_array($this->_method, ['login', 'ajax_login','logout']))
        ) && !$this->ion_auth->logged_in()) {
            //chưa đăng nhập thì chuyển về page login
            redirect(site_admin_url('user/login') . '?url=' . urlencode(current_url()), 'refresh');
        } else {
            if ($this->ion_auth->logged_in()) {
                //if ($this->session->admin_group_id === 2) redirect(site_url());
                if ($this->ion_auth->in_group(1) != true) {
                    if (!$this->session->admin_permission) {
                        $this->load->model('Groups_model', 'group');
                        $groupModel = new Groups_model();
                        $group = $groupModel->get_group_by_userid((int)$this->session->userdata('user_id'));
                        $data = $groupModel->getById($group->group_id);
                        if (!empty($data)) {
                            $this->session->admin_permission = json_decode($data->permission, true);
                            $this->session->admin_group_id = (int)$group->group_id;
                        }
                    }
                    if (!in_array($this->_controller, array('dashboard')) && $this->_method !== 'logout') {
                        if (!$this->session->admin_permission[$this->_controller]['view']) {//check quyen view
                            $this->load->view($this->template_main, ['main_content' => $this->load->view($this->template_path.'not_permission', [], TRUE)]);
                        }
                    }
                } else {
                    $this->session->admin_group_id = 1;//ID nhóm admin
                }
            }


        }
    }

    public function switchLanguage($lang_code = "")
    {
        $language_code = !empty($lang_code) ? $lang_code : $this->config->item('language_default');
        $this->session->set_userdata('admin_lang', $language_code);
        $languageFolder = $this->config->item('language_folder')[$language_code];
        $this->session->set_userdata('admin_lang_folder', $languageFolder);
        if (!empty($lang_code)) redirect($_SERVER['HTTP_REFERER']);
    }

    // add log action
    public function addLogAction($action, $note)
    {
        $this->load->model("Log_action_model");
        $logActionModel = new Log_action_model();
        $data['action'] = $action;
        $data['note'] = $note;
        $data['uid'] = $this->session->user_id;
        $logActionModel->save($data);
    }

}

class Public_Controller extends STEVEN_Controller
{
    public $_user_login = array();

    public function __construct()
    {
        parent::__construct();

        //set đường dẫn template
        $this->template_path = 'public/default/';
        $this->template_main = $this->template_path . '_layout';
        $this->templates_assets = base_url() . 'public/';

        //tải thư viện
        $this->load->library(array('minify', 'cart', 'breadcrumbs'));

        //load helper
        $this->load->helper(array('navmenus', 'link', 'title', 'format', 'image'));

        //Language
        $this->switchLanguage($this->input->get('lang'));

        //Detect mobile
        //$this->detectMobile = new Mobile_Detect();

        //Setting
        $this->load->model('setting_model');
        $this->settings = $this->setting_model->getAll();

        //Set flash message
        $this->_message = $this->session->flashdata('message');
        if (MAINTAIN_MODE == TRUE) {
            $this->load->view('public/coming_soon');
        }
        if(DEBUG_MODE == FALSE) $this->minify->enabled = TRUE;
        else $this->minify->enabled = FALSE;

        $configBreadcrumb['crumb_divider'] = $this->config->item('frontend_crumb_divider');
        $configBreadcrumb['tag_open'] = $this->config->item('frontend_tag_open');
        $configBreadcrumb['tag_close'] = $this->config->item('frontend_tag_close');
        $configBreadcrumb['crumb_open'] = $this->config->item('frontend_crumb_open');
        $configBreadcrumb['crumb_first_open'] = $this->config->item('frontend_crumb_first_open');
        $configBreadcrumb['crumb_last_open'] = $this->config->item('frontend_crumb_last_open');
        $configBreadcrumb['crumb_close'] = $this->config->item('frontend_crumb_close');
        $this->breadcrumbs->init($configBreadcrumb);


        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if (!empty($this->session->userdata['is_logged']) && $this->session->userdata['is_logged'] === true) {
            $this->load->model('users_model');
            $userModel = new Users_model();
            $this->_user_login = $userModel->getUserByField('id', $this->session->userdata['user_id']);
        }


        if (DEBUG_MODE == TRUE) {
            if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')) {
                $this->load->add_package_path(APPPATH . 'third_party', 'codeigniter-debugbar');
                $this->output->enable_profiler(TRUE);
            }
        }
    }

    public function switchLanguage($lang_code = "")
    {
        $language_code = !empty($lang_code) ? $lang_code : $this->config->item('language_default');
        $this->session->set_userdata('public_lang_code', $language_code);
        $languageFolder = $this->config->item('public_lang_folder')[$language_code];
        $this->session->set_userdata('admin_lang_folder', $languageFolder);
        if (!empty($lang_code)) redirect($_SERVER['HTTP_REFERER']);
    }

    public function getUrlLogin()
    {
        $url = $this->zalo->getUrlLogin();
        return $url;
    }

    function alpha_numeric_space($str)
    {
        if (preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\+=\{\}\[\]\|;:"\<\>\.\?\\\]/', $str)) {
            $this->form_validation->set_message('alpha_numeric_space', '%s không được chứa ký tự đặc biệt');
            return false;
        }
        return true;
    }


    /**
     * @return array A CSRF key-value pair
     */
    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);
        return array($key => $value);
    }

    /**
     * @return bool Whether the posted CSRF token matches
     */
    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function sendMail($to_mail, $subject, $contentHtml, $emailToCC = '', $emailToBCC = '')
    {
        try {
            $this->load->library('email');
            if (!empty($this->settings['protocol'])) {
                $this->email->protocol = $this->settings['protocol'];
                $this->email->smtp_host = $this->settings['smtp_host'];
                $this->email->smtp_user = $this->settings['smtp_user'];
                $this->email->smtp_port = $this->settings['smtp_port'];
            }
            if (!empty($this->settings['email_admin'])) {
                $from_mail = $this->settings['email_admin'];
            } else {
                $from_mail = $this->email->smtp_user;
            }
            $this->email->from($from_mail);
            $this->email->to($to_mail);
            if (!empty($emailToCC)) $this->email->cc($emailToCC);
            if (!empty($emailToBCC)) $this->email->bcc($emailToBCC);
            $this->email->subject($subject);
            $this->email->message($contentHtml);
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $this->_message = array(
                'type' => 'danger',
                'message' => 'Co lỗi khi gửi mail'
            );
        }
    }
}