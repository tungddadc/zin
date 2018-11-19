<?php
/**
 * Developer: linhth
 * Controller bài viết
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Admin_Controller
{
  protected $_data;
  protected $_data_product;
  protected $voucher;

  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('ion_auth'));
    //tải file ngôn ngữ
    //tải model
    $this->load->model(['product_model', 'order_model', 'voucher_model', 'users_model']);

    $this->_ion = new ion_auth();
    $this->_data = new Order_model();
    $this->_data_product = new Product_model();
    $this->voucher = new Voucher_model();
    $this->users = new Users_model();
  }

  public function index()
  {
    //chỉ lấy ra những category thuộc mục product
    $data = [];
    $data['main_content'] = $this->load->view($this->template_path . 'order/index', $data, TRUE);
    $this->load->view($this->template_main, $data);
  }

  /*
   * Ajax trả về datatable
   * */
  public function ajax_list()
  {
    $this->checkRequestPostAjax();
    $data = array();
    $pagination = $this->input->post('pagination');
    $page = $pagination['page'];
    $total_page = isset($pagination['pages']) ? $pagination['pages'] : 1;
    $limit = !empty($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 1;

    $queryFilter = $this->input->post('query');
    $params = [
      'page' => $page,
      'limit' => $limit
    ];
    if (isset($queryFilter['is_status']) && $queryFilter['is_status'] !== '')
      $params = array_merge($params, ['is_status' => $queryFilter['is_status']]);

    $listData = $this->_data->getDataOrder($params);
    if (!empty($listData)) foreach ($listData as $item) {
      $row = array();
      $user= $this->users->getUserByField('id',$item->user_id);
      $row['checkID'] = $item->id;
      $row['id'] = $item->id;
      $row['username'] = !empty($user)?$user->username:'';
      $row['full_name'] = $item->full_name;
      $row['email'] = $item->email;
      $row['bill_address'] = $item->bill_address;
      $row['total_amount'] = formatMoney($item->total_amount);
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
    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->_data->count_all(),
      "recordsFiltered" => $this->_data->getTotal($params),
      "data" => $data,
    );
    echo json_encode($output);
    exit;
  }

  public function ajax_view($id)
  {
    $item = $this->_data->get_by_id($id);
    $data = array();
    if (!empty($item)) {
      $voucher = $this->voucher->getVoucherById($item->voucher_id);
      $data['full_name'] = $item->full_name;
      $data['phone'] = $item->phone;
      $data['address'] = $item->address;
      $data['note'] = $item->note;
      $data['email'] = $item->email;
      if(!empty($voucher)){
        $data['voucher_id'] =  $voucher->code;
        $data['total_voucher'] = (strpos($voucher->value,'%')!==false)?$voucher->value:formatMoney($voucher->value);
      }


      $data['is_status'] = $item->is_status;

      $data['total_amount'] = '<span style="color:red;font-weight:bold;">' . ($item->total_amount != 0 ? formatMoney($item->total_amount) : 'Liên hệ') . '</span>';
      $data['created_time'] = date('d/m/Y',strtotime($item->created_time));
      $orderDetail = $this->_data->get_by_order_id($id, 1);
      $data['order_detail'] = array();
      if (!empty($orderDetail)) foreach ($orderDetail as $value) {
        $oneProduct = getProduct($value->product_id);
        $row['product_name'] = !empty($oneProduct->title) ? $oneProduct->title : '';
        $row['quantity'] = '<span style="font-weight:bold;">' . $value->quantity . '</span>';
        $row['product_unit'] = '<span style="font-weight:bold;">' . number_format($value->price / $value->quantity) . '</span>';
        $row['price'] = '<span style="color:red;font-weight:bold;">' . number_format($value->price) . '</span>' . ' VNĐ';
        $row['action'] = '<a class="btn btn-danger delete_order" 
                          data-id="' . $value->product_id . '"
                          id-order="' . $id . '" 
                          total="' . $value->price . '" 
                          total_amount="' . $item->total_amount . '">
                          <i class="la la-trash" aria-hidden="true"></i></a>&nbsp;';
        $data['order_detail'][] = $row;
      }
      echo json_encode($data);
    }
  }

  // Chi tiết order
  private function orderDetail($id)
  {
    $this->_data->delete_by_id();
  }

  public function ajax_update()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $data_store = $this->input->post();
      $data_store['shipped_time'] = $this->input->post('shipped_time');
      $item = $this->_data->get_by_id($this->input->post('id'));
      if (empty($data_store['shipped_time'])) {
        $message['type'] = 'warning';
        $message['message'] = "Ngày giao hàng không được để trống";
        die(json_encode($message));
      }
      if ($data_store['is_status'] == 3) {
        //Nếu đơn hàng đã xác nhận thì chuyển đơn hàng về ERP
        $data_ = $this->AddSo($item);
        $repon = json_decode($data_);
        if ($repon->StatusCode == 200) {
          $response = $this->_data->update(array('id' => $this->input->post('id')), $data_store);
          $message['type'] = 'success';
          $message['message'] = "Đẩy đơn hàng về ERP thành công";
        } else {
          $message['type'] = 'error';
          $message['message'] = $repon->Message;
        }
        die(json_encode($message));
      }
      if ($item->is_status == 1) {
        $response = $this->_data->update(array('id' => $this->input->post('id')), $data_store);
        if ($response == true) {
          $message['type'] = 'success';
          $message['message'] = 'Cập nhật thành công!.';
        } else {
          $message['message'] = 'Cập nhật không thành công!.';
          $message['type'] = 'error';
        }
      } else {
        $message['message'] = 'Cập nhật không thành công!.';
        $message['type'] = 'error';
      }
      die(json_encode($message));
    }
  }

  private function AddSo($item)
  {
    $product_order = $this->_data->get_by_order_id($item->id);
    $dataAPI = array(
      'CustInfo' => array(
        'so_ct' => '',
        'so_ct_web' => $item->code,
        'ma_kh' => 'KH' . $item->user_id,
        'ten_kh' => $item->full_name,
        'dien_thoai' => $item->phone,
        'e_mail' => $item->email,
        'dia_chi_hd' => '',
        'dia_chi_gh' => $item->address,
        'ma_so_thue' => '',
        'ten_doanh_nghiep' => '',
        'ngay_gh' => date('Y-m-d', strtotime($this->input->post('shipped_time'))),
        'status' => $item->is_status,
      ),
      'ListItems' => array(),
    );
    if (!empty($product_order)) foreach ($product_order as $key => $value) {
      $product = getProduct($value->product_id);
      $dataAPI['ListItems'][$key]['ma_vt'] = !empty($product->model) ? $product->model : '';
      $dataAPI['ListItems'][$key]['so_luong'] = $value->quantity;
      $dataAPI['ListItems'][$key]['gia_ban'] = (int)$value->price / $value->quantity;
      $dataAPI['ListItems'][$key]['tien_ban'] = $value->price;
      $dataAPI['ListItems'][$key]['ma_ck'] = '';
      $dataAPI['ListItems'][$key]['ck'] = $value->discount;
    }
    $dataOK = json_encode($dataAPI, JSON_UNESCAPED_UNICODE);
    $resAPI = $this->callCURLOrder(URL_API_ERP . 'SOAPI/AddSO', $dataOK, 'POST');
    return $resAPI;
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
        $message['message'] = $this->lang->line('mess_update_success');
      } else {
        $message['type'] = 'error';
        $message['message'] = $this->lang->line('mess_update_unsuccess');
      }
      print json_encode($message);
    }
    exit;
  }

  public function ajax_removeItem()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $id = $this->input->post('id');
      $id_order = $this->input->post('id_order');
      $response = $this->_data->update_status_product_order($id_order, $id);
      $total_amount_remaining=$this->_data->resetTotalOrder($id_order);
      if ($response != false) {
        $this->_data->updateTotal($id_order, $total_amount_remaining);
        $data_mess = array(
          'status' => true,
          'total' => formatMoney($total_amount_remaining),
          'mess' => 'Xóa sản phẩm thành công'
        );
      } else {
        $data_mess = array(
          'status' => false,
          'mess' => 'Xóa không thành công'
        );
      }
      die(json_encode($data_mess));

    }
    exit;
  }

  /*
   * Xóa một bản ghi
   * */
  public function ajax_delete($id)
  {
    if ($id == 1) return;
    $this->_data->delete_by_id($id);
    die(json_encode(array("error" => 0)));
  }

  public function export_excel()
  {
    $this->load->library(array('PHPExcel'));
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator($this->config->item('cms_title'))
      ->setTitle($this->lang->line('heading_title'));


    // Add some data
    $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A1', 'ID')
      ->setCellValue('B1', lang('col_name'))
      ->setCellValue('C1', lang('col_address'))
      ->setCellValue('D1', lang('col_product_name'))
      ->setCellValue('E1', lang('col_total_amount'))
      ->setCellValue('F1', lang('col_created_at'))
      ->setCellValue('H1', lang('col_shipped_time'))
      ->setCellValue('I1', lang('col_order_status'));

    $list = $this->_data->getDataArr();
    $i = 2;
    foreach ($list as $item) {
      // dd($item);
      // $oneTransport = $this->_data->getTransport($item->transport_id);
      $oneTransport = $this->_data->getTransport(1);
      switch ($item->is_status) {
        case 0:
          $status = 'Đã hủy đơn hàng';
          break;
        case 1:
          $status = 'Đơn hàng chờ xử lý';
          break;
        case 2:
          $status = 'Đang vận chuyển';
          break;
        default:
          $status = 'Hoàn thành đơn hàng';
          break;
      }


      $listProduct = $this->_data->get_by_order_id($item->id);
      $productName = '';
      if (!empty($listProduct)) foreach ($listProduct as $k => $product) {
        $productModel = new Product_model();
        $oneProduct = getProduct($product->product_id);
        if ($k != 0) $productName .= ',';
        $productName .= $oneProduct->title;
      }
      // Miscellaneous glyphs, UTF-8
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $i, $item->id)
        ->setCellValue('B' . $i, $item->full_name)
        ->setCellValue('C' . $i, $item->address)
        ->setCellValue('D' . $i, $productName)
        ->setCellValue('E' . $i, number_format($item->total_amount))
        ->setCellValue('F' . $i, date('d/m/Y', strtotime($item->created_time)))
        ->setCellValue('H' . $i, date('d/m/Y', strtotime($item->shipped_time)))
        ->setCellValue('I' . $i, $status);
      $i++;
    }
    $nameFile = $this->lang->line('heading_title') . '_' . time();
    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle($nameFile);


    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);


    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    header('Content-Disposition: attachment;filename="' . $nameFile . '.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
  }

}