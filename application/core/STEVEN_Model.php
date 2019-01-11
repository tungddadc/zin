<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 05/12/2017
 * Time: 4:24 CH
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Smart model.
 */
class STEVEN_Model extends CI_Model
{
	public $table;
	public $table_trans;
	public $primary_key;
	public $column_order;
	public $column_search;
	public $order_default;

	public $_dbprefix;

	public $_args = array();
	public $where_custom;

	public function __construct()
	{
		parent::__construct();
		$this->_dbprefix = $this->db->dbprefix;

		$this->table            = strtolower(str_replace('_model','',get_Class($this)));
		$this->primary_key      = "$this->table.id";
		$this->column_order     = array("$this->table.id","$this->table.id","$this->table_trans.title","$this->table.is_status","$this->table.updated_time","$this->table.created_time");
		$this->column_search    = array("$this->table_trans.title");
		$this->order_default    = array("$this->table.created_time" => "DESC");

		//load cache driver
        if(CACHE_MODE == TRUE) $this->load->driver('cache', array('adapter' => 'file'));
	}

	/*Hàm xử lý các tham số truyền từ Datatables Jquery*/
    public function _get_datatables_query(){
        $query = $this->input->post('query');
        if(!empty($query['generalSearch'])){
            $keyword = $query['generalSearch'];
            $fieldSearch = '';
            foreach ($this->column_search as $i => $item){
                if ($i == 0){
                    $this->db->group_start();
                    $this->db->like($item, $keyword, "after");
                    $this->db->or_like($item, $keyword);
                } else {
                    $this->db->or_like($item, $keyword, "after");
                    $this->db->or_like($item, $keyword);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();

                /*if($i != 0) $fieldSearch .= ',';
                $fieldSearch .= $this->_dbprefix.$item;*/
            }
            //$this->db->select('MATCH ('.$fieldSearch.') AGAINST ('.$this->db->escape($keyword).' IN BOOLEAN MODE) AS score_search');
            //$this->db->or_where('MATCH ('.$fieldSearch.') AGAINST ('.$this->db->escape($keyword).' IN BOOLEAN MODE)', NULL, FALSE);
            //$this->db->order_by('score_search','DESC');
        }

        if ($this->input->post('sort')) {
            $sort = $this->input->post('sort');
            $this->db->order_by($sort['field'], $sort['sort']);
        }
	}

	public function _where_before($args = array(), $typeQuery = false){
        $page = 1;
        $limit = 10;

		$select = "*";

		extract($args);
		//$this->db->distinct();
		$this->db->select($select);
		$this->db->from($this->table);

		if(!empty($this->table_trans)){
			$this->db->join($this->table_trans, "$this->table.id = $this->table_trans.id");
			if(empty($lang_code)) $lang_code = $this->session->userdata('admin_lang');
			if(!empty($lang_code)) $this->db->where("$this->table_trans.language_code",$lang_code);
		}

		if (isset($is_featured))
			$this->db->where("$this->table.is_featured",$is_featured);

		if (isset($is_status))
			$this->db->where("$this->table.is_status",$is_status);

		if (!empty($id))
			$this->db->where("$this->table.id",$id);

		if (!empty($in))
			$this->db->where_in("$this->table.id",$in);

		if (!empty($or_in))
			$this->db->or_where_in("$this->table.id",$or_in);

		if (!empty($not_in))
			$this->db->where_not_in("$this->table.id",$not_in);

		if (!empty($or_not_in))
			$this->db->or_where_not_in("$this->table.id",$or_not_in);


        $this->_get_datatables_query();

        if (!empty($search)) {
            $this->db->select('MATCH ('.$this->_dbprefix.$this->table_trans.'.title) AGAINST ('.$this->db->escape($search).' IN BOOLEAN MODE) AS score_search');
            $this->db->group_start();
            $this->db->like("$this->table_trans.title", $search);
            $this->db->or_like("$this->table_trans.title", $search);
            $this->db->or_where('MATCH ('.$this->_dbprefix.$this->table_trans.'.title) AGAINST ('.$this->db->escape($search).' IN BOOLEAN MODE)', NULL, FALSE);
            $this->db->group_end();
            $this->db->order_by('score_search','DESC');
        }


        if($typeQuery == false){
            if(!empty($order) && is_array($order)){
                foreach ($order as $k => $v)
                    $this->db->order_by($k, $v);
            }
            $offset = ($page-1)*$limit;
            $this->db->limit($limit,$offset);
        }
	}

	public function _where_custom($args = array()){}

	private function _where($args = array(), $typeQuery = null){
		$this->_where_before($args, $typeQuery);
		$this->_where_custom($args);
	}

	/*
     * Lấy tất cả dữ liệu
     * */
	public function getAll($lang_code = null,$is_status = null){
		$this->db->from($this->table);
		if(!empty($this->table_trans)) {
		    $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
            if(!empty($lang_code)) $this->db->where("$this->table_trans.language_code",$lang_code);
        }
		if(!empty($is_status)) $this->db->where("$this->table.is_status",$is_status);
		$query = $this->db->get();
		return $query->result();
	}


	/*
     * Đếm tổng số bản ghi
     * */
	public function getTotalAll($table = '')
	{
		if(empty($table)) $table = $this->table;
		$this->db->from($table);
		return $this->db->count_all_results();
	}



	public function getTotal($args = []){
		$this->_where($args, "count");
		$query = $this->db->get();
		//ddQuery($this->db);
		return $query->num_rows();
	}

	public function getData($args = array(),$returnType = "object"){
		$this->_where($args);
		$query = $this->db->get();
		if($returnType !== "object") return $query->result_array(); //Check kiểu data trả về
		else return $query->result();
	}

	/*
     * Lấy dữ liệu một hàng ra
     * Truyền vào id
     * */
	public function getById($id,$select='*',$lang_code = null){

		$this->db->select($select);
		$this->db->from($this->table);
		if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
		$this->db->where("$this->table.id",$id);
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


	public function getPrevById($id,$select='*',$lang_code = null){

		$this->db->select($select);
		$this->db->from($this->table);
		if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
		$this->db->where("$this->table.id <",$id);
		$this->db->where("$this->table.is_status",1);
		$this->db->order_by("$this->table.id",'DESC');
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

	public function getNextById($id,$select='*',$lang_code = null){

		$this->db->select($select);
		$this->db->from($this->table);
		if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
		$this->db->where("$this->table.id >",$id);
		$this->db->where("$this->table.is_status",1);
		$this->db->order_by("$this->table.id",'ASC');
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



	public function checkExistByField($field, $value, $tablename = ''){
        $this->db->select('1');
        if ($tablename == '') {
            $tablename = $this->table;
        }
        $this->db->from($tablename);
        $this->db->where($field, $value);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? true : false;
	}


	public function getSelect2($ids){
		$this->db->select("$this->table.id, title AS text");
		$this->db->from($this->table);
		if(!empty($this->table_trans)) {
		    $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
            $this->db->where("$this->table_trans.language_code",$this->session->userdata('admin_lang'));
        }
		if(is_array($ids)) $this->db->where_in("$this->table.id",$ids);
		else $this->db->where("$this->table.id",$ids);

		$query = $this->db->get();
		return $query->result();
	}


	public function save($data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}

		if(!$this->db->insert($tablename, $data)){
			log_message('info',json_encode($data));
			log_message('error',json_encode($this->db->error()));
			return false;
		}
        $id = $this->db->insert_id();
        return !empty($id) ? $id : $this->db->affected_rows();
	}



	public function search($conditions = null, $limit = 500, $offset = 0, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		if ($conditions != null) {
			$this->db->where($conditions);
		}

		$query = $this->db->get($tablename, $limit, $offset);

		return $query->result();
	}

	public function single($conditions, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->where($conditions);

		return $this->db->get($tablename)->row();
	}

    public function getDataAll($conditions = [], $tablename = '')
    {
        if ($tablename == '') {
            $tablename = $this->table;
        }
        if(!empty($conditions)) $this->db->where($conditions);

        return $this->db->get($tablename)->result();
    }

	public function insert($data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->insert($tablename, $data);
		return $this->db->insert_id();
	}


	public function insertMultiple($data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->insert_batch($tablename, $data);

		return $this->db->affected_rows();
	}

	public function insertOnUpdate($data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$data_update = [];
		if(!empty($data)) foreach ($data as $k => $val){
			$data_update[] = $k." = '".$val."'";
		}

		$queryInsertOnUpdate = $this->db->insert_string($tablename, $data)." ON DUPLICATE KEY UPDATE ".implode(', ', $data_update);
		if(!$this->db->query($queryInsertOnUpdate)){
			log_message('info',json_encode($data));
			log_message('error',json_encode($this->db->error()));
			return false;
		}

		return true;
	}

	public function update($conditions, $data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}

		if(!$this->db->update($tablename, $data, $conditions)){
			log_message('info',json_encode($conditions));
			log_message('info',json_encode($data));
			log_message('error',json_encode($this->db->error()));
			return false;
		}

		return true;
	}


	public function delete($conditions, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->where($conditions);
		if(!$this->db->delete($tablename)){
			log_message('info',json_encode($conditions));
			log_message('info',json_encode($tablename));
			log_message('error',json_encode($this->db->error()));
		}

		return $this->db->affected_rows();
	}

	public function deleteArray($field, $value = array(),$tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->where_in($field,$value);
		if(!$this->db->delete($tablename)){
			log_message('info',json_encode($tablename));
			log_message('error',json_encode($this->db->error()));
		}

		return $this->db->affected_rows();
	}

	public function count($conditions = null, $tablename = '')
	{
		if ($conditions != null) {
			$this->db->where($conditions);
		}

		if ($tablename == '') {
			$tablename = $this->table;
		}

		$this->db->select('1');
		return $this->db->get($tablename)->num_rows();
	}
}
