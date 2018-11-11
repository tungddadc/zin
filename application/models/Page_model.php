<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/2/2018
 * Time: 11:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Page_model extends STEVEN_Model
{
    public $table_category;
    public function __construct(){
        parent::__construct();
        $this->table            = "page";
        $this->table_trans      = "page_translations";
        $this->table_category   = "page_category";
        $this->column_order     = array("$this->table.id", "$this->table.id", "$this->table_trans.title", "$this->table.is_status", "$this->table.created_time", "$this->table.updated_time");
        $this->column_search    = array("$this->table_trans.title");
        $this->order_default    = array("$this->table.id" => "ASC");
    }
    public function _where_custom($args = array()){
        parent::_where_custom();
        extract($args);
    }

  public function getBySlug($slug,$select='*',$lang_code = null){

    $this->db->select($select);
    $this->db->from($this->table);
    if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
    $this->db->where("$this->table_trans.slug",$slug);
    if(empty($this->table_trans)){
      $query = $this->db->get();
      return $query->row();
    }

    if(!empty($lang_code)){
      $this->db->where("$this->table_trans.language_code",$lang_code);
      $query = $this->db->get();
      return $query->row();
    }else{
      $query = $this->db->get();
      return $query->result();
    }
  }

  public function slugToId($slug){
    $this->db->select('tb1.id');
    $this->db->from($this->table.' AS tb1');
    $this->db->join($this->table_trans.' AS tb2','tb1.id = tb2.id');
    $this->db->where('tb2.slug',$slug);
    $data = $this->db->get()->row();
    //ddQuery($this->db);
    return !empty($data)?$data->id:null;
  }
}