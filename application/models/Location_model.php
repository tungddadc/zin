<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends STEVEN_Model
{
  public $_table_city;
  public $_table_district;
  public $_table_ward;

  public function __construct()
  {
    parent::__construct();
    $this->_table_city = "location_city";
    $this->_table_district = "location_district";
    $this->column_order = array("$this->table.id", "$this->table.id", "$this->table.title", "$this->table.city_id", "$this->table.title", "$this->table.is_featured"); //thiết lập cột sắp xếp
    $this->column_search = array("$this->table.title"); //thiết lập cột search
    $this->order_default = array("$this->table.city_id"); //cột sắp xếp mặc định
  }

  private function __where($args, $typeQuery = null)
  {
    $this->column_search = array("$this->table.title");//thiết lập cột search

    $select = "*";
    //$lang_code = $this->session->admin_lang; //Mặc định lấy lang của Admin
    $page = 1; //Page default
    $limit = 10;
    extract($args);
    //$this->db->distinct();
    $this->db->select($select);
    $this->db->from($this->table);

    if (!empty($district_id))
      $this->db->where("$this->table.district_id", $district_id);

    if (!empty($city_id))
      $this->db->where("$this->table.city_id", $city_id);

    if (!empty($in))
      $this->db->where_in("$this->table.id", $in);

    if (!empty($or_in))
      $this->db->or_where_in("$this->table.id", $or_in);

    if (!empty($is_featured)){
      $this->db->where($this->table . '.is_featured', $is_featured);
    }
    if(!empty($order_by_name))
      $this->db->order_by("$this->table.slug",'ASC');
    if (!empty($not_in))
      $this->db->where_not_in("$this->table.id", $not_in);

    if($this->table!='location_district') $this->db->order_by("order DESC,slug ASC");
    if (!empty($or_not_in))
      $this->db->or_where_not_in("$this->table.id", $or_not_in);
    $this->_get_datatables_query();
    if (!empty($search)) {
      if (empty($this->table_trans)) $this->table_trans = $this->table;
      $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
      $this->db->like("$this->table_trans.title", $search);
      $this->db->group_end(); //close bracket
    }

    if ($typeQuery === null || empty($typeQuery)) {
      if (!empty($order) && is_array($order)) {
        foreach ($order as $k => $v)
          $this->db->order_by($k, $v);
      } else if (isset($this->order_default)) {
        $order = $this->order_default;
        $this->db->order_by(key($order), $order[key($order)]);
      }
      $offset = ($page - 1) * $limit;
      $this->db->limit($limit, $offset);
    }
  }

  public function getTotalLocation($args = [])
  {
    $this->__where($args, "count");
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function getAllLocaltion($type = 'city', $column = '*')
  {
    $this->db->select($column);
    $table = 'location_' . $type;
    $this->db->from($table);
    $this->db->order_by($table . ".id", 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function getTotalAllLocation($type = 'city')
  {
    $table = 'location_' . $type;
    $this->db->from($table);
    return $this->db->count_all_results();
  }

  public function saveCity($data)
  {
    $this->table = $this->_table_city;
    $this->save($data);
  }

  public function saveDistrict($data)
  {
    $this->table = $this->_table_district;
    $this->save($data);
  }

  public function saveWard($data)
  {
    $this->table = $this->_table_ward;
    $this->save($data);
  }

  public function getDataLocation($args = array(), $returnType = "object")
  {
    $this->__where($args);
    $query = $this->db->get();
    //    ddQuery($this->db);
    if ($returnType !== "object") return $query->result_array(); //Check kiểu data trả về
    else return $query->result();
  }

  private function loadContent($url)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
  }
  public function getByIdlocation($conditions, $tablename = '')
  {
    $this->db->from($tablename);
    $this->db->where($conditions);
    $query = $this->db->get()->row();
    return $query;
  }
  //Load from database
  public function updateLocation($conditions,$data, $tablename = '')
  {
    $dataInfo = [];
    if (!empty($data)) foreach ($data as $key => $value) {
      if (!is_array($value)) {
        $dataInfo[$key] = $value;
        unset($data[$key]);
      }
    }

    if (!$this->db->update($tablename, $dataInfo, $conditions)) {
      log_message('info', json_encode($conditions));
      log_message('info', json_encode($data));
      log_message('error', json_encode($this->db->error()));
      return false;
    }
    return true;
  }
  public function getDataCity($params = array())
  {
    $this->table = $this->_table_city;
    $this->column_order = array("$this->table.id", "$this->table.id", "$this->table.title"); //thiết lập cột sắp xếp
    return $this->getDataLocation($params);
  }

  public function getCityById($cityId)
  {
    return $this->single(array('id' => $cityId), $this->_table_city);
  }

  public function getDataDistrict($params= array())
  {
    $this->table = $this->_table_district;
    $this->column_order = array("$this->table.id", "$this->table.id", "$this->table.title", "$this->table.city_id", "$this->table.type", "$this->table.path_with_type", "$this->table.is_featured", "$this->table.longitude", "$this->table.latitude"); //thiết lập cột sắp xếp
    return $this->getDataLocation($params);
  }

  public function getDistrictById($districtId)
  {
    return $this->single(array('id' => $districtId), $this->_table_district);
  }
}