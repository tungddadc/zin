<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/01/2018
 * Time: 11:31 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Vote_model extends STEVEN_Model
{
    public function __construct(){
        parent::__construct();
        $this->table = 'vote';
        $this->column_order = array('id','id','email','created_time'); //thiết lập cột sắp xếp
        $this->column_search = array('email'); //thiết lập cột search
        $this->order_default = array('id' => 'desc'); //cột sắp xếp mặc định
    }

    public function getVote($id){
        $this->db->select('COUNT(1) AS count_vote, ROUND( AVG(vote),1) AS avg');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $data = $query->row();
        return $data;
    }

    public function getVoteById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $data = $query->result();
        return $data;
    }
}