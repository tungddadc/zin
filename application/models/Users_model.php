<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/2/2018
 * Time: 11:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends STEVEN_Model
{
    protected $table_user_group;
    public function __construct()
    {
        parent::__construct();
        $this->table            = "users";
        $this->table_user_group = "users_groups";
        $this->column_order     = array("$this->table.id", "$this->table.id", "$this->table.username","$this->table.email","$this->table.first_name","$this->table.active", "$this->table.created_time", "$this->table.updated_time");
        $this->column_search    = array("$this->table.username");
        $this->order_default    = array("$this->table.created_time" => "DESC");
    }


    public function _where_custom($args = array())
    {
        extract($args);
        if(!empty($group_id)){
            $this->db->join($this->table_user_group,"$this->table.id = $this->table_user_group.user_id");
            $this->db->where_in("$this->table_user_group.group_id",$group_id);
        }
        if(isset($active)){
            $this->db->where("$this->table.active",$active);
        }
    }
}