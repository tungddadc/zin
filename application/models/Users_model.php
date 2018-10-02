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
        $this->column_search    = array("$this->table.username","$this->table.email","$this->table.first_name","$this->table.last_name");
        $this->order_default    = array("$this->table.created_time" => "DESC");
    }
}