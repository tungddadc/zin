<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Public_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->cart->product_name_rules = '[:print:]';
  }


  public function index()
  {
    $data['main_content'] = $this->load->view($this->template_path . 'cart/index', [], TRUE);
    $this->load->view($this->template_main, $data);
  }


  public function order()
  {
    $data['data'] = $this->cart->contents();
    $data['main_content'] = $this->load->view($this->template_path . 'cart/order', $data, TRUE);
    $this->load->view($this->template_main, $data);
  }

  public function load_list_cart()
  {
    $this->checkRequestPostAjax();
    echo $this->load->view($this->template_path . 'cart/ajax_list_cart', [], TRUE);
    exit();
  }

  public function ajax_load_city()
  {
    $this->checkRequestGetAjax();
    $this->load->model('location_model');
    $locatonModel = new Location_model();
    $term = $this->input->get("q");
    $params = [
      'search' => $term,
      'limit' => 100
    ];
    $list = $locatonModel->getDataCity($params);
    $json = [];
    if (!empty($list)) foreach ($list as $item) {
      $item = (object)$item;
      $json[] = ['id' => $item->id, 'text' => $item->title];
    }
    $this->returnJson($json);
  }

  public function ajax_load_district($city_id)
  {
    $this->checkRequestGetAjax();
    $this->load->model('location_model');
    $locatonModel = new Location_model();
    $term = $this->input->get("q");
    $params = [
      'city_id' => $city_id,
      'search' => $term,
      'limit' => 100
    ];
    $list = $locatonModel->getDataDistrict($params);
    $json = [];
    if (!empty($list)) foreach ($list as $item) {
      $item = (object)$item;
      $json[] = ['id' => $item->id, 'text' => $item->title];
    }
    $this->returnJson($json);
  }

  public function ajax_total()
  {
    $this->checkRequestGetAjax();
    $output = [
      'total_item' => $this->cart->total_items(),
      'total_money' => $this->cart->total()
    ];
    $this->returnJson($output);

  }

  public function totalMoney()
  {
    return $this->cart->total() + $this->settings['ship'];
  }


  public function add()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $params = $this->input->post();
      $listItem = $this->cart->contents();
      $exist = false;
      if (!empty($listItem)) foreach ($listItem as $item) {
        if ($item['id'] == $params['product_id']) {
          $data = array('rowid' => $item['rowid'], 'qty' => $item['qty'] + $params['quantity']);
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
      if ($exist == false) {
        $this->load->model('product_model');
        $productModel = new Product_model();
        $oneProduct = $productModel->getById($params['product_id'], '', $this->session->userdata('public_lang_code'));
        $price = !empty($oneProduct->price_sale) ? $oneProduct->price_sale : $oneProduct->price;
        if ($this->session->userdata('is_agency') == true) {
          $oneDetail = $productModel->getPriceAgency($params['product_id'], $params['quantity']);
          if (!empty($oneDetail->price_agency)) $price = $oneDetail->price_agency;
        }
        $data = array(
          array(
            'id' => $params['product_id'],
            'qty' => trim(preg_replace('/([^0-9])/i', '', $params['quantity'])),
            'price' => $price,
            'slug' => $oneProduct->slug,
            'name' => $oneProduct->title,
            'image' => getImageThumb($oneProduct->thumbnail, 100, 100),
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

  public function update()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $data = $this->input->post();
      $dataStore = array();
      if (!empty($data['cart'])) foreach ($data['cart'] as $key => $value) {
        $dataStore[] = array(
          'rowid' => $key,
          'qty' => $value['qty']
        );
      }
      if ($this->cart->update($dataStore)) {
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

  public function ajax_delete_item()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
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

  public function destroy()
  {
    $urlRedirect = $this->input->get('url_redirect') ? $this->input->get('url_redirect') : base_url();
    $this->cart->destroy();
    $message['type'] = 'success';
    $message['message'] = "Xóa giỏ hàng thành công !";
    $this->session->set_flashdata('message', $message);
    redirect($urlRedirect, 'refresh');
    exit;
  }

  public function checkout()
  {
    $this->checkRequestPostAjax();
    $dataOrder = $this->input->post();
    $rules[] = array(
      'field' => 'full_name',
      'label' => 'Họ và tên',
      'rules' => 'required|trim'
    );
    $rules[] = array(
      'field' => 'bill_address',
      'label' => 'Địa chỉ viết hóa đơn',
      'rules' => 'required|trim'
    );
    $rules[] = array(
      'field' => 'phone',
      'label' => 'Số điện thoại',
      'rules' => 'trim|regex_match[/^[0-9.-]{0,18}+$/]'
    );

    $rules[] = array(
      'field' => 'city_id',
      'label' => 'Thành phố',
      'rules' => 'required|trim'
    );
    $rules[] = array(
      'field' => 'district_id',
      'label' => 'Quận huyện',
      'rules' => 'required|trim'
    );

    $rules[] = array(
      'field' => 'address',
      'label' => 'Địa chỉ',
      'rules' => 'required|trim'
    );
    $rules[] = array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|trim|valid_email'
    );
    $rules[] = array(
      'field' => 'warehouse',
      'label' => 'Kho hàng',
      'rules' => 'required'
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() !== false) {
      //Check config setting reCaptcha
      unset($dataOrder['code']);
      $data['order_info'] = $dataOrder;
      $data['order_info']['user_id'] = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : '';
      $data['order_info']['is_status'] = 1; //Chờ giao hàng
      $data['order_info']['payment'] = 1; //Hình thức thanh toán
      $data['order_info']['domain'] = base_url();//Nhánh hệ thống
      $voucher_id = $dataOrder['voucher_id'];
      $data['order_info']['total_amount'] = $this->cart->total();
      if (!empty($voucher_id)) {
        $voucher_id = $this->decryptIt($voucher_id);
        $this->load->model('voucher_model');
        $voucherModel = new Voucher_model();
        $voucher = $voucherModel->getVoucherById($voucher_id);
        if (!empty($voucher)) {
          $data['order_info']['voucher_id'] = $voucher_id;
          if (strpos($voucher->value, '%') > 0) {
            $val = str_replace('%', '', $voucher->value);
            $data['order_info']['total_amount'] = $this->cart->total() - $this->cart->total() * $val / 100;
          } else {
            $data['order_info']['total_amount'] = $this->cart->total() - $voucher->value;
          }
          if ($this->session->userdata('user_id')) {

            $checkUse = $voucherModel->receivingAccount($voucher->id, $this->session->userdata('user_id'), 1);
            if (!empty($checkUse)) {
              $voucherModel->update(['account_id' => $this->session->userdata('user_id'), 'type_id' => $voucher->id], ['is_status' => 1], 'user_voucher');
            } else {
              $voucherModel->save(array('account_id' => $this->session->userdata('user_id'), 'type_id' => $voucher->id, 'is_status' => 1), 'user_voucher');
            }
          }
        }

      }
      /*List product*/
      $data['order_detail'] = $this->cart->contents(); //Lấy danh sách product đặt bên cart
      $this->load->model('order_model');
      $orderModel = new Order_model();
      $orderId = $orderModel->saveOrder($data);

      if ($orderId) {
        $dataOrder['order_id'] = $orderId;
        $this->sendMailCheckout($dataOrder);
        $this->cart->destroy();
        $this->session->userdata['order_id'] = $orderId;
        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Đặt hàng thành công !');
        $this->_message = array(
          'type' => 'success',
          'message' => 'Đặt hàng thành công !',
          'redirect_url' => site_url('cart/done')
        );
      } else {
        $this->_message = array(
          'type' => 'warning',
          'message' => 'Đặt hàng không thành công !',
        );
      }
      $this->returnJson($this->_message);

    } else {
      $valid = array();
      if (!empty($rules)) foreach ($rules as $item) {
        if (!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
      }
      $this->_message = array(
        'type' => 'warning',
        'validation' => $valid,
        'message' => 'Vui lòng kiểm tra lại thông tin!',
      );
      $this->returnJson($this->_message);
    }
  }

  public function done()
  {
    if (empty($this->session->userdata['order_id'])) redirect(base_url());
    $data = array();
    $this->load->model('order_model');
    $orderModel = new Order_model();
    $data['order'] = $orderModel->getOrderById($this->session->userdata['order_id']);
    unset($this->session->userdata['order_id']);
    $data['main_content'] = $this->load->view($this->template_path . 'cart/done', $data, TRUE);
    $this->load->view($this->template_main, $data);
  }

  private function sendMailCheckout($data)
  {

    if (!empty($data['email'])) {
      /*Config setting*/
      $this->load->library('email');
      $emailTo = $data['email']; //Send mail cho khach hang
      $emailToCC = $this->settings['email']; //Send mail cho ban quan tri

      $emailFrom = $emailToCC;
      $nameFrom = "Thông báo đơn hàng mới - " . $data['order_id'];

      $address = $data['address'];
      $phone = $data['phone'];

      $contentHtml = '
            <h2>Đơn hàng mới được tạo !</h2>
            <p>Họ và tên: ' . $data['full_name'] . '</p>
            <p>Số điện thoại: ' . $phone . '</p>
            <p>Địa chỉ: ' . $address . '</p>
            <p>Đơn đặt hàng mã: ' . $data['order_id'] . '</p>
        ';

      $this->email->from($emailFrom, $nameFrom);

      $this->email->to($emailTo);
      if (!empty($emailToCC)) $this->email->cc($emailToCC);
      if (!empty($emailToBCC)) $this->email->bcc($emailToBCC);

      $this->email->subject('Thông báo đơn hàng mới từ ' . base_url());
      $this->email->message($contentHtml);

      if ($this->email->send()) {
        $message['type'] = 'success';
        $message['message'] = "Gửi thông tin đặt hàng về mail thành công !";
      } else {
        $message['type'] = 'error';
        $message['message'] = 'Gửi thông tin đặt hàng mail thất bại !';
        $message['error'] = $this->email->print_debugger(array('headers'));
      }
    }

  }

  // Xử lý voucher
  public function voucher()
  {
    $this->checkRequestPostAjax();
    $this->load->model('voucher_model');
    $voucherModel = new Voucher_model();

    $code = $this->input->post('code');
    if (empty($code)) {
      $this->_message = array(
        'message' => 'Voucher không được để trống !',
        'type' => 'danger'
      );
      $this->returnJson($this->_message);
    }
    $voucher = $voucherModel->getByCode($code, 1);
    if (empty($voucher)) {
      $this->_message = array(
        'message' => 'Voucher không tồn tại !',
        'type' => 'danger'
      );
    } else {
      if ($voucher->is_status != 1) {
        $this->_message = array(
          'message' => 'Voucher đã hết hạn sử dụng!',
          'type' => 'danger'
        );
        $this->returnJson($this->_message);
      } else {
        if (!empty($voucher->user_use) && ((!empty($this->_user_login->id)) || $voucher->user_use != $this->_user_login->id)) {
          $this->_message = array(
            'message' => 'Bạn không sử dụng được voucher này!',
            'type' => 'danger'
          );
          $this->returnJson($this->_message);
        }
      }

      $this->receivingAccount($voucher->id, $this->_user_login->id);
      $this->check_date($voucher->start_time, $voucher->end_time);
//      if ($voucher->total_use > 0) $this->check_total_use($voucher->remaining_use, $voucher->total_use);
      $sale = $voucher->value;
      if (strpos($sale, '%') > 0) {
        $sale_value = $sale;
        $val = str_replace('%', '', $sale);
        $price_sale = $this->cart->total() - $this->cart->total() * $val / 100;
      } else {
        $sale_value = formatMoney($sale);
        $price_sale = $this->cart->total() - $sale;
      }
      $this->_message = array(
        'message' => 'Bạn sẽ được giảm ' . $sale_value . ' sau khi thanh toán.',
        'type' => 'success',
        'price_sale' => formatMoney($price_sale),
        'voucher' => $this->encryptIt($voucher->id)
      );
    }
    $this->returnJson($this->_message);
  }

  // Kiểm tra User đó đã ăn voucher hay chưa
  private function receivingAccount($voucher_id, $account_id)
  {
    $this->load->model('voucher_model');
    $voucherModel = new Voucher_model();
    $account_voucer = $voucherModel->receivingAccount($voucher_id, $account_id);
    if (!empty($account_voucer)) {
      $this->_message = array(
        'message' => 'Bạn đã sử dụng mã giảm giá này rồi!',
        'type' => 'danger'
      );
      $this->returnJson($this->_message);
    }
    return true;
  }

  private function check_date($start_time, $end_time)
  {
    $start_time = strtotime($start_time);
    $end_time = strtotime($end_time);
    $today = strtotime(date('Y-m-d'));
    if (empty($start_time) && empty($end_time)) return true;
    if (empty($start_time) && $today <= $end_time) return true;
    if (empty($end_time) && $today >= $end_time) return true;
    if ($today <= $end_time && $today >= $start_time) return true;
    $this->_message = array(
      'message' => 'Voucher không được sử dụng lúc này',
      'type' => 'danger'
    );
    $this->returnJson($this->_message);
  }

  public function encryptIt($q)
  {
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return $qEncoded;
  }

  public function decryptIt($q)
  {
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return $qDecoded;
  }

  public function ajax_get_fee()
  {
    $this->checkRequestPostAjax();
    $this->load->model('location_model');
    $locationModel = new Location_model();
    $warehouse = $this->input->post('warehouse');
    switch ($warehouse) {
      case 1:
        $from_city = 'Hà Nam';
        $from_district = 'Thành phố Phủ Lý';
        break;
      case 2:
        $from_city = 'Hà Nội';
        $from_district = 'Quận Đống Đa';
        break;
      default:
        $from_city = 'Hà Nội';
        $from_district = 'Quận Thanh Xuân';
    }
    $district_id = $this->input->post('district_id');
    $city_id = $this->input->post('city_id');
    $district = $locationModel->getDistrictById($district_id);
    $city = $locationModel->getCityById($city_id);
    $total_price = $this->input->post('total');
    $total_weight = $this->input->post('weight');
    $data = $this->getFeeShip($from_city, $from_district, $district, $city, $total_price, $total_weight);
    $data = json_decode($data);
    $this->returnJson($data);
    exit;
  }

  private function getFeeShip($from_city, $from_district, $district, $city, $total_price, $total_weight)
  {
    $data = array(
      "pick_province" => $from_city,
      "pick_district" => $from_district,
      "province" => $city->name_with_type,
      "district" => $district->name_with_type,
      "address" => "Số nhà 000",
      "weight" => (int)$total_weight,
      "value" => (int)$total_price,
      "transport" => "fly"
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => array(
        "Token: 39e65CB51E0E334faf6b2443858778f67870553f",
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  }
}
