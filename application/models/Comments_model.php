<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 17/12/2017
 * Time: 12:13 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends STEVEN_Model
{

  protected $table_product;

  public function __construct()
  {
    parent::__construct();
    $this->table = "comments";
    $this->account = "users";
    $this->column_order = array('id', 'account_id', 'object_id', 'content', 'created_time'); //thiết lập cột sắp xếp
    $this->column_search = array('id', 'content'); //thiết lập cột search
    $this->order_default = array("$this->table.id" => "DESC"); //cột sắp xếp mặc định

  }

  public function get_by_comment_id($id)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('parent_id', $id);
    $this->db->order_by("created_time", "ASC");
    return $this->db->get()->result();

  }


  public function getDataComment($args = array(), $returnType = "object")
  {
    $this->__where($args);
    $query = $this->db->get();
    //ddQuery($this->db);
    if ($returnType !== "object") return $query->result_array(); //Check kiểu data trả về
    else return $query->result();
  }

  public function __where($args, $typeQuery = null)
  {
    $select = "*";
    //$lang_code = $this->session->admin_lang; //Mặc định lấy lang của Admin
    $page = 1; //Page default
    $limit = 10;

    extract($args);
    //$this->db->distinct();
    $this->db->select("$this->table.id as id,$this->table.content,$this->table.created_time,$this->table.account_id,$this->account.fullname,$this->table.updated_time,$this->table.is_status");
    $this->db->from($this->table);

    $this->db->join($this->account, "$this->account.id = $this->table.account_id");

    if (!empty($id_product))
      $this->db->where("$this->table.id_product", $id_product);
    if (isset($is_status))
      $this->db->where("$this->table.is_status", $is_status);

    if (!empty($product_id))
      $this->db->where("$this->table.product_id", $product_id);

    if (isset($parent_id)) {
      $this->db->where("$this->table.parent_id", $parent_id);
    }
    if (!empty($in))
      $this->db->where_in("$this->table.id", $in);

    if (!empty($or_in))
      $this->db->or_where_in("$this->table.id", $or_in);

    if (!empty($not_in))
      $this->db->where_not_in("$this->table.id", $not_in);

    if (!empty($or_not_in))
      $this->db->or_where_not_in("$this->table.id", $or_not_in);
    if (!empty($order_by))
      $this->db->order_by("$this->table." . $order_by, 'DESC');
    $this->db->group_by("$this->table.id");
    //query for datatables jquery
    $this->_get_datatables_query();
    if (!empty($key_words)) {
      $this->db->group_start();
      $this->db->like("$this->table.content", $key_words);
      $this->db->or_like("$this->account.full_name", $key_words);
      $this->db->group_end();
    }

    if ($typeQuery === null || empty($typeQuery)) {
      if (!empty($order) && is_array($order)) {
        foreach ($order as $k => $v)
          $this->db->order_by($k, $v);
      } else if (isset($this->order_default)) {
        $order = $this->order_default;
        $this->db->order_by(key($order), $order[key($order)]);
      }
      $offset = ($page - 1) * $limit;
      $this->db->limit($limit, $offset);
    }
  }

}