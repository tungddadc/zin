<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/01/2018
 * Time: 11:31 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Newsletter_model extends STEVEN_Model
{
    public function __construct(){
        parent::__construct();

        $this->table = 'newsletter';
        $this->column_order = array('id','id','email','created_time'); //thiết lập cột sắp xếp
        $this->column_search = array('email'); //thiết lập cột search
        $this->order_default = array('id' => 'desc'); //cột sắp xếp mặc định
    }
}