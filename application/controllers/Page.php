<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Public_Controller
{
  protected $_data;
  protected $_lang_code;

  public function __construct()
  {
    parent::__construct();
    //tải model
    $this->load->model(['page_model']);
    $this->_data = new Page_model();
    //Check xem co chuyen lang hay khong thi set session lang moi
    if ($this->input->get('lang'))
      $this->_lang_code = $this->input->get('lang');
    else
      $this->_lang_code = $this->session->public_lang_code;
  }

  public function index($slug)
  {
    $id = $this->_data->slugToId($slug);
    $oneItem = $this->_data->getById($id, '', $this->session->public_lang_code);
    if (empty($oneItem)) show_404();
    if ($this->input->get('lang')) redirect(getUrlPage($oneItem));
    $data['oneItem'] = $oneItem;
    if($oneItem->layout=='daily'){
      $data['data']=$this->agency();
    }

    //add breadcrumbs
    $this->breadcrumbs->push($this->lang->line('home'), base_url());
    $this->breadcrumbs->push($oneItem->title, getUrlPage($oneItem));
    $data['breadcrumb'] = $this->breadcrumbs->show();

    $data['SEO'] = array(
      'meta_title' => $oneItem->meta_title,
      'meta_description' => !empty($oneItem->meta_title) ? $oneItem->meta_description : '',
      'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
      'url' => getUrlPage($oneItem),
      'image' => getImageThumb($oneItem->thumbnail, 400, 200)
    );
    if (!empty($oneItem->layout)) $layoutView = '-' . $oneItem->layout;
    else $layoutView = '';
    $data['main_content'] = $this->load->view($this->template_path . 'page/page' . $layoutView, $data, TRUE);
    $this->load->view($this->template_main, $data);
  }

  private function agency()
  {
    $this->load->model('agency_model');
    $agencyModel = new Agency_model();
    $params = array(
      'is_status' => 1,
      'limit' => 100
    );
    $data = $agencyModel->getData($params);
    return $data;
  }

  public function _404()
  {
    redirect('404.html', '', '301');
  }

  public function notfound()
  {
    $data['main_content'] = $this->load->view($this->template_path . 'page/_404', NULL, TRUE);
    $this->load->view($this->template_main, $data);
  }
}
