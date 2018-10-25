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
    private function _get_datatables_query(){
        $query = $this->input->post('query');
        if(!empty($query['generalSearch'])){
            $keyword = $query['generalSearch'];
            $fieldSearch = '';
            foreach ($this->column_search as $i => $item){
                /*if ($i == 0){
                    $this->db->or_group_start();
                    $this->db->like($item, $keyword);
                } else {
                    $this->db->or_like($item, $keyword);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();*/

                if($i != 0) $fieldSearch .= ',';
                $fieldSearch .= $this->_dbprefix.$item;
            }
            $this->db->select('MATCH ('.$fieldSearch.') AGAINST ('.$this->db->escape($keyword).' IN NATURAL LANGUAGE MODE) AS score_search');
            $this->db->where('MATCH ('.$fieldSearch.') AGAINST ('.$this->db->escape($keyword).' IN NATURAL LANGUAGE MODE)', NULL, FALSE);
            $this->db->order_by('score_search','DESC');
        }

        if ($this->input->post('sort')) {
            $sort = $this->input->post('sort');
            $this->db->order_by($sort['field'], $sort['sort']);
        } else if (isset($this->order_default)) {
            $order = $this->order_default;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}

	public function _where_before($args = array()){
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

		if (!empty($in))
			$this->db->where_in("$this->table.id",$in);

		if (!empty($or_in))
			$this->db->or_where_in("$this->table.id",$or_in);

		if (!empty($not_in))
			$this->db->where_not_in("$this->table.id",$not_in);

		if (!empty($or_not_in))
			$this->db->or_where_not_in("$this->table.id",$or_not_in);

        if (!empty($search)) {
            $this->db->select('MATCH ('.$this->table_trans.'.title) AGAINST ('.$this->db->escape($search).' IN NATURAL LANGUAGE MODE) AS score_search');
            $this->db->where('MATCH ('.$this->table_trans.'.title) AGAINST ('.$this->db->escape($search).' IN NATURAL LANGUAGE MODE)', NULL, FALSE);
            //$this->db->or_group_start();
            //$this->db->like('title', $search);
            //$this->db->or_like('description', $search);
            //$this->db->group_end(); //close bracket
            $this->db->order_by('score_search','DESC');
        }

	}

	public function _where_after($args = array(), $typeQuery){
		$page = 1;
		$limit = 10;

		extract($args);

		//$this->db->group_by($this->primary_key);
		//query for datatables jquery
		$this->_get_datatables_query();

		if($typeQuery === null){
			if(!empty($order) && is_array($order)){
				foreach ($order as $k => $v)
					$this->db->order_by($k, $v);
			} else if(isset($this->order_default)) {
				$this->db->order_by(key($this->order_default), $this->order_default[key($this->order_default)]);
			}
			$offset = ($page-1)*$limit;
			$this->db->limit($limit,$offset);
		}
	}

	public function _where_custom($args = array()){}

	private function _where($args = array(), $typeQuery = null){
		$this->_where_before($args);
		$this->_where_custom($args);
		$this->_where_after($args, $typeQuery);
	}

	/*
     * Lấy tất cả dữ liệu
     * */
	public function getAll($lang_code = null,$is_status = null){
		$this->db->from($this->table);
		if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.$this->primary_key = $this->table_trans.$this->primary_key");
		if(!empty($lang_code)) $this->db->where("$this->table_trans.language_code",$lang_code);
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
		return $this->db->count_all_results() > 0 ? true : false;
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
		$data_store = array();
		if(!empty($data)) foreach ($data as $k=>$item){
			if(!is_array($item)) $data_store[$k] = $item;
		}

		if(!$this->db->insert($tablename, $data_store)){
			log_message('info',json_encode($data_store));
			log_message('error',json_encode($this->db->error()));
			return false;
		}else {
			$id = $this->db->insert_id();

			/*Xử lý bảng category nếu có*/
			if(!empty($this->table_category) && !empty($data['category_id']) && is_array($data['category_id'])){
				$dataCategory = $data['category_id'];
				if(!empty($dataCategory)) foreach ($dataCategory as $item){
					$tmpCategory[$this->table."_id"] = $id;
					$tmpCategory["category_id"] = $item;
					if(!$this->insert($tmpCategory, $this->table_category)) return false;
					unset($tmpCategory);
				}
			}
			if(isset($data['category_id'])) unset($data['category_id']);

			/*Xử lý tags nếu có*/
			if(!empty($this->table_tags) && !empty($data['tags']) && is_array($data['tags'])){
				$dataTags = $data['tags'];
				if(!empty($dataTags)) foreach ($dataTags as $item){
					$tmpTags[$this->table."_id"] = $id;
					$tmpTags["tag_id"] = $item;
					if(!$this->insert($tmpTags, $this->table_tags)) return false;
				}
			}
			if(isset($data['tags'])) unset($data['tags']);

			/*Xử lý bảng property nếu có*/
			if(!empty($this->table_property) && !empty($data['property']) && is_array($data['property'])){
				$dataProperty = $data['property'];
				$tmpProperty = array();
				if(!empty($dataProperty)) foreach ($dataProperty as $type => $item){
					if(is_array($item)) foreach ($item as $v){
						$tmp[$this->table."_id"] = $id;
						$tmp["type"] = $type;
						$tmp["property_id"] = $v;
						$tmpProperty[] = $tmp;
					}else{
						$tmp[$this->table."_id"] = $id;
						$tmp["type"] = $type;
						$tmp["property_id"] = $item;
						$tmpProperty[] = $tmp;
					}
				}
				if(!$this->insertMultiple($tmpProperty, $this->table_property)) return false;
				unset($tmpProperty);
			}
			if(isset($data['property'])) unset($data['property']);

			/*Xử lý bảng detail nếu có*/
			if(!empty($this->table_detail) && !empty($data['detail']) && is_array($data['detail'])){
				$dataDetail = $data['detail'];
				$tmpDetail = array();
				if(!empty($dataDetail)) foreach ($dataDetail as $item){
                    $tmpd[$this->table."_id"] = $id;
				    if(!empty($item)) foreach ($item as $key => $value){
                        if(is_array($value)){
                            $tmpd[$key] = json_encode($value);
                        }else{
                            $tmpd[$key] = $value;
                        }
                        if($key === 'is_in_stock') $tmpd['is_in_stock'] = true;
                    }
                    $tmpDetail[] = $tmpd;
				}
				if(!$this->insertMultiple($tmpDetail, $this->table_detail)) return false;
				unset($tmpDetail);
			}
			if(isset($data['detail'])) unset($data['detail']);

			/*Xử lý bảng translate nếu có*/
			if(!empty($this->table_trans)){
				//thêm vào bảng product_translation
				foreach ($this->config->item('cms_language') as $lang_code => $lang_name) {
					$data_trans = array();
					$data_trans['id'] = $id;
					$data_trans['language_code'] = $lang_code;
					foreach ($data as $k => $item) {
						if($lang_code !== 'vi') $lang_code_value = 'vi';
						else $lang_code_value = $lang_code;
						if (is_array($item)) {
							if($k === 'title' || $k === 'meta_title') $data_trans[$k] = !empty($item[$lang_code_value]) ? addslashes($item[$lang_code_value]) : '';
							else if(is_array($item[$lang_code_value])) $data_trans[$k] = !empty($item[$lang_code_value]) ? json_encode($item[$lang_code_value]) : '';
							$data_trans[$k] = !empty($item[$lang_code_value]) ? $item[$lang_code_value] : '';
						}
						if(isset($item[$lang_code_value]) && is_array($item[$lang_code_value])) $data_trans[$k] = !empty($item[$lang_code_value]) ? json_encode($item[$lang_code_value]) : '';
					}
					if (!$this->db->insert($this->table_trans, $data_trans)) {
						log_message('info', json_encode($data_trans));
						log_message('error', json_encode($this->db->error()));
						return false;
					}
				}
			}
			$this->cache->clean();
			return $id;
		}
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

	public function insert($data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->insert($tablename, $data);
		$this->cache->clean();
		return $this->db->affected_rows();
	}


	public function insertMultiple($data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}
		$this->db->insert_batch($tablename, $data);
		$this->cache->clean();
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
		$this->cache->clean();
		return $this->db->affected_rows();
	}

	public function update($conditions, $data, $tablename = '')
	{
		if ($tablename == '') {
			$tablename = $this->table;
		}

		$dataInfo = [];
		if(!empty($data)) foreach ($data as $key => $value){
			if(!is_array($value)) {
				$dataInfo[$key] = $value;
				unset($data[$key]);
			}
		}

		if(!$this->db->update($tablename, $dataInfo, $conditions)){
			log_message('info',json_encode($conditions));
			log_message('info',json_encode($data));
			log_message('error',json_encode($this->db->error()));
			return false;
		}

		/*Xử lý bảng category nếu có*/
		if(!empty($this->table_category) && isset($data['category_id'])){
			$dataCategory = $data['category_id'];
			$tmpCategory[$this->table."_id"] = $conditions['id'];
			$this->delete($tmpCategory, $this->table_category);
			if(!empty($dataCategory)) foreach ($dataCategory as $item){
				$tmpCategory["category_id"] = $item;
				if(!$this->insert($tmpCategory, $this->table_category)) {
					ddQuery($this->db);
					log_message('error',json_encode($this->db->error()));
					return false;
				}
			}
		}
		if(isset($data['category_id'])) unset($data['category_id']);

		/*Xử lý tags nếu có*/
		if(!empty($this->table_tags) && isset($data['tags'])){
			$dataTags = $data['tags'];
			$tmpTags[$this->table."_id"] = $conditions['id'];
			$this->delete($tmpTags, $this->table_tags);
			if(!empty($dataTags)) foreach ($dataTags as $item){
				$tmpTags["tag_id"] = $item;
				if(!$this->insert($tmpTags, $this->table_tags)) return false;
			}
		}
		if(isset($data['tags'])) unset($data['tags']);

		/*Xử lý bảng property nếu có*/
		if(!empty($this->table_property) && isset($data['property'])){
			$dataProperty = $data['property'];
			$this->delete([$this->table."_id" => $conditions['id']], $this->table_property);
			$tmpProperty = array();
			if(!empty($dataProperty)) foreach ($dataProperty as $type => $item){
				if(is_array($item)) foreach ($item as $v){
					$tmp[$this->table."_id"] = $conditions['id'];
					$tmp["type"] = $type;
					$tmp["property_id"] = $v;
					$tmpProperty[] = $tmp;
				}else{
					$tmp[$this->table."_id"] = $conditions['id'];
					$tmp["type"] = $type;
					$tmp["property_id"] = $item;
					$tmpProperty[] = $tmp;
				}
			}
			if(!$this->insertMultiple($tmpProperty, $this->table_property)) return false;
			unset($tmpProperty);
		}
		if(isset($data['property'])) unset($data['property']);

        /*Xử lý bảng detail nếu có*/
        if(!empty($this->table_detail) && isset($data['detail'])){
            $dataDetail = $data['detail'];
            $this->delete([$this->table."_id" => $conditions['id']], $this->table_detail);
            $tmpDetail = array();
            if(!empty($dataDetail)) foreach ($dataDetail as $item){
                $tmpd[$this->table."_id"] = $conditions['id'];
                if(!empty($item)) foreach ($item as $key => $value){
                    if(is_array($value)){
                        $tmpd[$key] = json_encode($value);
                    }else{
                        $tmpd[$key] = $value;
                    }
                }
                $tmpDetail[] = $tmpd;
            }
            if(!$this->insertMultiple($tmpDetail, $this->table_detail)) return false;
            unset($tmpDetail);
        }
        if(isset($data['detail'])) unset($data['detail']);

		/*Xử lý bảng translate nếu có*/
		if(!empty($this->table_trans)){
			if($this->config->item('cms_language')) foreach ($this->config->item('cms_language') as $lang_code => $lang_name){
				$data_trans = array();
				$data_update = array();
				foreach ($data as $k=>$item){
					if(is_array($item)) {
						if($k === 'title' || $k === 'meta_title') {
							$data_trans[$k] = !empty($item[$lang_code]) ? addslashes($item[$lang_code]) : '';
							$data_update[] = $k." = '".addslashes($item[$lang_code])."'";
						} else if(is_array($item[$lang_code])) {
							$data_trans[$k] = !empty($item[$lang_code]) ? json_encode($item[$lang_code]) : '';
							$data_update[] = $k." = '".json_encode($item[$lang_code])."'";
						}else{
							$data_trans[$k] = !empty($item[$lang_code]) ? $item[$lang_code] : '';
							$data_update[] = $k." = '".$item[$lang_code]."'";
						}
					}
				}
				//dd($data_trans);
				if(!empty($data_trans)){
					$where_trans = array('id'=>$conditions['id'],'language_code'=>$lang_code);
					if(!$this->db->update($this->table_trans, $data_trans, $where_trans)){
						log_message('info',json_encode($data_trans));
						log_message('error',json_encode($this->db->error()));
						return false;
					}
					/*$where_trans = array('id'=>$conditions['id'],'language_code'=>$lang_code);
                    $data_trans = array_merge($where_trans,$data_trans);
                    $queryInsertOnUpdate = $this->db->insert_string($this->table_trans, $data_trans)." ON DUPLICATE KEY UPDATE id = {$conditions['id']}, language_code = '{$lang_code}', ".implode(", ", $data_update);
                    echo $queryInsertOnUpdate;
                    if(!$this->db->query($queryInsertOnUpdate)){
                        log_message('info',json_encode($where_trans));
                        log_message('info',json_encode($data_trans));
                        log_message('error',json_encode($this->db->error()));
                        return false;
                    }*/
				}
			}
		}
		$this->cache->clean();
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
		$this->cache->clean();
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

	public function getpostAllLang($id){
		$this->db->distinct();
		$this->db->select(['slug','language_code']);
		$this->db->from($this->table_trans);
		$this->db->where('id',$id);
		$query= $this->db->get()->result();
		return $query;
	}
}
