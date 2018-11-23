<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/01/2018
 * Time: 11:31 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback_model extends STEVEN_Model
{
    public function __construct(){
        parent::__construct();
        $this->table            = 'feedback';
        $this->column_order     = array('id','id','name','title','created_time','updated_time'); //thiết lập cột sắp xếp
        $this->column_search    = array('name','title'); //thiết lập cột search
        $this->order_default    = array('created_time' => 'desc'); //cột sắp xếp mặc định
    }
}