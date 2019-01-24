<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 17/12/2017
 * Time: 12:13 CH
 */
defined("BASEPATH") OR exit("No direct script access allowed");
class Property_model extends STEVEN_Model{

    public function __construct()
    {
        parent::__construct();

        $this->table            = "property";
        $this->table_trans      = "property_translations";
        $this->column_order     = array("$this->table.id","$this->table.id","$this->table.order","$this->table_trans.title","$this->table.is_status","$this->table.created_time","$this->table.updated_time"); //thiết lập cột sắp xếp
        $this->column_search    = array("$this->table_trans.title"); //thiết lập cột search
        $this->order_default    = array("$this->table.order" => "ASC"); //cột sắp xếp mặc định
    }

    public function _where_custom($args = []){
        extract($args);
        if(!empty($property_type)) $this->db->where("$this->table.type", $property_type);
        if(!empty($category_id)) $this->db->where("$this->table.category_id", $category_id);
    }

    public function _all_property($type = ''){
        $data = '';
        $lang_code = $this->session->userdata('public_lang_code');
        if(CACHE_MODE == TRUE){
            $key = '_all_property_'.$lang_code.'_'.$type;
            $data = $this->cache->get($key);
        }
        if(empty($data)){
            $params['type'] = $type;
            $params['lang_code'] = $this->session->userdata('public_lang_code');
            $data = $this->getData($params);
        }
        if(CACHE_MODE == TRUE) $this->cache->save($key,$data,3600);
        return $data;

    }

    public function getByIdCached($allProperty, $id){
        if(!empty($allProperty)) foreach ($allProperty as $key => $item){
            if($item->id == $id) return $item;
        }
        return false;
    }

    public function getDataByPropertyType($allProperty, $type){
        $dataType = [];
        if(!empty($allProperty)) foreach ($allProperty as $key => $item){
            if($item->type === $type) $dataType[] = $item;
        }
        return $dataType;
    }

    // get data group by
    public function getDataGroupBy()
    {
        $this->db->select('type');
        $this->db->from($this->table);
        $this->db->group_by('type');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function slugToId($slug){
        $this->db->select('tb1.id');
        $this->db->from($this->table.' AS tb1');
        $this->db->join($this->table_trans.' AS tb2','tb1.id = tb2.id');
        $this->db->where('tb2.slug',$slug);
        $data = $this->db->get()->row();
        return !empty($data)?$data->id:null;
    }

    public function getPropertyByType($lang_code = null,$type,$parent_id = 0){
        $this->db->from($this->table);
        if(!empty($this->table_trans)) $this->db->join($this->table_trans,"$this->table.id = $this->table_trans.id");
        if(!empty($lang_code)) $this->db->where([
            'type' =>$type,
            'language_code' => $lang_code,
            'parent_id' => $parent_id
        ]);
        $query = $this->db->get();
        return $query->result();
    }

}