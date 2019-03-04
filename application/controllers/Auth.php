<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 12/01/2018
 * Time: 3:58 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Public_Controller
{
    protected $cid = 0;
    protected $_lang_code;
    protected $_all_agency;
    protected $_data;
    protected $zalo;

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('auth');
        $this->load->library(array('ion_auth', 'hybridauth'));
        $this->load->model(array('users_model'));
        $this->_data = new Users_model();
        require_once(APPPATH . 'libraries/Zaloauth.php');

        $this->zalo = new \Zalo\Zaloauth();
    }

    public function login()
    {
        if (!empty($this->_user_login)) redirect(site_url());
        $data = array();
        $data['main_content'] = $this->load->view($this->template_path . 'auth/login', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function register()
    {
        if (!empty($this->_user_login)) redirect(site_url());
        $data = array();
        $data['main_content'] = $this->load->view($this->template_path . 'auth/register', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function ajax_login()
    {
        $data = array();
        $this->checkRequestPostAjax();
        $redirect = !empty($this->input->get('url')) ? urldecode($this->input->get('url')) : site_url();
        // validate form input
        $message = array();
        $this->form_validation->set_rules('identity', 'Tài khoản hoặc email', 'required');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
        $rules = [
            [
                'field' => "identity",
                'label' => "Tài khoản hoặc email",
                'rules' => "required"
            ],
            [
                'field' => "password",
                'label' => "Mật khẩu",
                'rules' => "required"
            ],
        ];
        if ($this->form_validation->run() === TRUE) {
            if ($account = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), FALSE)) {
                //if the login is successful
                if ($account) {

                    $this->_message = array(
                        'message' => 'Đăng nhập thành công!',
                        'type' => 'success',
                        'url_redirect' => (!empty($redirect)) ? $redirect : site_url()
                    );



                } else {
                    $this->_message = array(
                        'message' => strip_tags($this->ion_auth->errors()),
                        'type' => 'error'
                    );
                }
            } else {
                $this->_message = array(
                    'message' => 'Tài khoản hoặc mật khẩu không đúng!',
                    'type' => 'warning',
                );
            }

        } else {
            $valid = array();
            if (!empty($rules)) foreach ($rules as $item) {
                if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $this->_message = array(
                'message' => 'Tài khoản hoặc mật khẩu không đúng!',
                'type' => 'warning',
                'validation' => $valid
            );
        }
        $this->returnJson($this->_message);
    }

    public function ajax_register()
    {
        $this->checkRequestPostAjax();
        $this->_validate();
        //Check config setting reCaptcha
        $remoteIp = $this->input->ip_address();
        $identity = strip_tags(trim($this->input->post('username')));

        $password = strip_tags(trim($this->input->post('password')));
        $email = strip_tags(trim($this->input->post('email')));
        $data_store['fullname'] = strip_tags(trim($this->input->post('fullname')));
        $data_store['address'] = strip_tags(trim($this->input->post('address')));
        $data_store['phone'] = strip_tags(trim($this->input->post('phone')));
        $data_store['active'] = 1;
        $id_user = $this->ion_auth->register($identity, $password, $email, $data_store, ['group_id' => 2]);
        if ($id_user !== false) {
            $this->_message = array(
                'message' => 'Đăng ký thành công!',
                'type' => 'success',
                'url_redirect' => site_url('auth/login')
            );
        } else {
            $this->_message = array(
                'message' => 'Vui lòng kiểm tra lại thông tin!',
                'type' => 'warning',
            );
        }
        $this->returnJson($this->_message);
    }

    public function forgotPassword()
    {
        $data = array();
        $this->sbForgotPassword();
        $data['main_content'] = $this->load->view($this->template_path . 'auth/forgot-password', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public
    function reset_password($code)
    {
        $data = array();

        $user = $this->ion_auth->forgotten_password_check($code);
        if (empty($code)) redirect(site_url());
        if ($user) {
            $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'class' => 'input-text required-entry',
                'type' => 'password',
//        'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
            );
            $data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'class' => 'input-text required-entry',
                'type' => 'password',
//        'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
            );
            $data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );
            $data['csrf'] = $this->_get_csrf_nonce();
            $data['code'] = $code;
            // render

        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->sbResetPassword($user->fullname);
        }

        $data['main_content'] = $this->load->view($this->template_path . 'auth/reset_password', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    private
    function sbForgotPassword()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $message = array();
            // setting validation rules by checking whether identity is username or email
            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
            } else {
                $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
            }
            if ($this->form_validation->run() === FALSE) {
                $data['type'] = $this->config->item('identity', 'ion_auth');
                // setup the input
                $data['identity'] = array('name' => 'identity',
                    'id' => 'identity',
                );

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $data['identity_label'] = $this->lang->line('forgot_password_identity_label');
                } else {
                    $data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
                }
                $this->_message = array(
                    'type' => 'error',
                    'message' => strip_tags(validation_errors())
                );
            } else {
                $identity_column = $this->config->item('identity', 'ion_auth');
                $user_data = $this->_data->getUserByField($identity_column, $this->input->post('identity'));
                if (empty($user_data)) {
                    $this->_message = array(
                        'type' => 'error',
                        'message' => $identity_column . ' của bạn không tồn tại'
                    );
                } else {
                    $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->user($user_data->id)->row();
                    if (empty($identity)) {

                        if ($this->config->item('identity', 'ion_auth') != 'email') {
                            $this->ion_auth->set_error('forgot_password_identity_not_found');
                        } else {
                            $this->ion_auth->set_error('forgot_password_email_not_found');
                        }
                        $this->_message = array(
                            'type' => 'error',
                            'message' => strip_tags($this->ion_auth->errors())
                        );

                    }
                    // run the forgotten password method to email an activation code to the user
                    $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

                    if ($forgotten) {
                        // if there were no errors
                        $this->_message = array(
                            'type' => 'success',
                            'message' => strip_tags($this->ion_auth->messages()),
                            'url_redirect' => base_url() . "auth/login", 'refresh'
                        );
                    } else {
                        $this->_message = array(
                            'type' => 'error',
                            'message' => strtotime($this->ion_auth->errors()),
                        );
                    }
                }
            }
            $this->returnJson($this->_message);
        }
    }

    private function sbResetPassword($fullname)
    {
        $data = array();
        $code = $this->input->post('key_forgotten');
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            // if the code is valid then display the password reset form
            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() === TRUE) {
                // display the form
                // set the flash data error message if there is one
                // finally change the password
                $identity = $user->{$this->config->item('identity', 'ion_auth')};

                $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
//        dd($change);
                if ($change) {
                    // if the password was successfully changed
                    $this->_message = array(
                        'type' => 'success',
                        'message' => strip_tags($this->ion_auth->messages()),
                        'url_redirect' => site_url('auth/login')
                    );
                } else {
                    $this->_message = array(
                        'type' => 'error',
                        'message' => strip_tags($this->ion_auth->errors()),
                    );
                }
            } else {
                $val = array(
                    'new' => form_error('new'),
                    'new_confirm' => form_error('new_confirm'),
                );
                $this->_message = array(
                    'type' => 'error',
                    'message' => 'Vui lòng nhập thông tin chính xác',
                    'validation' => $val,
                );
            }

        } else {
            $this->_message = array(
                'type' => 'error',
                'message' => strip_tags($this->ion_auth->errors()),
            );
        }
        $this->returnJson($this->_message);

    }

    public
    function logout($calback = '')
    {
        if (!empty($calback)) $calback = base_url();

        // redirect them to the login page
        $account = $this->_data->getById($this->session->userdata['user_id']);
        if (!empty($account->oauth_provider) && $account->oauth_provider != 'Zalo') $this->hybridauth->HA->logoutAllProviders();
        if ($account->oauth_provider == 'Zalo') {
            delete_cookie("call_back_url");
            delete_cookie("access_token");
        }

        $this->ion_auth->logout();
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        $this->session->set_flashdata('type', 'success');
        redirect($calback, 'refresh');
    }

    /**
     * Try to authenticate the user with a given provider
     *
     * @param string $provider_id Define provider to login
     */
    public
    function window($provider_id)
    {
//        $this->hybridauth->HA->logoutAllProviders();
        $data_store = array();
        $params = array(
            'hauth_return_to' => site_url("auth/window/{$provider_id}"),
        );

        if (isset($_REQUEST['openid_identifier'])) {
            $params['openid_identifier'] = $_REQUEST['openid_identifier'];
        }
        try {

            $adapter = $this->hybridauth->HA->authenticate($provider_id, $params);
            $profile = $adapter->getUserProfile();
            $user_name = str_replace(' ', '', $this->toNormal(strtolower($profile->displayName)));
            $check_auth = $this->_data->check_oauth('oauth_uid', $profile->identifier);
            $check_email = $this->_data->check_oauth('email', $profile->email);
            $check_username = $this->_data->check_oauth('username', $user_name);
            $check_phone = !(empty($profile->phone)) ? $this->_data->check_oauth('phone', $profile->phone) : 0;
            $data_store['oauth_provider'] = $provider_id;
            $data_store['oauth_uid'] = $profile->identifier;
            $data_store['fullname'] = $profile->displayName;
            $data_store['avatar'] = $profile->photoURL;
            $data_store['phone'] = $profile->phone;
            if (!empty($profile->birthYear)) $data_store['birthday'] = $profile->birthYear . '-' . $profile->birthMonth . '-' . $profile->birthDay;
            $email = $profile->email;
            $file = $profile->photoURL;
            $identity = ($check_username <= 0) ? $user_name : time();
            $dir = 'public/media/avatar';
            if (isset($this->session->userdata)) unset($this->session->userdata['account']);
            if ($check_auth <= 0) {

                $group_id = 2;
                $data_store['active'] = 1;
                if ($check_email <= 0 || empty($email)) {

                    // copy avatar
                    $newfile = $dir . '/' . $profile->identifier . '.png';
                    copy($file, $newfile);
                    $data_store['avatar'] = 'avatar/' . $profile->identifier . '.png';
                    // End avatar
                    $id_user = $this->ion_auth->register($identity, $profile->identifier, $email, $data_store, ['group_id' => $group_id]);
                    $this->session->userdata['is_logged'] = true;
                    $this->session->userdata['dentity'] = $identity;
                    $this->session->userdata['user_id'] = $id_user;
                    $this->session->set_flashdata('message', 'Đăng nhập thành công!');
                    $this->session->set_flashdata('type', 'success');
                    redirect($this->agent->referrer() ? $this->agent->referrer() : base_url(), 'refresh');
                } else {
                    $this->hybridauth->HA->logoutAllProviders();
                    unset($this->session->userdata['account']);
                    unset($this->session->userdata['is_logged']);
                    $this->session->set_flashdata('message', 'Email hoặc số điện thoại của bạn đã được đăng ký rồi. vui lòng đăng ký tài khoản khác.');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url(), 'refresh');
                }

            } else {
                $account = $this->_data->getUserByField('oauth_uid', $profile->identifier);
//                $account =$this->ion_auth->login($infoAcount->username, $profile->identifier);
                //if the login is successful
                //redirect them back to the home page

                if ($account->active == 1) {
                    $this->session->userdata['is_logged'] = true;

                    $this->session->userdata['user_id'] = $account->id;
                    $this->session->userdata['dentity'] = $account->username;
                    if (empty($account->avatar)) {
                        if (!is_dir($dir)) {
                            mkdir('public/media/avatar', '0755');
                        }
                        chmod($dir, 755);
                        $newfile = $dir . '/' . $profile->identifier . '.png';
                        copy($file, $newfile);
                        $avatar = 'avatar/' . $profile->identifier . '.png';
                        $this->_data->updateField($account->id, 'avatar', $avatar);
                    }
                    $this->session->set_flashdata('message', 'Đăng nhập thành công!');
                    $this->session->set_flashdata('type', 'success');
                    redirect($this->agent->referrer() ? $this->agent->referrer() : base_url(), 'refresh');
                } else {
                    $this->session->set_flashdata('message', 'Tài khoản của bạn đang bị khóa!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url(), 'refresh');
                }

            }
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
//        redirect(base_url());
    }

    /**
     * Handle the OpenID and OAuth endpoint
     */
    public
    function endpoint()
    {
        $data = $this->input->get();
        if ($data['hauth_done'] == 'Facebook' && $data['error'] == 'access_denied') {
            redirect(site_url(), 'refresh');
        }
        $this->hybridauth->process();
    }

    public
    function loginzalo()
    {
        $data = $this->zalo->renderLoginUrl();
        $message = [];
        if (!empty($data)) {
            $identity = $this->toNormal($this->toSlug($data['name']));

            $birthdayNew = '';
            if (!empty($data['birthday'])) {
                $birthday = explode('/', $data['birthday']);
                $birthdayNew = $birthday[2] . '-' . $birthday[1] . '-' . $birthday[0];
            }
            $data_store = [
                'fullname' => $data['name'],
                'active' => 1,
                'birthday' => $birthdayNew,
                'oauth_provider' => 'Zalo',
                'oauth_uid' => $data['id'],
            ];
            $authId = $this->_data->check_oauth('oauth_uid', $data['id']);
            if ($authId <= 0) {
                // End avatar
                $checkUsername = $this->_data->check_oauth('username', $identity);

                if ($checkUsername > 0) $identity = time();
                $avatar = '';
                if (!empty($data['picture']['data']['url'])) {

                    $avatar = $data['id'] . '.png';
                    $dir = 'public/media/avatar/';
                    $newfile = $dir . $avatar;
                    file_put_contents($newfile, file_get_contents($data['picture']['data']['url']));
                }
                $data_store['avatar'] = 'avatar/' . $avatar;
                $id_user = $this->ion_auth->register($identity, time(), '', $data_store, ['group_id' => 2]);

                $this->session->userdata['is_logged'] = true;
                $this->session->userdata['identity'] = $identity;
                $this->session->userdata['user_id'] = $id_user;
                $this->session->set_flashdata('message', 'Đăng nhập thành công!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url(), 'refresh');
            } else {
                $account = $this->_data->getUserByField('oauth_uid', $data['id']);
//                $account =$this->ion_auth->login($infoAcount->username, $profile->identifier);
                //if the login is successful
                //redirect them back to the home page
                if ($account->active == 1) {
                    $this->session->userdata['is_logged'] = true;
                    $this->session->userdata['user_id'] = $account->id;
                    $this->session->userdata['dentity'] = $account->username;
                    $this->session->set_flashdata('message', 'Đăng nhập thành công!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url(), 'refresh');
                } else {
                    $this->session->set_flashdata('message', 'Tài khoản của bạn đang bị khóa!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url(), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'Đăng nhập không thành công!');
            $this->session->set_flashdata('type', 'danger');
            redirect(site_url('auth/login'), 'refresh');
        }
    }

    private function _validate()
    {
        $rules = array(
            array(
                'field' => 'username',
                'label' => 'Tài khoản',
                'rules' => 'required|trim|min_length[6]|alpha_numeric|max_length[15]|is_unique[users.username]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|min_length[5]|max_length[50]|valid_email|is_unique[users.email]'
            ),
            array(
                'field' => 'phone',
                'label' => 'Số điện thoại',
                'rules' => 'required|trim|min_length[6]|max_length[20]|numeric'
            ), array(
                'field' => 'fullname',
                'label' => 'Họ và tên',
                'rules' => 'required|trim|min_length[3]|max_length[50]'
            ), array(
                'field' => 'address',
                'label' => 'Địa chỉ',
                'rules' => 'required|trim|min_length[3]|max_length[70]'
            ),
            array(
                'field' => 'password',
                'label' => 'Mật khẩu',
                'rules' => 'required|trim|min_length[8]|max_length[50]|matches[repassword]'
            ), array(
                'field' => 'repassword',
                'label' => 'Nhập lại mật khẩu',
                'rules' => 'required|trim|min_length[8]|max_length[50]'
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            $message['type'] = "warning";
            $message['message'] = $this->lang->line('mess_validation');
            $valid = array();
            if (!empty($rules)) foreach ($rules as $item) {
                if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $this->_message = array(
                'type' => 'warning',
                'message' => 'Vui lòng kiểm tra lại thông tin !',
                'validation' => $valid,
            );
            $this->returnJson($this->_message);
        }
    }
}
