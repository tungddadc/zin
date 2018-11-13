<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/01/2018
 * Time: 11:31 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_model extends STEVEN_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'voucher';
    $this->table_account_gift = 'account_gift';
    $this->table_account_lucky = 'lucky';
    $this->column_order = array('id', 'id', 'event', 'code', 'percent_sale', 'created_time'); //thiết lập cột sắp xếp
    $this->column_search = array('code'); //thiết lập cột search
    $this->order_default = array('id' => 'desc'); //cột sắp xếp mặc định
  }

  public function __where($args, $typeQuery = null, $select = '*')
  {
    $is_status = '';
    //$lang_code = $this->session->admin_lang; //Mặc định lấy lang của Admin
    $page = 1; //Page default
    $limit = 10;
    extract($args);
    //$this->db->distinct();
    $this->db->select($select);
    $this->db->from($this->table);
    if (!empty($account_gift)) {
      $this->db->join($this->table_account_gift, "$this->table_account_gift.type_id=$this->table.id");
      if (!empty($account_id))
        $this->db->where("$this->table_account_gift.account_id", $account_id);
      if (!empty($type))
        $this->db->where("$this->table_account_gift.type", $type);
    }
    if (isset($is_status) && $is_status != '') {
      $this->db->where("$this->table.is_status", $is_status);
    }
    if (!empty($status)) {
      if($status==3){
        $this->db->where("$this->table_account_gift.status", 0);

      }else{
        $this->db->where("$this->table_account_gift.status", $status);

      }
    }


    if (!empty($in))
      $this->db->where_in("$this->table.id", $in);

    if (!empty($or_in))
      $this->db->or_where_in("$this->table.id", $or_in);

    if (!empty($not_in))
      $this->db->where_not_in("$this->table.id", $not_in);

    if (!empty($or_not_in))
      $this->db->or_where_not_in("$this->table.id", $or_not_in);

    if (!empty($group_by))
      $this->db->group_by("$this->table.$group_by");
    //query for datatables jquery
    $this->_get_datatables_query();

    if (!empty($order_custom)) {
      foreach ($order_custom as $key => $item) {
        if ($key == 'is_status') {
          $this->db->order_by("$this->table.$key", $item);
        } else {
          $this->db->order_by("$this->table_account_gift.$key", $item);

        }
      }
    }
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

  public function getDataVoucher($args = array(), $returnType = "object", $select = '*')
  {
    $this->__where($args, null, $select);
    $query = $this->db->get();

    if ($returnType !== "object") return $query->result_array(); //Check kiểu data trả về
    else return $query->result();
  }

  public function getTotalVoucher($args = [])
  {
    $this->__where($args, "count", '1');
    $query = $this->db->get();
    //ddQuery($this->db);
    return $query->num_rows();
  }

  public function getByCode($code,$check='')
  {
    $this->db->select('*');
    $this->db->from($this->table);
    if(empty($check)) $this->db->where("is_status", 1);
    $this->db->where('code', $code);
    $data = $this->db->get()->row();
    return $data;
  }

  public function getVoucherById($id)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id', $id);
    $data = $this->db->get()->row();
    return $data;
  }

  // kiểm tra mã voucher tồn tại hay chưa

  public function check_code($code)
  {
    $this->db->select('1');
    $this->db->from($this->table);
    $this->db->where('code', $code);
    $data = $this->db->get()->num_rows();

    return $data;
  }

  //  Kiểm tra tài khoản đã ăn voucher hay chưa
  public function receivingAccount($code_id, $account_id, $type = 'voucher')
  {
    if (!empty($code_id) && !empty($account_id)) {
      $this->db->select("1");
      $this->db->from($this->table_account_gift);
      $this->db->where("status", 1);
      $this->db->where('type', $type);
      $this->db->where('type_id', $code_id);
      $this->db->where('account_id', $account_id);
      $data = $this->db->get()->row();
      return $data;
    }
    return false;
  }


  // Lấy 1 voucher cho user quay trúng

  public function apply_for_race($voucher_id, $race_id)
  {
    if (empty($voucher_id) || empty($race_id)) {
      $this->db->select("apply_for");
      $this->db->from($this->table);
      $this->db->where("status", 1);
      $this->db->where('id', $voucher_id);
      $data = $this->db->get()->row();
      if (empty($data)) return true;
      else {
        if ($data->apply_for == $race_id) return true;
        else return false;
      }
    }
    return false;
  }

//  Số voucher được dụng cho lượt quay miễn phí
  public function count_apply_for_race($race_id)
  {
    $this->db->select("apply_for");
    $this->db->from($this->table);
    $this->db->where("is_status", 1);
    $this->db->where("apply_for", $race_id);
    $this->db->where("list_gift", '');
    $this->db->where("user_use", '');
    $data = $this->db->count_all_results();
    return $data;

  }

  //  Kiểm tra tài khoản đã ăn voucher hay chưa
  public function getOneVoucher($race_id)
  {
    if (!empty($race_id)) {
      $this->db->select(array("id", "code", 'percent_sale'));
      $this->db->from($this->table);
      $this->db->where("is_status", 1);
      $this->db->where("list_gift", '');
      $this->db->where("user_use", '');
      $this->db->where("apply_for", $race_id);
      $data = $this->db->get()->row();
      return $data;
    }
    return false;
  }

//  Xử lý ăn voucher
  public function useVoucher($code_id, $account_id, $type = 'voucher')
  {
    $this->db->select("1");
    $this->db->from($this->table_account_gift);
    $this->db->where('type', $type);
    $this->db->where('type_id', $code_id);
    $this->db->where('account_id', $account_id);
    $data = $this->db->get()->row();
    $params = array('type' => $type, 'type_id' => $code_id, 'account_id' => $account_id);
    if (empty($data)) {
      $responsive = $this->insert($params, $this->table_account_gift);
    }
//    ddQuery($this->db);
    return $responsive;
  }

  // Kiểm tra xem user đó còn lượt quay hay không
  public function luotquay($race_id, $account_id, $status = '')
  {
    $this->db->select('*');
    $this->db->from($this->table_account_lucky);
    if (!empty($status)) $this->db->where('is_status', $status);
    $this->db->where('race_id', $race_id);
    $this->db->where('account_id', $account_id);
    $data = $this->db->get()->row();
    return $data;
  }

  // Xử lý hết hạn voucher khi được gán chi thành viên
  public function expiredVoucher($id)
  {
    $this->db->update('account_gift', array('status' => 3), array('type_id' => $id, 'type' => 'voucher', 'status' => 2));
  }

}