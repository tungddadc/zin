<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/2/2018
 * Time: 11:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends STEVEN_Model
{
  public $_list_category_child;
  public $_list_category_parent;
  public $_list_category_child_id;

  public function __construct()
  {
    parent::__construct();
    $this->table = "category";
    $this->table_trans = "category_translations";
    $this->column_order = array("$this->table.id", "$this->table.id", "$this->table_trans.title", "$this->table.is_status", "$this->table.created_time", "$this->table.updated_time");
    $this->column_search = array("$this->table_trans.title");
    $this->order_default = array("$this->table.id" => "ASC");

  }

  public function _where_custom($args = array())
  {
    parent::_where_custom();
    extract($args);
    if (!empty($type)) $this->db->where("$this->table.type", $type);
    if (!empty($parent_id)) $this->db->where("$this->table.parent_id", $parent_id);

  }

  public function recusive_parent()
  {
    $sql = "SELECT tb1.id,parent_id,title,is_status,created_time,updated_time
FROM st_category AS tb1
JOIN st_category_translations AS tb2 ON tb1.id = tb2.id
WHERE parent_id = 0 AND TYPE = 'product'
UNION
SELECT tb1.id,parent_id,CONCAT(\"|----\", title) AS title ,is_status,created_time,updated_time
FROM st_category AS tb1
JOIN st_category_translations AS tb2 ON tb1.id = tb2.id
WHERE parent_id IN (SELECT id FROM st_category WHERE parent_id = 0)";
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function _all_category($type = '')
  {
    $data = '';
    $lang_code = $this->session->userdata('public_lang_code');
    if (CACHE_MODE == TRUE) {
      $key = '_all_category_' . $lang_code . '_' . $type;
      $data = $this->cache->get($key);
    }
    if (empty($data)) {
      $params['type'] = $type;
      $params['lang_code'] = $this->session->userdata('public_lang_code');
      $params['limit'] = 2000;
      $data = $this->getData($params);
    }
    if (CACHE_MODE == TRUE) $this->cache->save($key, $data, 3600);
    return $data;

  }

  public function getListRecursive($type, $parent_id = 0)
  {
    $all = $this->_all_category($type);
    $data = [];
    if (!empty($all)) foreach ($all as $key => $item) {
      if ($item->parent_id == $parent_id) {
        $tmp = $item;
        $tmp->list_child = $this->getListChild($all, $item->id);
        $data[] = $tmp;
      }
    }
    return $data;
  }

  /*Đệ quy lấy record parent id*/
  public function _recursive_one_parent($all, $id)
  {
    if (!empty($all)) foreach ($all as $item) {
      if ($item->id == $id) {
        if ($item->parent_id == 0) return $item;
        else return $this->_recursive_one_parent($all, $item->parent_id);
      }
    }
  }
  /*Đệ quy lấy record parent id*/

  /*Đệ quy lấy array list category con*/
  public function _recursive_child($all, $parentId = 0)
  {
    if (!empty($all)) foreach ($all as $key => $item) {
      if ($item->parent_id == $parentId) {
        $this->_list_category_child[] = $item;
        unset($all[$key]);
        $this->_recursive_child($all, $item->id);
      }
    }
  }
  /*Đệ quy lấy array list category con*/

  /*Đệ quy lấy array list category con*/
  public function getListChild($all, $parentId = 0)
  {
    $data = array();
    if (!empty($all)) foreach ($all as $key => $item) {
      if ($item->parent_id == $parentId) {
        $data[] = $item;
      }
    }
    return $data;
  }
  /*Đệ quy lấy array list category  con*/

  /*Đệ quy lấy list các ID*/
  public function _recursive_child_id($all, $parentId = 0)
  {
    $this->_list_category_child_id[] = (int)$parentId;
    if (!empty($all)) foreach ($all as $key => $item) {
      if ($item->parent_id == $parentId) {
        $this->_list_category_child_id[] = (int)$item->id;
        unset($all[$key]);
        $this->_recursive_child_id($all, (int)$item->id);
      }
      $this->_list_category_child_id = array_unique($this->_list_category_child_id);
    }
  }
  /*Đệ quy lấy list các ID*/

  /*Đệ quy lấy maps các ID cha*/
  public function _recursive_parent($all, $cateId = 0)
  {
    if (!empty($all)) foreach ($all as $key => $item) {
      if ($item->id === $cateId) {
        $this->_list_category_parent[] = $item;
        unset($all[$key]);
        $this->_recursive_parent($all, $item->parent_id);
      }
    }
  }

  /*Đệ quy lấy maps các ID cha*/

  public function getByIdCached($id)
  {
    $allCategories = $this->_all_category();
    if (!empty($allCategories)) foreach ($allCategories as $key => $item) {
      if ($item->id == $id) return $item;
    }
    return false;
  }

  public function getDataByCategoryType($allCategories, $type)
  {
    $dataType = [];
    if (!empty($allCategories)) foreach ($allCategories as $key => $item) {
      if ($item->type === $type) $dataType[] = $item;
    }
    return $dataType;
  }

  public function getRandomId($type = null)
  {
    if (empty($type)) $type = $this->session->userdata('type');
    $this->db->select('id');
    $this->db->from($this->table);
    $this->db->where('type', $type);
    $this->db->order_by('id', 'RANDOM');
    $this->db->limit(1);
    $query = $this->db->get();
    $data = $query->result();
    $result = [];
    if (!empty($data)) foreach ($data as $item) $result[] = $item->id;
    return $result;
  }

  // get data group by
  public function getDataGroupBy()
  {
    $this->db->select('type');
    $this->db->from($this->table);
    $this->db->group_by('type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function slugToId($slug)
  {
    $this->db->select("$this->table.id,$this->table_trans.slug");
    $this->db->from($this->table);
    $this->db->join($this->table_trans, "$this->table.id = $this->table_trans.id");
    $this->db->where("$this->table_trans.slug", $slug);
    $data = $this->db->get()->row();
    return !empty($data) ? $data->id : null;
  }

  public function getCateByLayout($layout)
  {
    $this->db->from($this->table);
    $this->db->where("$this->table.layout", $layout);
    $data = $this->db->get()->row();
    return $data;
  }

  public function getAllCategoryByType($lang_code = null, $type, $parent_id = 0)
  {
    $this->db->from($this->table);
    if (!empty($this->table_trans)) $this->db->join($this->table_trans, "$this->table.id = $this->table_trans.id");
    if (!empty($lang_code)) $this->db->where([
      'type' => $type,
      'language_code' => $lang_code,
      'parent_id' => $parent_id
    ]);
    $query = $this->db->get();
    return $query->result();
  }

  /*Lấy category cha*/
  public function getOneParent($id)
  {
    $params = [
      'lang_code' => $this->session->public_lang_code,
      'parent_id' => $id,
      'limit' => 1
    ];
    $data = $this->getData($params);
    return !empty($data) ? $data[0] : null;
  }


  public function getCategoryChild($id, $lang_code)
  {
    $this->db->from($this->table);
    if (!empty($this->table_trans)) $this->db->join($this->table_trans, "$this->table.id = $this->table_trans.id");
    $this->db->where([
      'language_code' => $lang_code,
      'parent_id' => $id,
      'is_status' => 1
    ]);
    $query = $this->db->get();
    return $query->result();
  }

  /*Lấy id thứ tự sắp xếp cuối cùng*/
  public function getLastOrder($idParent = 0)
  {
    $this->db->select('order');
    $this->db->from($this->table);
    $this->db->where([
      'type' => $this->session->userdata('type'),
      'parent_id' => $idParent,
    ]);
    $this->db->order_by('order', 'DESC');
    $this->db->limit(1);
    $data = $this->db->get()->row();
    if (!empty($data)) return $data->order;
    return 0;
  }
}