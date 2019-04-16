<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Public_Controller
{
  protected $cid = 0;
  protected $_data;
  protected $_data_category;
  protected $_lang_code;
  protected $_all_category;

  public function __construct()
  {
    parent::__construct();
    //tải model
    $this->load->model(['category_model', 'post_model']);
    $this->_data = new Post_model();
    $this->_data_category = new Category_model();
    //$this->session->category_type = 'post';
    //Check xem co chuyen lang hay khong thi set session lang moi
    if ($this->input->get('lang'))
      $this->_lang_code = $this->input->get('lang');
    else
      $this->_lang_code = $this->session->public_lang_code;

    if (!$this->cache->get('_all_category_' . $this->session->public_lang_code)) {
      $this->cache->save('_all_category_' . $this->session->public_lang_code, $this->_data_category->getAll($this->session->public_lang_code), 60 * 60 * 30);
    }
    $this->_all_category = $this->cache->get('_all_category_' . $this->session->public_lang_code);
  }

  public function category($id, $page = 1)
  {
    $oneItem = $this->_data_category->getById($id,'*',$this->_lang_code);
    if (empty($oneItem)) show_404();
    if ($oneItem->type !== 'post') show_404();
    $data['category'] = $oneItem;
    $data['oneParent'] = $oneParent = $this->_data_category->_recursive_one_parent($this->_all_category, $id);
    if (!empty($oneParent)) $this->_data_category->_recursive_child($this->_all_category, $oneParent->id);
    /*Lay list id con của category*/
    $this->_data_category->_recursive_child_id($this->_all_category, $id);
    $data['listCateId'] = $listCateId = $this->_data_category->_list_category_child_id;
    /*Lay list id con của category*/
    $limit = 10;
    $params = array(
      'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
      'lang_code' => $this->_lang_code,
      'category_id' => $listCateId,
      'limit' => $limit,
      'page' => $page
    );
    $data['data'] = $this->_data->getData($params);
    $data['total'] = $this->_data->getTotal($params);
    /*Pagination*/
    $this->load->library('pagination');
    $paging['base_url'] = getUrlCateNews(['slug' => $oneItem->slug, 'id' => $oneItem->id, 'page' => 1]);
    $paging['first_url'] = getUrlCateNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]);
    $paging['total_rows'] = $data['total'];
    $paging['per_page'] = $limit;
    $this->pagination->initialize($paging);
    $data['pagination'] = $this->pagination->create_links();
    /*Pagination*/

    //SEO Meta
    $data['SEO'] = [
      'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
      'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : $oneItem->description,
      'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
      'url' => getUrlCateNews($oneItem),
      'image' => getImageThumb($oneItem->thumbnail, 400, 200)
    ];
    $layoutView = '';
    if (!empty($oneItem->style)) $layoutView = '-' . $oneItem->style;
    $data['main_content'] = $this->load->view($this->template_path . 'news/category' . $layoutView, $data, TRUE);
    $this->load->view($this->template_main, $data);
  }


  public function detail($id)
  {
    $oneItem = $this->_data->getById($id, '', $this->_lang_code);
    if ($this->input->get('lang')) {
      redirect(getUrlNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
    }
    $data['oneCategory'] = $oneCategory = $this->_data->getOneCateIdById($id);

    $data['listCategory'] = $listCategory = $this->_data->getCateIdById($id);
    foreach ($data['listCategory'] as $key => $value) {
      $list_cate = $value;
      // dump($list_cate);
    }
    $list_category_child = array();
    if (!empty($data['oneCategory'])) $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_all_category, $data['oneCategory']->id);
    if (!empty($data['oneParent'])) {
      $data['list_category_child'] = $list_category_child = $this->_data_category->getCategoryChild($data['oneParent']->id, $this->session->public_lang_code);
    }

    $data['oneItem'] = $oneItem;
    $params['is_status'] = 1;
    $params['lang_code'] = $this->_lang_code;
    $params['limit'] = 5;
    $params['group_by'] = 'id';
    $params['not_in'] = $id;

    $data['list_related'] = $this->_data->getData(array_merge($params,$list_category_child));
    $params['order'] = array('is_featured' => 'DESC', 'created_time' => 'DESC');
    $data['list_fetured'] = $this->_data->getData($params);
    //add breadcrumbs
    $this->breadcrumbs->push("<i class='icon_house_alt'></i>", base_url());
    if (!empty($oneCategory)) $this->_data_category->_recursive_parent($this->_all_category, $oneCategory->id);
    if (!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item) {
      $this->breadcrumbs->push($item->title, getUrlCateNews($item));
    }
    $this->breadcrumbs->push($oneItem->title, getUrlNews($oneItem));
    $data['breadcrumb'] = $this->breadcrumbs->show();
    //SEO Meta
    $data['SEO'] = [
      'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
      'meta_description' => !empty($oneItem->meta_title) ? $oneItem->meta_description : $oneItem->description,
      'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
      'url' => getUrlNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]),
      'image' => getImageThumb($oneItem->thumbnail, 400, 200)
    ];
    if (!empty($oneCategoryParent->style)) $layoutView = '-' . $oneCategoryParent->style;
    else {
      if (!empty($oneCategory->style)) $layoutView = '-' . $oneCategory->style;
      else $layoutView = '';
    }
    $data['main_content'] = $this->load->view($this->template_path . 'news/detail' . $layoutView, $data, TRUE);
    $this->load->view($this->template_main, $data);
  }

  public function ajax_load_more($id)
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $listCateId = !empty($this->input->post('listCateId')) ? json_decode($this->input->post('listCateId'), true) : '';
      $data['data'] = $this->getDataByCate($listCateId, $this->input->post('page'));
      if (!empty($data['data'])) {
        echo $this->load->view($this->template_path . 'news/list-items', $data, TRUE);
      }
      exit();
    }

  }

}
