<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Public_Controller {

    public function __construct(){
        parent::__construct();
        $this->cart->product_name_rules = '[:print:]';
    }


    public function index(){
        $data['main_content'] = $this->load->view($this->template_path.'cart/index', [], TRUE);
        $this->load->view($this->template_main, $data);
    }


    public function order(){
        $data['data'] = $this->cart->contents();
        $data['main_content'] = $this->load->view($this->template_path.'cart/order', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function load_list_cart(){
      $this->checkRequestPostAjax();
      echo $this->load->view($this->template_path.'cart/ajax_list_cart',[],TRUE);
      exit();
    }
    public function ajax_load_city(){
        $this->load->model('location_model');
        $locationModel = new Location_model();
        $data = $locationModel->loadCity();
        $keyword = $this->toSlug($this->input->get("q"));
        $dataJson = [];
        if(!empty($data)) foreach ($data as $key => $item){
            if(!empty($keyword) && strpos($item->name,$keyword) !== false ){
                $dataJson[] = ['id'=>$item->code, 'text'=>$item->name];
            }
            if(empty($keyword)) $dataJson[] = ['id'=>$item->code, 'text'=>$item->name];
        }
        echo json_encode($dataJson);exit;
    }

    public function ajax_load_district($city_id){
        $this->load->model('location_model');
        $locationModel = new Location_model();
        $dataJson = [];
        $data = $locationModel->loadDistrict($city_id);
        if(!empty($data)) foreach ($data as $key => $item){
            $dataJson[] = ['id'=>$item->code, 'text'=>$item->name];
        }
        echo json_encode($dataJson);exit;
    }

    public function ajax_total(){
        $this->checkRequestGetAjax();
        $output = [
            'total_item' => $this->cart->total_items(),
            'total_money'=> $this->cart->total()
        ];
        $this->returnJson($output);

    }
    public function totalMoney(){
        return $this->cart->total() + $this->settings['ship'];
    }


    public function add(){
        if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $params = $this->input->post();
            $listItem = $this->cart->contents();
            $exist = false;
            if(!empty($listItem)) foreach ($listItem as $item){
                if($item['id'] == $params['product_id']){
                    $data = array('rowid'=>$item['rowid'],'qty'=>$item['qty']+$params['quantity']);
                    $exist = true;
                    if ($this->cart->update($data)) {
                        $message['type'] = 'success';
                        $message['message'] = "Cập nhật giỏ hàng thành công !";
                    } else {
                        $message['type'] = 'error';
                        $message['message'] = "Cập nhật giỏ hàng thất bại !";
                    }
                    die(json_encode($message));
                }
            }
            if($exist == false){
                $data = array(
                    array(
                        'id' => $params['product_id'],
                        'qty' => trim(preg_replace('/([^0-9])/i', '', $params['quantity'])),
                        'price' => $params['price'],
                        'slug' => $params['slug'],
                        'name' => $params['name'],
                        'image' => $params['image'],
                        //'options' => array('model' => isset($params['model'])?$params['model']:'','size' => isset($params['size'])?$params['size']:'', 'color' => isset($params['color'])?$params['color']:'')
                    ),
                );
                // Them san pham vao gio hang
                if ($this->cart->insert($data)) {
                    $message['type'] = 'success';
                    $message['message'] = "Thêm vào giỏ hàng thành công !";
                } else {
                    $message['type'] = 'error';
                    $message['message'] = "Thêm vào giỏ hàng thất bại !";
                }
                die(json_encode($message));
            }
        }
        exit;
    }

    public function update(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $data = $this->input->post();
            if ($this->cart->update($data)) {
                $message['type'] = 'success';
                $message['message'] = "Cập nhật giỏ hàng thành công !";
            } else {
                $message['type'] = 'error';
                $message['message'] = "Cập nhật giỏ hàng thất bại !";
            }
            echo json_encode($message);
        }
        exit;
    }

    public function ajax_delete_item(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->input->post('id');

            if ($this->cart->remove($id)) {
                $message['type'] = 'success';
                $message['message'] = "Xóa sản phẩm trong giỏ hàng thành công !";
            } else {
                $message['type'] = 'error';
                $message['message'] = "Xóa sản phẩm trong giỏ hàng thất bại !";
            }
            die(json_encode($message));
        }
        exit;
    }

    public function destroy(){
        $urlRedirect = $this->input->get('url_redirect')?$this->input->get('url_redirect'):base_url();
        $this->cart->destroy();
        $message['type'] = 'success';
        $message['message'] = "Xóa giỏ hàng thành công !";
        $this->session->set_flashdata('message',$message);
        redirect($urlRedirect,'refresh');
        exit;
    }

    public function ajax_order(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $dataPost = $this->input->post();

            if($dataPost['delivery'] === 'info'){
                $rules[] = array(
                    'field' => 'info[fullname]',
                    'label' => lang('text_fullname'),
                    'rules' => 'required|trim'
                );
                $rules[] = array(
                    'field' => 'info[phone]',
                    'label' => lang('text_phone'),
                    'rules' => 'trim|regex_match[/^[0-9.-]{0,18}+$/]'
                );

                $rules[] = array(
                    'field' => 'info[city]',
                    'label' => lang('text_city'),
                    'rules' => 'required|trim'
                );
                $rules[] = array(
                    'field' => 'info[district]',
                    'label' => lang('text_district'),
                    'rules' => 'required|trim'
                );
                $rules[] = array(
                    'field' => 'info[address]',
                    'label' => lang('text_address'),
                    'rules' => 'required|trim'
                );
                $dataOrder = $dataPost['info'];
            }else{
                $rules[] = array(
                    'field' => 'other[fullname]',
                    'label' => lang('text_fullname'),
                    'rules' => 'required|trim'
                );
                $rules[] = array(
                    'field' => 'other[phone]',
                    'label' => lang('text_phone'),
                    'rules' => 'trim|regex_match[/^[0-9.-]{0,18}+$/]'
                );

                $rules[] = array(
                    'field' => 'other[city]',
                    'label' => lang('text_city'),
                    'rules' => 'required|trim'
                );
                $rules[] = array(
                    'field' => 'other[district]',
                    'label' => lang('text_district'),
                    'rules' => 'required|trim'
                );

                $rules[] = array(
                    'field' => 'other[address]',
                    'label' => lang('text_address'),
                    'rules' => 'required|trim'
                );
                $dataOrder = $dataPost['other'];
            }

            $rules[] = array(
                'field' => 'g-recaptcha-response',
                'label' => 'mã captcha',
                'rules' => 'required'
            );

            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() !== false) {
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
                $data['order_info']['user_id'] = $this->session->userdata('account')['account_id'];
                $data['order_info']['fullname'] = $dataOrder['fullname'];
                $data['order_info']['phone'] = $dataOrder['phone'];
                $data['order_info']['address'] = $dataOrder['address'];
                $data['order_info']['note'] = $dataPost['note'];
                $data['order_info']['fee_ship'] = $dataPost['fee_ship'];
                $data['order_info']['total_amount'] = $dataPost['total_all'] + $dataPost['fee_ship'];
                $data['order_info']['is_status'] = 1; //Chờ giao hàng
                $data['order_info']['payment_status'] = 0; //Đặt nhưng chưa thanh toán
                /*List product*/
                $data['order_detail'] = $this->cart->contents(); //Lấy danh sách product đặt bên cart
                $this->load->model('order_model');
                $orderModel = new Order_model();
                $orderId = $orderModel->saveOrder($data);

                if ($orderId) {
                    $dataOrder['order_id'] = $orderId;
                    $this->sendMailCheckout($dataOrder);
                    $this->cart->destroy();
                    $message['type'] = 'success';
                    $message['message'] = "Đặt hàng thành công !";
                } else {
                    $message['type'] = 'error';
                    $message['message'] = "Đặt hàng không thành công !";
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
    private function sendMailCheckout($data){

        if(!empty($data['email'])){
            /*Config setting*/
            $this->load->library('email');
            $emailTo = $data['email']; //Send mail cho khach hang
            $emailToCC =  $this->settings['email']; //Send mail cho ban quan tri

            $emailFrom = $emailToCC;
            $nameFrom =  "Thông báo đơn hàng mới - ".$data['order_id'];

            $address = $data['address'];
            $phone =    $data['phone'];

            $contentHtml = '
            <h2>Đơn hàng mới được tạo !</h2>
            <p>Họ và tên: '.$nameFrom.'</p>
            <p>Số điện thoại: '.$phone.'</p>
            <p>Địa chỉ: '.$address.'</p>
            <p>Đơn đặt hàng mã: '.$data['order_id'].'</p>
        ';

            $this->email->from($emailFrom, $nameFrom);

            $this->email->to($emailTo);
            if(!empty($emailToCC)) $this->email->cc($emailToCC);
            if(!empty($emailToBCC)) $this->email->bcc($emailToBCC);

            $this->email->subject('Thông báo đơn hàng mới từ '.base_url());
            $this->email->message($contentHtml);

            if ($this->email->send()) {
                $message['type'] = 'success';
                $message['message'] = "Gửi thông tin đặt hàng về mail thành công !";
            } else {
                $message['type'] = 'error';
                $message['message'] = 'Gửi thông tin đặt hàng mail thất bại !';
                $message['error'] = $this->email->print_debugger(array('headers'));
                die(json_encode($message));
            }
        }

    }

    public function ajax_get_coupon(){
        if($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->load->model('voucher_model');
            $voucherModel = new Voucher_model();
            $coupon = $this->input->post('coupon');
            if(empty($coupon)){
                $message['type'] = 'warning';
                $message['message'] = 'Vui lòng nhập mã khuyến mại !';
                delete_cookie('coupon_apply',getDomain());
                die(json_encode($message));
            }
            $data = $voucherModel->getValueCoupon($coupon,'coupon');
            $valueNumber = formatPercent($data);
            if(empty($data)){
                $message['type'] = 'error';
                $message['data'] = $data;
                $message['value'] = $valueNumber;
                $message['message'] = 'Mã không đúng hoặc hết hạn !';
                delete_cookie('coupon_apply',getDomain());
                die(json_encode($message));
            }

            if(!empty($data->account_id) && $this->session->is_logged == true){
                $listAccount = json_decode($data->account_id);
                if(!in_array($this->session->userdata('account')['account_id'],$listAccount)){
                    $message['type'] = 'warning';
                    $message['message'] = 'Mã khuyến mại này chỉ áp dụng cho 1 số tài khoản !';
                    delete_cookie('coupon_apply',getDomain());
                    die(json_encode($message));
                }
            }

            set_cookie('coupon_apply',$coupon,0,getDomain());
            $message['type'] = 'success';
            $message['data'] = $data;
            $message['value'] = $valueNumber;
            $message['message'] = "Sử dụng mã khuyến mại thành công !";
            die(json_encode($message));
        }
        exit;
    }
}
