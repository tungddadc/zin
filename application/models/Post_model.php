<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/2/2018
 * Time: 11:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Post_model extends STEVEN_Model
{
    public $table_category;
    public function __construct(){
        parent::__construct();
        $this->table            = "post";
        $this->table_trans      = "post_translations";
        $this->table_category   = "post_category";
        $this->column_order     = array("$this->table.id", "$this->table.id", "$this->table_trans.title", "$this->table.is_featured", "$this->table.is_status", "$this->table.created_time", "$this->table.updated_time");
        $this->column_search    = array("$this->table_trans.title");
        $this->order_default    = array("$this->table.id" => "ASC");
    }
    public function _where_custom($args = array()){
        parent::_where_custom();
        extract($args);

        if(!empty($category_id)){
            $this->db->join($this->table_category,"$this->table.id = $this->table_category.{$this->table}_id");
            $this->db->where_in("$this->table_category.category_id",$category_id);
        }

    }

    public function getCategoryByPostId($id, $lang_code = null){
        if(empty($lang_code)) $lang_code = $this->session->userdata('admin_lang') ? $this->session->userdata('admin_lang') : $this->session->userdata('public_lang_code');
        $this->db->select();
        $this->db->from($this->table_category);
        $this->db->join("category_translations","$this->table_category.category_id = category_translations.id");
        $this->db->join("category","$this->table_category.category_id = category.id");
        $this->db->where('category_translations.language_code', $lang_code);
        $this->db->where($this->table_category.".post_id", $id);
        $data = $this->db->get()->result();
        return $data;
    }
    public function getSelect2Category($id, $lang_code = null){
        if(empty($lang_code)) $lang_code = $this->session->userdata('admin_lang') ? $this->session->userdata('admin_lang') : $this->session->userdata('public_lang_code');
        $this->db->select("$this->table_category.category_id AS id, category_translations.title AS text");
        $this->db->from($this->table_category);
        $this->db->join("category_translations","$this->table_category.category_id = category_translations.id");
        $this->db->where('category_translations.language_code', $lang_code);
        $this->db->where($this->table_category.".post_id", $id);
        $data = $this->db->get()->result();
        return $data;
    }
  public function getOneCateIdById($id)
  {
    $data = $this->getCategoryByPostId($id);
    return !empty($data)?$data[0]:null;
  }
  public function getCateIdById($id)
  {
    $this->db->select('category_id');
    $this->db->from($this->table_category);
    $this->db->where('post_id', $id);
    $data = $this->db->get()->result();
    $listId = [];
    if (!empty($data)) foreach ($data as $item) {
      $listId[] = $item->category_id;
    }
    return $listId;
  }
}