<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/2/2018
 * Time: 11:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends STEVEN_Model
{
    public $table_category;
    public $table_detail;
    public function __construct(){
        parent::__construct();
        $this->table            = "product";
        $this->table_trans      = "product_translations";
        $this->table_category   = "product_category";
        $this->table_detail     = "product_detail";
        $this->column_order     = array("$this->table.id", "$this->table.id", "$this->table_trans.title", "$this->table.is_featured", "$this->table.is_status", "$this->table.created_time", "$this->table.updated_time");
        $this->column_search    = array("$this->table_trans.title");
        $this->order_default    = array("$this->table.created_time" => "DESC");
    }
    public function _where_custom($args = array()){
        parent::_where_custom();
        extract($args);

        $this->db->select('IF(`price_sale` = 0, `price`, `price_sale`) AS `price_sort`');
        $this->db->select("IF(`price_sale` = 0, 0, 1) AS `is_sale`");
        $this->db->select('IF(`created_time` <= DATE_ADD(NOW(), INTERVAL 10 DAY), 1, 0) AS `is_new`');

        if(!empty($quantity_begin) && !empty($quantity_end)){
            $this->db->join($this->table_detail,"$this->table.id = $this->table_detail.{$this->table}_id");
            $this->db->where("$this->table_detail.quantity_begin >=",$quantity_begin);
            $this->db->where("$this->table_detail.quantity_end <=",$quantity_end);
        }

        $this->db->join("(SELECT id AS product_id, COUNT(1) AS total_vote, ROUND( AVG(vote),1) AS vote FROM st_vote GROUP BY product_id) AS tblVote","tblVote.product_id = $this->table.id", "left");

        if(!empty($category_id)){
            $this->db->join($this->table_category,"$this->table.id = $this->table_category.{$this->table}_id");
            $this->db->where_in("$this->table_category.category_id",$category_id);
            $this->db->group_by("$this->table.id");
        }

        if(!empty($brand_id)){
            $this->db->where("$this->table.brand",$brand_id);
        }

        if(!empty($tags)){
            $this->db->select('MATCH (meta_keyword) AGAINST ('.$this->db->escape($tags).' IN BOOLEAN MODE) AS score_tags');
            $this->db->where('MATCH (meta_keyword) AGAINST ('.$this->db->escape($tags).' IN BOOLEAN MODE)', NULL, FALSE);
            $this->db->order_by('score_tags','DESC');
        }

        if (!empty($search_custom)) {
            $this->db->select('MATCH ('.$this->_dbprefix.$this->table_trans.'.title) AGAINST ('.$this->db->escape($search_custom).' IN BOOLEAN MODE) AS score_search');
            //$this->db->group_start();
            $this->db->like("$this->table_trans.title", $search_custom);
            //$this->db->or_like("$this->table.model", $search_custom);
            //$this->db->or_where('MATCH ('.$this->_dbprefix.$this->table_trans.'.title) AGAINST ('.$this->db->escape($search_custom).' IN BOOLEAN MODE)', NULL, FALSE);
            //$this->db->group_end();
            //$this->db->order_by('score_search','DESC');
        }
    }

    public function getBySlugCustom($slug, $lang_code = null){

        $this->db->select('*, IF(`total_vote` IS NULL, 0, `total_vote`) AS `total_vote`, IF(`vote` IS NULL, 0, `vote`) AS `vote`');
        $this->db->from($this->table);
        if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
        $this->db->join("(SELECT id AS product_id, COUNT(1) AS total_vote, ROUND( AVG(vote),1) AS vote FROM st_vote GROUP BY product_id) AS tblVote","tblVote.product_id = $this->table.id", "left");
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

    public function getCategoryByProductId($id, $lang_code = null){
        if(empty($lang_code)) $lang_code = $this->session->userdata('admin_lang') ? $this->session->userdata('admin_lang') : $this->session->userdata('public_lang_code');
        $this->db->select();
        $this->db->from($this->table_category);
        $this->db->join("category_translations","$this->table_category.category_id = category_translations.id");
        $this->db->join("category","$this->table_category.category_id = category.id");
        $this->db->where('category_translations.language_code', $lang_code);
        $this->db->where($this->table_category.".product_id", $id);
        $data = $this->db->get()->result();
        return $data;
    }

    public function getDetail($id){
        $this->db->select();
        $this->db->from($this->table_detail);
        $this->db->where($this->table_detail.".product_id", $id);
        $this->db->order_by($this->table_detail.".total_qty","ASC");
        $data = $this->db->get()->result();
        return $data;
    }

    public function getPriceAgency($id, $quantity){
        $this->db->select('price_agency');
        $this->db->from($this->table_detail);
        $this->db->where($this->table_detail.".product_id", $id);
        $this->db->where($this->table_detail.".total_qty <=", $quantity);
        $this->db->order_by($this->table_detail.".total_qty","DESC");
        $this->db->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    public function getSelect2Category($id, $lang_code = null){
        if(empty($lang_code)) $lang_code = $this->session->userdata('admin_lang') ? $this->session->userdata('admin_lang') : $this->session->userdata('public_lang_code');
        $this->db->select("$this->table_category.category_id AS id, category_translations.title AS text");
        $this->db->from($this->table_category);
        $this->db->join("category_translations","$this->table_category.category_id = category_translations.id");
        $this->db->where('category_translations.language_code', $lang_code);
        $this->db->where($this->table_category.".product_id", $id);
        $data = $this->db->get()->result();
        return $data;
    }

    public function getOneCateIdById($id){
        $data = $this->getCategoryByProductId($id, $this->session->userdata('public_lang_code'));
        return !empty($data)?$data[0]:null;
    }
}