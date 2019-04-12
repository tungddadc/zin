<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 15/01/2018
 * Time: 10:39 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends Admin_Controller
{
  protected $_data;
  protected $_name_controller;
  protected $_location;
  protected $_region;
  protected $_quee_localtion;
  const STATUS_CANCEL = 0;
  const STATUS_ACTIVE = 1;
  const STATUS_DRAFT = 2;

  public function __construct()
  {
    parent::__construct();
    //tải thư viện
    //$this->load->library(array('ion_auth'));
    $this->load->model('location_model');
    $this->_data = new Location_model();
    $this->_name_controller = $this->router->fetch_class();
    $this->_location = $this->session->location;
    $this->_region = $this->config->item('region');
  }

  public function index($data, $type = 'city')
  {
    /*Breadcrumbs*/
    $this->session->location = $type;
    $this->breadcrumbs->push('Home', base_url());
    $this->breadcrumbs->push($data['heading_title'], current_url());
    $this->breadcrumbs->push($data['heading_description'], '#');
    $data['breadcrumbs'] = $this->breadcrumbs->show();
    /*Breadcrumbs*/
    $data['main_content'] = $this->load->view($this->template_path . $this->_name_controller . '/' . $type, $data, TRUE);
    $this->load->view($this->template_main, $data);
  }

  private function cron_update_db()
  {
    $this->load->model('location_model');
    $locationModel = new Location_model();
    /*Update city*/
    /*$listCity = $locationModel->loadCity();
    if(!empty($listCity)) foreach ($listCity as $item){ $item = (array) $item;
        $dataCity = array(
            'id' => $item['code'],
            'title' => $item['name'],
            'slug' => $item['slug'],
            'type' => $item['type'],
            'name_with_type' => $item['name_with_type'],
        );
        echo "Insert city: ".$locationModel->insert($dataCity, $locationModel->_table_city). " \n";
    }*/
    /*Update city*/

    /*Update district*/
    /*$listDistrict = $locationModel->loadDistrict();
    if(!empty($listDistrict)) foreach ($listDistrict as $item){ $item = (array) $item;
        $dataDistrict = array(
            'id' => $item['code'],
            'parent_id' => $item['parent_code'],
            'title' => $item['name'],
            'slug' => $item['slug'],
            'type' => $item['type'],
            'name_with_type' => $item['name_with_type'],
            'path' => $item['path'],
            'path_with_type' => $item['path_with_type'],
        );
        echo "Insert district: ".$locationModel->insert($dataDistrict, $locationModel->_table_district). " \n";
    }*/
    /*Update district*/


    /*Update street*/
    /*$listStreet = $locationModel->loadStreet();
    if(!empty($listStreet)) foreach ($listStreet as $item){ $item = (array) $item;
        $dataStreet = array(
            'id' => $item['code'],
            'parent_id' => $item['parent_code'],
            'title' => $item['name'],
            'slug' => $item['slug'],
            'type' => $item['type'],
            'name_with_type' => $item['name_with_type'],
            'path' => $item['path'],
            'path_with_type' => $item['path_with_type'],
        );
        echo "Insert district: ".$locationModel->insert($dataStreet, $locationModel->_table_street). " \n";
    }*/
    /*Update street*/
    exit;
  }

  public function city()
  {
    $data['heading_title'] = "Quản lý vị trí địa lý";
    $data['heading_description'] = "Danh sách tỉnh / thành phố";
    $this->index($data, 'city');
  }

  public function district()
  {
    $data['heading_title'] = "Quản lý vị trí địa lý";
    $data['heading_description'] = "Danh sách quận / huyện";
    $this->index($data, 'district');
  }

  public function ward()
  {
    $data['heading_title'] = "Quản lý vị trí địa lý";
    $data['heading_description'] = "Danh sách phường xã";
    $this->index($data, 'ward');
  }


  public function street()
  {
    $data['heading_title'] = "Quản lý vị trí địa lý";
    $data['heading_description'] = "Danh sách đường / phố";
    $this->index($data);
  }

  /*
   * Ajax trả về datatable
   * */
  public function ajax_list()
  {
    $type = $this->_location;
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $length = $this->input->post('length');
      $no = $this->input->post('start');
      $page = $no / $length + 1;
      $params['page'] = $page;
      $params['limit'] = $length;
      if(!empty($this->input->post('filter_city_id'))) $params['city_id']=$this->input->post('filter_city_id');

      if ($type === 'city') {
        $list = $this->_data->getDataCity($params);
      } elseif ($type === 'district') $list = $this->_data->getDataDistrict($params);
      else $list = $this->_data->getDataWard($params);
      $data = array();
      if ($type === 'ward') {
        if (!empty($list)) foreach ($list as $item) {
          $no++;
          $city = $this->_data->getCityById($item->city_id);
          $row = array();
          $row[] = $item->id;
          $row[] = $item->id;
          $row[] = $item->title;
          $row[] = $item->district;
          $row[] = $item->type;
          $row[] = $item->city;
          $row[] = $item->name_with_type;
          $row[] = $item->latitude;
          $row[] = $item->longitude;
          //thêm action
          $action = '<div class="text-center">';
          $action .= '&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="' . $this->lang->line('btn_remove') . '" onclick="delete_item(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
          $action .= '</div>';
          //$row[] = $action;
          $data[] = $row;
        }
      } else {
        if (!empty($list)) foreach ($list as $item) {
          $no++;
          if ($type == 'district') $city = $this->_data->getCityById($item->city_id);
          $row = array();
          $row[] = $item->id;
          $row[] = $item->id;
          $row[] = $item->title;
          if ($type == 'district') $row[] = $city->title;
          $row[] = $item->type;
          if ($type == 'city') $row[] = $this->_region[$item->region];
          $row[] = $item->name_with_type;
         //thêm action
          $action = '<div class="text-center">';
          $action .= '&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="' . $this->lang->line('btn_remove') . '" onclick="delete_item(' . "'" . $item->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
          $action .= '</div>';
          //$row[] = $action;
          $data[] = $row;
        }
      }


      $output = array(
        "draw" => $this->input->post('draw'),
        "recordsTotal" => $this->_data->getTotalAll(),
        "recordsFiltered" => $this->_data->getTotalLocation($params),
        "data" => $data,
      );
      //trả về json
      echo json_encode($output);
    }
    exit;
  }

  public function ajax_load_city()
  {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $term = $this->input->get("q");
      $params = [
        'search' => $term,
        'limit' => 100
      ];
      $list = $this->_data->getDataCity($params);
      $json = [];
      if (!empty($list)) foreach ($list as $item) {
        $item = (object)$item;
        $json[] = ['id' => $item->id, 'text' => $item->title];
      }
      print json_encode($json);
    }
  }

  public function ajax_load_district($city_id)
  {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $term = $this->input->get("q");
      $params = [
        'city_id' => $city_id,
        'search' => $term,
        'limit' => 100
      ];
      $list = $this->_data->getDataDistrict($params);
      $json = [];
      if (!empty($list)) foreach ($list as $item) {
        $item = (object)$item;
        $json[] = ['id' => $item->id, 'text' => $item->title];
      }
      print json_encode($json);
    }
  }
  public function ajax_update_field()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $id = $this->input->post('id');
      $field = $this->input->post('field');
      $value = $this->input->post('value');
      $response = $this->_data->update(['id' => $id], [$field => $value],'ap_location_district');

      // resetcache

      if ($response != false) {
        /*Call API update trạng thái bài viết crawler*/
        if($field=='is_status'){
          $action='add';
          if($value!=1){
            $action='remove';
          }
          $this->load->model('convert_model');
          $convertModel=new Convert_model();
          $convertModel->save_id_post_frontend($this->input->post('id'),'project',$action);
        }
        $dataPostAPI['id_project'] = $id;
        $dataPostAPI['status'] = $value;
        $urlConfigWebsite = API_CRAWLER_URL . '/api/updateProject';
        $response = json_decode($this->cUrl($urlConfigWebsite, $dataPostAPI));
        if ($response->status != true) {
          log_message('error', "Error API POST ConfigWebsite: " . json_encode($dataPostAPI));
          $message['debug'] = $response;
          $message['type'] = 'error';
          $message['message'] = "Lỗi update trạng thái API !";
          die(json_encode($message));
        }
        /*Call API update trạng thái bài viết crawler*/
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
  public function ajax_delete($id)
  {
    $response = $this->_data->delete(['id' => $id]);
    if ($response != false) {
      //Xóa translate của post
      $this->_data->delete(["id" => $id], $this->_data->table_trans);
      // log action
      $action = $this->router->fetch_class();
      $note = "Update $action: $id";
      $this->addLogaction($action, $note);
      $message['type'] = 'success';
      $message['message'] = $this->lang->line('mess_delete_success');
    } else {
      $message['type'] = 'error';
      $message['message'] = $this->lang->line('mess_delete_unsuccess');
      $message['error'] = $response;
      log_message('error', $response);
    }
    die(json_encode($message));
  }

  public function ajax_import_excel_city()
  {
    //Freeze pane
    $message = array();
    $this->load->library('PHPExcel');
    $fileName = time() . $_FILES['file']['name'];
    // Sesuai dengan nama Tag Input/Upload
    $config['upload_path'] = 'public/media/';

    // Buat folder dengan nama "fileExcel" di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    // $config['max_size'] = 10000;
    $this->load->library('upload');
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('file'))
      $this->upload->display_errors();
    $media = $this->upload->data();
    //dd($media);
    $filename = FCPATH . 'public/media/' . $media['file_name'];
    $inputFileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);

    $objPHPExcel = $objReader->load("$filename");

    $total_sheets = $objPHPExcel->getSheetCount();

    $allSheetName = $objPHPExcel->getSheetNames();
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $arraydata = array();
    for ($row = 1; $row <= $highestRow; ++$row) {
      for ($col = 0; $col < $highestColumnIndex; ++$col) {
        $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
        $arraydata[$row - 1][$col] = $value;
      }
    }
    $total = count($arraydata);
    $listid = array();
    for ($i = 0; $i < $total; $i++) {
      $data['id'] = $arraydata[$i][0];
      $data['title'] = $arraydata[$i][1];
      $data['code'] = $arraydata[$i][4];
      $data['type'] = $arraydata[$i][2];
      $data['slug'] = $arraydata[$i][5];
      $data['region'] = $arraydata[$i][8];
      $data['name_with_type'] = $arraydata[$i][2] . ' ' . $arraydata[$i][1];
      $data['latitude'] = $arraydata[$i][11];
      $data['longitude'] = $arraydata[$i][12];
      $result = $this->_data->saveCity($data);
    }
    $message['type'] = 'success';
    $message['message'] = 'Import thành công';
    die(json_encode($message));
    exit();
  }

  public function ajax_import_excel_district()
  {
    //Freeze pane
    $message = array();
    $this->load->library('PHPExcel');
    $fileName = time() . $_FILES['file']['name'];
    // Sesuai dengan nama Tag Input/Upload
    $config['upload_path'] = 'public/media/';

    // Buat folder dengan nama "fileExcel" di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    // $config['max_size'] = 10000;
    $this->load->library('upload');
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('file'))
      $this->upload->display_errors();
    $media = $this->upload->data();
    //dd($media);
    $filename = FCPATH . 'public/media/' . $media['file_name'];
    $inputFileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);

    $objPHPExcel = $objReader->load("$filename");

    $total_sheets = $objPHPExcel->getSheetCount();

    $allSheetName = $objPHPExcel->getSheetNames();
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $arraydata = array();
    for ($row = 1; $row <= $highestRow; ++$row) {
      for ($col = 0; $col < $highestColumnIndex; ++$col) {
        $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
        $arraydata[$row - 1][$col] = $value;
      }
    }
    $total = count($arraydata);
    for ($i = 0; $i < $total; $i++) {
      $data['id'] = $arraydata[$i][0];
      $data['title'] = $arraydata[$i][3];
      $data['city_id'] = $arraydata[$i][2];
      $data['code'] = $arraydata[$i][4];
      $data['type'] = $arraydata[$i][8];
      $data['slug'] = $arraydata[$i][6];
      $data['name_with_type'] = $arraydata[$i][11];
      $data['latitude'] = $arraydata[$i][9];
      $data['longitude'] = $arraydata[$i][10];
      $result = $this->_data->saveDistrict($data);
    }
    $message['type'] = 'success';
    $message['message'] = 'Import thành công';
    die(json_encode($message));
    exit();
  }

  public function ajax_import_excel_ward()
  {
    $message = array();
    $this->load->library('PHPExcel');
    $fileName = time() . $_FILES['file']['name'];

    // Sesuai dengan nama Tag Input/Upload
    $config['upload_path'] = 'public/media/';

    // Buat folder dengan nama "fileExcel" di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    // $config['max_size'] = 10000;
    $this->load->library('upload');
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('file'))
      $this->upload->display_errors();
    $media = $this->upload->data();
    $filename = FCPATH . 'public/media/' . $media['file_name'];

    $inputFileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);

    $objPHPExcel = $objReader->load("$filename");

    $total_sheets = $objPHPExcel->getSheetCount();

    $allSheetName = $objPHPExcel->getSheetNames();
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $arraydata = array();
    for ($row = 1; $row <= $highestRow; ++$row) {
      for ($col = 0; $col < $highestColumnIndex; ++$col) {
        $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
        $arraydata[$row - 1][$col] = $value;
      }
      $data['id'] = $arraydata[$row - 1][0];
      $data['title'] = $arraydata[$row - 1][3];
      $data['district'] = $arraydata[$row - 1][11];
      $data['district_id'] = $arraydata[$row - 1][2];
      $data['city'] = $arraydata[$row - 1][13];
      $data['city_id'] = $arraydata[$row - 1][12];
      $data['slug'] = $arraydata[$row - 1][8];
      $data['type'] = $arraydata[$row - 1][9];
      $data['name_with_type'] = $arraydata[$row - 1][16];
      $data['latitude'] = $arraydata[$row - 1][14];
      $data['longitude'] = $arraydata[$row - 1][15];
      $this->_data->saveWard($data);
    }
    $message['type'] = 'success';
    $message['message'] = 'Import thành công';
    die(json_encode($message));

  }
  public function ajax_load_wards($district_id)
  {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $this->load->model('location_model');
      $locationModel = new Location_model();
      $term = $this->input->get("q");
      $params = array(
        'district_id' => $district_id,
        'search' => $term,
        'limit' => 20,
        'order_by_name' => 'title'
      );
      $list = $this->_data->getDataWard($params);
      $json = [];
      if (!empty($list)) foreach ($list as $item) {
        $item = (object)$item;
        $json[] = ['id' => $item->id, 'text' => $item->title];
      }
      echo json_encode($json);
    }
    exit;
  }

}