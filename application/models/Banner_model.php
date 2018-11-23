<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/2/2018
 * Time: 11:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Banner_model extends STEVEN_Model
{
    public $table_property;
    public function __construct(){
        parent::__construct();
        $this->table            = "banner";
        $this->table_trans      = "banner_translations";
        $this->column_order     = array("$this->table.id", "$this->table.id", "$this->table_trans.title", "$this->table.is_status", "$this->table.created_time", "$this->table.updated_time");
        $this->column_search    = array("$this->table_trans.title");
        $this->order_default    = array("$this->table.id" => "ASC");
    }
    public function _where_custom($args = array()){
        parent::_where_custom();
        extract($args);

        if(!empty($property_id)){
            $this->db->where("$this->table.property_id",$property_id);
        }

    }
}