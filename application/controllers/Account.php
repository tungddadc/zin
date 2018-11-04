<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 19/01/2018
 * Time: 10:41 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends Public_Controller
{
    protected $_ion_auth;
    protected $_data;
    protected $_account_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['hybridauth','ion_auth']);
        $this->load->model(array('users_model', 'category_model'));
        $this->_data = new Users_model();
        $this->_account_id = $this->session->userdata('account')['user_id'];
    }


    public function index(){
        if($this->session->userdata('is_logged') != true) redirect();
        $data['title'] = $title = "Trung tâm cá nhân";

        $data['account'] = $this->_data->getUserByField('id', $this->_account_id);
        $data['data_download'] = $this->downloadRecently();
        $data['data_recommend'] = $this->productRecommend();
        $data['data_faqs'] = $this->faqs();
        /*Breadcrumb*/
        $this->breadcrumbs->push($this->lang->line('home'), base_url());
        $this->breadcrumbs->push($title, base_url('account'));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        /*Breadcrumb*/

        //SEO Meta
        $data['SEO'] = [
            'meta_title' => $title,
            'meta_description' => $title,
            'meta_keyword' => $title,
            'url' => base_url('account'),
            'image' => getImageThumb('', 400, 200)
        ];

        $data['main_content'] = $this->load->view($this->template_path . 'account/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function profile($id){
        $data['title'] = $title = "Profile";


        /*Breadcrumb*/
        $this->breadcrumbs->push($this->lang->line('home'), base_url());
        $this->breadcrumbs->push($title, base_url('account'));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        /*Breadcrumb*/

        //SEO Meta
        $data['SEO'] = [
            'meta_title' => $title,
            'meta_description' => $title,
            'meta_keyword' => $title,
            'url' => base_url('account'),
            'image' => getImageThumb('', 400, 200)
        ];

        $data['main_content'] = $this->load->view($this->template_path . 'account/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function favourites($collectionId = '', $page = 1){
        if($this->session->userdata('is_logged') != true) redirect();
        $data['title'] = $title = "Yêu thích";

        $this->load->model('product_model');
        $productModel = new Product_model();

        if(!empty($collectionId)){//Chi tiết collection và list product đã favourite theo collection
            $data['oneItem'] = $this->_data->single(['id' => $collectionId], $this->_data->table_collection);
            $data['page'] = $page;
            $data['limit'] = $limit = 8;
            $params = array(
                'lang_code' => $this->session->public_lang_code,
                'is_status' => 1,
                'collection_id'=> $collectionId,
                'page' => $page,
                'limit' => $limit
            );
            $data['data'] = $productModel->getData($params);
            $data['total'] = $productModel->getTotal($params);

            /*Pagination*/
            $this->load->library('pagination');
            $paging['base_url'] = base_url('account/favourites/'.$collectionId);
            $paging['first_url'] = base_url('account/favourites/'.$collectionId.'/1');
            $paging['total_rows'] = $data['total'];
            $paging['per_page'] = $limit;
            $this->pagination->initialize($paging);
            $data['pagination'] = $this->pagination->create_links();
            /*Pagination*/

            //SEO Meta
            $data['SEO'] = [
                'meta_title' => $title,
                'meta_description' => $title,
                'meta_keyword' => $title,
                'url' => base_url('account/order_history'),
                'image' => getImageThumb('', 400, 200)
            ];

            // Kiểm tra nếu là ajax request thì trả kết quả
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                $html = $this->load->view($this->template_path . 'account/favourite_detail', $data, TRUE);
                print $html; exit;
            }else{
                $data['main_content'] = $this->load->view($this->template_path . 'account/favourite_detail', $data, TRUE);
                $this->load->view($this->template_main, $data);
            }

        }else{ //Data danh sách collection
            $listCollectionByUser = $this->_data->getCollectionByUser($this->_account_id);
            if(!empty($listCollectionByUser)) foreach ($listCollectionByUser as $item){ //Foreach list collection
                $params = array(
                    'lang_code' => $this->session->public_lang_code,
                    'is_status' => 1,
                    'collection_id'=> $item->id,
                    'limit' => 4
                );
                $data['listProductByCollection'][$item->id] = $productModel->getData($params);
            }
            $data['data'] = $listCollectionByUser;
            $data['total'] = $this->_data->getCountCollectionByUser($this->_account_id);
            $data['total_favourite'] = $this->_data->getCountFavouriteByUser($this->_account_id);

            //SEO Meta
            $data['SEO'] = [
                'meta_title' => $title,
                'meta_description' => $title,
                'meta_keyword' => $title,
                'url' => base_url('account/order_history'),
                'image' => getImageThumb('', 400, 200)
            ];

            $data['main_content'] = $this->load->view($this->template_path . 'account/favourites', $data, TRUE);
            $this->load->view($this->template_main, $data);
        }
    }

    public function ajax_form_login(){
        $this->checkRequestPostAjax();
        $identity = $this->input->post('identity');
        $rules = array(
            array(
                'field' => 'identity',
                'label' => 'Tên tài khoản hoặc email',
                'rules' => (strpos($identity, '@') === false) ? 'required|trim' : 'required|trim|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'mật khẩu',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() != false) {
            /*Check login*/

            if ($this->ion_auth->login($identity, $this->input->post('password'))) {
                if(strpos($identity, '@') === false) $account = $this->_data->getUserByField('username', $identity);
                else $account = $this->_data->getUserByField('email', $identity);
                //if the login is successful

                //redirect them back to the home page
                $this->session->set_userdata('is_logged', true);
                $accountArray = array(
                    'account' => array(
                        'account_id' => $account->id,
                        'identity' => $account->id,
                        'avatar' => $account->avatar,
                        'fullname' => $account->fullname,
                        'username' => $account->username
                    )
                );
                $this->session->set_userdata($accountArray);

                $message['type'] = 'success';
                $message['message'] = strip_tags($this->ion_auth->messages());
            } else {
                $message['type'] = 'error';
                $message['message'] = strip_tags($this->ion_auth->errors());
            }
            $this->returnJson($message);
        }else{
            $message['type'] = "warning";
            $message['message'] = $this->lang->line('mess_validation');
            $valid = array();
            if(!empty($rules)) foreach ($rules as $item){
                if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $message['validation'] = $valid;
            $this->returnJson($message);
        }
    }

    public function ajax_form_forget_password(){
        if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|trim|valid_email'
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() != false) {
                $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));
                if ($forgotten) { //if there were no errors
                    $message['type'] = 'success';
                    $message['message'] = strip_tags($this->ion_auth->messages());
                }
                else {
                    $message['type'] = 'error';
                    $message['message'] = strip_tags($this->ion_auth->errors());
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
        exit;
    }

    public function reset_password($code)
    {
        $reset = $this->ion_auth->forgotten_password_complete($code);

        if ($reset) {  //if the reset worked then send them to the login page
            $message['type'] = 'success';
            $message['message'] = strip_tags($this->ion_auth->messages());
        } else { //if the reset didnt work then send them back to the forgot password page
            $message['type'] = 'error';
            $message['message'] = strip_tags($this->ion_auth->errors());
        }
        $this->session->set_flashdata('message', $message);
        redirect("/", 'refresh');
    }

    public function ajax_register()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $rules = array(
                array(
                    'field' => 'username',
                    'label' => lang('text_username'),
                    'rules' => 'required|trim|is_unique[ap_accounts.username]'
                ),
                array(
                    'field' => 'email',
                    'label' => lang('text_email'),
                    'rules' => 'required|trim|valid_email|is_unique[ap_accounts.email]'
                ),
                array(
                    'field' => 'password',
                    'label' => lang('text_password'),
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 're-password',
                    'label' => lang('text_repassword'),
                    'rules' => 'trim|required|matches[password]'
                ),
                array(
                    'field' => 'g-recaptcha-response',
                    'label' => 'captcha',
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

                $identity = strip_tags(trim($this->input->post('username')));
                $password = strip_tags(trim($this->input->post('password')));
                $email = strip_tags(trim($this->input->post('email')));
                $group_id = 2;
                $data_store['active'] = 1;
                $data_store['company'] = strip_tags(trim($this->input->post('company')));
                $data_store['mst'] = strip_tags(trim($this->input->post('mst')));
                $data_store['cmnd'] = strip_tags(trim($this->input->post('cmnd')));
                $id_user = $this->ion_auth->register($identity, $password, $email, $data_store, ['group_id' => $group_id]);
                if ($id_user !== false) {
                    //if the login is successful
                    $account = $this->_data->getUserByField('id',$id_user);
                    $this->session->set_userdata('is_logged', true);
                    $accountArray = array(
                        'account' => array(
                            'account_id' => $account->id,
                            'identity' => $account->id,
                            'avatar' => $account->avatar,
                            'fullname' => $account->fullname,
                            'username' => $account->username
                        )
                    );
                    $this->session->set_userdata($accountArray);
                    $message['type'] = "success";
                    $message['message'] = 'Đăng ký tài khoản thành công !';
                } else {
                    $message['type'] = 'error';
                    $message['message'] = "Đăng ký tài khoản không thành công !";
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
        exit;
    }

    public function ajax_update(){
        if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->_account_id;
            if(!empty($id)){
               $data = $this->input->post();
                if ($this->ion_auth->update($id, $data)) {
                    $message['type'] = "success";
                    $message['message'] = $this->lang->line('mess_update_success');
                } else {
                    $message['type'] = 'error';
                    $message['message'] = $this->lang->line('mess_update_unsuccess');
                }
                die(json_encode($message));
            }
        }
        exit;
    }
    /**
     * Try to authenticate the user with a given provider
     *
     * @param string $provider_id Define provider to login
     */
    public function window($provider_id)
    {
        $data_store = array();
        $params = array(
            'hauth_return_to' => site_url("account/window/{$provider_id}"),
        );
        if (isset($_REQUEST['openid_identifier'])) {
            $params['openid_identifier'] = $_REQUEST['openid_identifier'];
        }
        try {
            $adapter = $this->hybridauth->HA->authenticate($provider_id, $params);
            $profile = $adapter->getUserProfile();
            $user_name = str_replace(' ','',strtolower($this->toNormal($profile->displayName))).time();
            $check_auth = $this->_data->check_oauth('oauth_uid', $profile->identifier);
            $check_email = $this->_data->check_oauth('email', $profile->email);
            $check_username = $this->_data->check_oauth('username', $user_name);
            $check_phone = !(empty($profile->phone))?$this->_data->check_oauth('phone', $profile->phone):0;
            $data_store['oauth_provider'] = $provider_id;
            $data_store['oauth_uid'] = $profile->identifier;
            $data_store['last_name'] = $profile->displayName;
            $data_store['gender'] = $profile->gender === 'male' ? 1 : 0;
            //$data_store['avatar'] = $profile->photoURL;
            $data_store['fullname'] = trim($profile->displayName);
            $data_store['phone'] = $profile->phone;
            $email = $profile->email;
            $identity = ($check_username<=0)?$user_name:mktime(date("H:i:s d/m/Y"));
            if (isset($this->session->userdata)) unset($this->session->userdata['account']);
            if ($check_auth <= 0 && $check_email <= 0 && $check_username <= 0) {
                $group_id = 2;
                $data_store['active'] = 1;
                $id_user = $this->ion_auth->register($identity, $profile->identifier.'_aps', $email, $data_store, ['group_id' => $group_id]);
                $account = $this->_data->getUserByField('id',$id_user);
                $this->session->set_userdata('is_logged', true);
                $accountArray = array(
                    'account' => array(
                        'account_id' => $account->id,
                        'identity' => $account->id,
                        'avatar' => $account->avatar,
                        'fullname' => $account->fullname,
                        'username' => $account->username
                    )
                );
                $this->session->set_userdata($accountArray);

            } else {
                if($check_auth == 1) $account = $this->_data->getUserByField('oauth_uid',$profile->identifier);
                else $account = $this->_data->getUserByField('email',$profile->email);
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_userdata('is_logged', true);
                $accountArray = array(
                    'account' => array(
                        'account_id' => $account->id,
                        'identity' => $account->id,
                        'avatar' => $account->avatar,
                        'fullname' => $account->fullname,
                        'username' => $account->username
                    )
                );
                $this->session->set_userdata($accountArray);
            }

            $message['type'] = "success";
            $message['message'] = sprintf("Đăng nhập bằng %s thành công !",$provider_id);
            $this->session->set_flashdata('message',$message);
            $urlReferer =  $this->agent->referrer();
            redirect($urlReferer);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    public function logout()
    {
        if($this->session->userdata('is_logged')){
            $this->hybridauth->HA->logoutAllProviders();
            unset($this->session->userdata['account']);
            $this->session->set_userdata('AccountLoggedInKey', false);
            $this->session->set_userdata('is_logged', false);
            $message['type'] = "success";
            $message['message'] = 'Đăng xuất thành công !';
        } else {
            $message['type'] = 'error';
            $message['message'] = "Bạn chưa đăng nhập !";
        }
        $this->session->set_flashdata('message',$message);
        if(!empty($this->agent->referrer())) {
            $urlReferer =  $this->agent->referrer();
        }else{
            $urlReferer = base_url();
        }
        redirect($urlReferer);
    }

    /**
     * Handle the OpenID and OAuth endpoint
     */
    public function endpoint()
    {
        $this->hybridauth->process();
    }

    private function setMoxman($id){
        $newPathAccount = MEDIA_PATH."media_account/account_$id/";
        $newPathAccountProduct = MEDIA_PATH."media_account/account_$id/product/";
        if ( !file_exists( $newPathAccount ) ) {
            mkdir($newPathAccount, 0755, TRUE);
        }
        if ( !file_exists( $newPathAccountProduct ) ) {
            mkdir($newPathAccountProduct, 0755, TRUE);
        }
        //Set session for Moxie Manager Image
        $this->session->set_userdata('AccountLoggedInKey', "true");
        $this->session->set_userdata('CodeIgniterAuthenticator.environment', ENVIRONMENT);
        $this->session->set_userdata('moxiemanager.filesystem.rootpath', $newPathAccount);
        $this->session->set_userdata('moxiemanager.storage.path', $newPathAccount);
        $this->session->set_userdata("account_id", $id);

    }

}
