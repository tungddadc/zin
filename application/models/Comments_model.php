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

    public function _where_custom($args = array())
    {
        parent::_where_custom();
        extract($args);
        if (!empty($parent_id)) $this->db->where("$this->table.parent_id", $parent_id);
        if (!empty($product_id)) $this->db->where("$this->table.product_id", $product_id);

    }

    public function _recursive($data, $parent_id){
        $comment = array();
        $data = (array) $data;
        $tmp2 = array();
        if(!empty($data)) foreach ($data as $key => $item)
        {
            if ((int)$item->parent_id == (int)$parent_id)
            {
                $tmp = (array)$item;
                unset($data[$key]);
                if($parent_id == 0) {
                    $listChild = $this->_recursive($data,$item->id);
                    $tmp2['list_child'] = array_reverse($listChild);
                }
                $comment[] = (object)array_merge($tmp,$tmp2);
            }
        }
        return $comment;
    }

    public function get_by_comment_id($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('parent_id', $id);
        $this->db->order_by("created_time", "ASC");
        return $this->db->get()->result();

    }
}