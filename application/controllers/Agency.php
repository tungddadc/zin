<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agency extends Public_Controller
{
  protected $_data;
 public function __construct()
 {
   parent::__construct();
   //tải model
   $this->load->model(['agency_model']);
   $this->_data = new Agency_model();
 }
 public function agencyNear(){
   $this->checkRequestPostAjax();
   $lat=$this->input->post('lat');
   $log=$this->input->post('log');
   $data=$this->_data->getAgenRecent(array('lat'=>$lat,'log'=>$log));
   echo  $this->load->view($this->template_path.'agency/list_agency',array('data'=>$data,'location'=>true),true);
   die();
 }
 public function listAgency(){
   $this->checkRequestPostAjax();
   $post=$this->input->post();
   $params=array(
     'limit'=>100,
     'is_status'=>1,
     'city_id'=>!empty($post['city_id'])?$post['city_id']:'',
     'district_id'=>!empty($post['district_id'])?$post['district_id']:'',
   );
   $data=$this->_data->getData($params);
   echo  $this->load->view($this->template_path.'agency/list_agency',array('data'=>$data),true);
   die();
 }
  public function filterAgency(){
    $this->checkRequestPostAjax();
    $params=array(
      'key_search'=>!empty($this->input->post('key_search'))?$this->input->post('key_search'):'',
      'limit'=>100,
      'is_status'=>1,
    );
    $data=$this->_data->getData($params);
    if(!empty($data)) {
      foreach ($data as $item){
        echo '<li><a href="'.getUrlAgency($item).'">'.$item->title.', '.$item->address .'</a></li>';
      }
    }else{
      echo '<li>Không có kết quả phù hợp.</li>';

    }
    die();
  }
  public function detail($id){
    $oneItem = $this->_data->getById($id, '', $this->session->public_lang_code);
    if (empty($oneItem)) show_404();
    if ($this->input->get('lang')) redirect(getUrlPage($oneItem));

    $data['SEO'] = array(
      'meta_title' => $oneItem->title,
      'meta_description' => !empty($oneItem->title) ? $oneItem->title : '',
      'meta_keyword' => !empty($oneItem->title) ? $oneItem->title : '',
      'url' => getUrlPage($oneItem),
    );
    $data['main_content'] = $this->load->view($this->template_path . 'agency/detail' , $data, TRUE);
    $this->load->view($this->template_main, $data);
  }
}
