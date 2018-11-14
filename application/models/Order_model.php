<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{

  var $table = 'order';//bảng
  var $table_product = 'product';//bảng
  var $table_detail = 'order_detail';//bảng
  var $table_product_trans = 'product_translations';//bảng
  var $column_order = array('id', 'order_id', 'price', 'phone', 'created_time', 'shipped_time'); //thiết lập cột sắp xếp
  var $column_search = array('user_id', 'address', 'phone', 'email', 'full_name'); //thiết lập cột search

  // var $order_default = array('created_time' => 'desc'); //cột sắp xếp mặc định

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  private function _get_datatables_query()
  {
    if (!empty($this->input->post('columns'))) {
      $i = 0;
      foreach ($this->column_search as $item) // loop column
      {
        if ($this->input->post('search')['value']) // if datatable send POST for search
        {
          if ($i === 0) // first loop
          {
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $this->input->post('search')['value']);
          } else {
            $this->db->or_like($item, $this->input->post('search')['value']);
          }

          if (count($this->column_search) - 1 == $i) //last loop
            $this->db->group_end(); //close bracket
        }
        $i++;
      }

//            if ($this->input->post('order')){
//                $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
//            } else if ($this->input->post('order')){
//                $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
//            } else
//                if (isset($this->order_default)) {
//                $order = $this->order_default;
//                $this->db->order_by(key($order), $order[key($order)]);
//            }
    }
  }

  private function _whereOrder($args, $typeQuery = null)
  {
    $select = "*";
    // $order = $this->order_default;
    $lang_code = $this->session->admin_lang; //Mặc định lấy lang của Admin
    $page = 1; //truyền page active
    $limit = $this->config->item('cms_limit');

    extract($args);
    $this->db->distinct();
    $this->db->select($select);
    $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');
    if (!empty($is_featured))
      $this->db->where('tb1.is_featured', $is_featured);

    if (isset($is_status) && $is_status != "")
      $this->db->where("$this->table.is_status", $is_status);
    
    if (!empty($users_sale))
      $this->db->where("$this->table.users_sale", $users_sale);

    if (!empty($in))
      $this->db->where_in('tb1.id', $in);
// 
    if (!empty($or_in))
      $this->db->or_where_in('tb1.id', $or_in);

    if (!empty($not_in))
      $this->db->where_not_in('tb1.id', $not_in);

    if (!empty($or_not_in))
      $this->db->or_where_not_in('tb1.id', $or_not_in);

    //query for datatables jquery
    $this->_get_datatables_query();

    if (!empty($search)) {
      $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
      $this->db->like('title', $search);
      $this->db->or_like('description', $search);
      $this->db->group_end(); //close bracket
    }
    
    $order_default = array('created_time' => 'DESC');
    if ($typeQuery === null) {
           
      $offset = ($page - 1) * $limit;
      $this->db->limit($limit, $offset);
    }
  }

  public function getDataArr($args = array())
  {
    $select = '*';
    $in = array();
    $or_in = array();
    $not_in = array();
    $or_not_in = array();
    $status = null;
    $order_by = 'created_time DESC';  //Sample: $order_by = 'id DESC, name ASC';
    $page = 1; //Get page uri
    $limit = 10;
    $search = null;
    $user_id = null;
    $product = null;

    extract($args);
    $this->db->distinct();
    $this->db->select($select);
    $this->db->from($this->table . ' AS tb1');
//        if($product){
//            $this->db->join($this->table_detail.' AS tb2','tb1.id = tb2.order_id');
//        }

    if ($status !== null)
      $this->db->where("$this->table.is_status", $status);

    if ($user_id !== null)
      $this->db->where('tb1.user_id', $user_id);

    if (!empty($in))
      $this->db->where_in('tb1.id', $in);

    if (!empty($or_in))
      $this->db->or_where_in('tb1.id', $or_in);

    if (!empty($not_in))
      $this->db->where_not_in('tb1.id', $not_in);

    if (!empty($or_not_in))
      $this->db->or_where_not_in('tb1.id', $or_not_in);

    if ($search != null)
      $this->db->where(sprintf('tb1.full_name LIKE "%%%s%%")', $search));

//        if($order_by != null)
//            $this->db->order_by($order_by);

    $page = $page != 0 ? $page : 1;
    $offset = ($page - 1) * $limit;
    if ($limit == -1) $this->db->limit($limit, $offset); //-1 = all record
    $query = $this->db->get();
//        ddQuery($this->db);
    return $query->result();
  }

  // Chi tiết đơn hàng
  public function getDetailOrder($id)
  {
    $this->db->select("$this->table_detail.*,$this->table_product_trans.title");
    $this->db->from($this->table_detail);
    $this->db->join($this->table_product_trans, "$this->table_product_trans.id=$this->table_detail.product_id");
    $this->db->where("$this->table_product_trans.language_code", '');
  }


  public function getDataOrder($args = array(), $returnType = 'object')
  {
    $this->_whereOrder($args);
    $query = $this->db->get();
//        ddQuery($this->db);
    if ($returnType !== 'object') return $query->result_array(); //Check kiểu data trả về
    else return $query->result();
  }

  public function getTransport($id = 0)
  {
    $this->db->from($this->table_product);

    if ($id != 0) {
      $this->db->where('id', $id);

      return $this->db->get()->row();
    } else return $this->db->get()->result();

  }

  public function sumPrice($id)
  {
    $this->db->select('SUM(price) as total');
    $this->db->from($this->table_detail);
    $this->db->where('order_id = ' . $id);
    $data = $this->db->get()->row();
    return !empty($data) ? $data->total : 0;
  }

  public function sumOrderId($id)
  {
    $this->db->select('count(id) as total');
    $this->db->from($this->table_detail);
    $this->db->where('order_id = ' . $id);
    $data = $this->db->get()->row();
    return !empty($data) ? $data->total : 0;
  }

  public function one_detail($id)
  {
    $this->db->select('');
    $this->db->from($this->table_detail);
    $this->db->where('order_id = ' . $id);
    $data = $this->db->get()->row();
    return $data;
  }

  public function one_product($id)
  {
    $this->db->select("$this->table_product_trans.title");
    $this->db->from($this->table_detail);
    $this->db->join($this->table_product, "$this->table_product.id = $this->table_detail.product_id");
    $this->db->join($this->table_product_trans, "$this->table_product_trans.id=$this->table_detail.product_id");
    $this->db->where("$this->table_product.id", $id);
    $data = $this->db->get()->row();
    return $data;
  }

  public function getOrderByUser($id, $page, $limit)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    // $this->db->join($this->table_detail, "$this->table.id = $this->table_detail.order_id");
    $this->db->where('user_id', $id);
    $this->db->order_by("$this->table.created_time", 'DESC');

    $offset = ($page - 1) * $limit;
    $this->db->limit($limit, $offset);

    return $this->db->get()->result();

  }

  public function getTotalOrderByUser($id,$paramsFilter=array()){
    $this->db->select('1');
    $this->db->from($this->table);
    // $this->db->join($this->table_detail, "$this->table.id = $this->table_detail.order_id");
    $this->db->where('user_id', $id);
    if(isset($paramsFilter['is_status'])) $this->db->where('is_status', $paramsFilter['is_status']);
    $this->db->order_by("$this->table.created_time", 'DESC');

    return $this->db->get()->num_rows();
  }

  public function save($data)
  {
    $order = $data['order_info'];
    $orderDetail = $data['order_detail'];
    $orderDetailData = array();
    if (empty($this->db->insert($this->table, $order))) {
      log_message('info', json_encode($order));
      log_message('error', $this->db->error());
      return false;
    } else {
      $orderId = $this->db->insert_id();
      if (!empty($orderDetail)) foreach ($orderDetail as $item) {
        $orderDetailData['order_id'] = $orderId;
        $orderDetailData['product_id'] = $item['id'];
        $orderDetailData['quantity'] = $item['qty'];
        $orderDetailData['price'] = $item['subtotal'];
        if ($this->db->insert($this->table_detail, $orderDetailData) == false) {
          log_message('info', json_encode($orderDetailData));
          log_message('error', $this->db->error());
          return false;
        }
      }
    }
    return $orderId;
  }

  public function update($where, $data)
  {
    $data_store = array();
    if (!empty($data)) foreach ($data as $k => $item) {
      if (!is_array($item)) $data_store[$k] = $item;
    }

    if (!$this->db->update($this->table, $data_store, $where)) {
      log_message('info', json_encode($where));
      log_message('info', json_encode($data_store));
      log_message('error', $this->db->error());
      return false;
    }

    return true;
  }

  public function update_order_detail($where, $data)
  {
    $data_store = array();
    if (!empty($data)) foreach ($data as $k => $item) {
      if (!is_array($item)) $data_store[$k] = $item;
    }

    if (!$this->db->update($this->table_detail, $data_store, $where)) {
      return false;
    }

    return true;
  }

  /*
   * Đếm tổng số bản ghi lọc
   * */
  public function getTotal($args = [])
  {
    $this->_whereOrder($args, 'count');
    $query = $this->db->get();
    //dumpQuery($this->db);
    return $query->num_rows();
  }

  /*
  * Đếm tổng số bản ghi
  * */
  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  /*
   * Lấy dữ liệu một hàng ra
   * Truyền vào id
   * */

  public function get_by_id($id,$select='*',$lang_code = null){

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




//   public function get_by_id($id)
//   {
//     $this->db->select('*');
//     $this->db->from($this->table);
//     $this->db->where('id', $id);
// //        ddQuery($this->db);
//     return $this->db->get()->row();
//   }
public function get_by_id_store($id)
  {
    $this->db->select('*');
    $this->db->from($this->table_store);
    $this->db->where('id', $id);
//        ddQuery($this->db);
    return $this->db->get()->row();
  }
  //check xem voucher này đã được ăn ở don hang chua
  public function receivingedAccount($id, $account_id)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('user_id', $account_id);
    $this->db->where('voucher_id', $id);
    return $this->db->get()->row();
  }

  /*
       * Lấy list dữ liệu một hàng ra
       * Truyền vào order_id
       * */
  public function get_by_order_id($id, $status = '')
  {
//        ddQuery($this->db);
    $this->db->select('*');
    $this->db->from($this->table_detail);
    $this->db->where('order_id', $id);
    if (!empty($status)) $this->db->where('is_status', $status);
    return $this->db->get()->result();

  }

  // Lấy thông tin order theo code ERP
  public function getOrderByCode($code, $select = '*')
  {
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->where("$this->table.code", $code);
    $result = $this->db->get()->row();
    return $result;
  }

  public function delete_by_id($id)
  {
    //xoa item bảng post
    $this->db->where('id', $id);
    $this->db->delete($this->table);

    //xoa item bảng order detail
    $this->delete_order_detail_by_id($id);
  }
  public function delete_order_detail_by_id($id)
  {
    $this->db->where('order_id', $id);
    $this->db->delete($this->table_detail);
  }

  public function deleteItem($id, $order_id)
  {
    $this->db->where('product_id', $id);
    $this->db->where('order_id', $order_id);
    $reponsive = $this->db->delete($this->table_detail);
    return $reponsive;
  }
  public function saveOrder($data)
  {
    $order = $data['order_info'];
    $orderDetail = $data['order_detail'];
    $orderDetailData = array();
    if ($this->db->insert($this->table, $order) == false) {
      log_message('info', json_encode($order));
      log_message('error', $this->db->error());
      return false;
    } else {
      $orderId = $this->db->insert_id();
      if (!empty($orderDetail)) foreach ($orderDetail as $item) {
        $orderDetailData['order_id'] = $orderId;
        $orderDetailData['product_id'] = $item['id'];
        $orderDetailData['quantity'] = $item['qty'];
        $orderDetailData['price'] = $item['subtotal'];
        if ($this->db->insert($this->table_detail, $orderDetailData) == false) {
          log_message('info', json_encode($orderDetailData));
          log_message('error', $this->db->error());
          return false;
        }
      }


      return $orderId;
    }
  }

  public function getData($args = array(), $returnType = "object")
  {
    $this->_where($args);
    $query = $this->db->get();
    //ddQuery($this->db);
    if ($returnType !== "object") return $query->result_array(); //Check kiểu data trả về
    else return $query->result();
  }

  public function _where($args, $typeQuery = null)
  {
    $select = "*";
    //$lang_code = $this->session->admin_lang; //Mặc định lấy lang của Admin
    $page = 1; //Page default
    $limit = 10;

    extract($args);
    //$this->db->distinct();
    $this->db->select($select);
    $this->db->from($this->table);

    if ($this->table === 'product') $this->db->select('IF(`price_sale` = 0, `price`, `price_sale`) AS `price_sort`');

    if (!empty($this->table_trans)) {
      $this->db->join($this->table_trans, "$this->table.id = $this->table_trans.id");
      if (empty($lang_code)) $lang_code = $this->session->admin_lang;
      if (!empty($lang_code)) $this->db->where("$this->table_trans.language_code", $lang_code);
    }

    if (!empty($this->table_category) && !empty($category_id)) {
      $nameModel = str_replace('_model', '', $this->table);
      $this->db->join($this->table_category, "$this->table.id = $this->table_category.{$nameModel}_id");
      $this->db->where_in("$this->table_category.category_id", $category_id);
    }
    /*Lọc các thuộc tính của sản phẩm*/
    if (isset($filter_price_min) && !empty($filter_price_max)) {
      $this->db->where("IF(`price_sale` != 0, `price_sale`, `price`) >=", $filter_price_min);
      $this->db->where("IF(`price_sale` != 0, `price_sale`, `price`) <=", $filter_price_max);
    }

    if (!empty($filter_type))
      $this->db->where_in("$this->table.type", $filter_type);

    if (!empty($id_product))
      $this->db->where("$this->table.id_product", $id_product);

    if (!empty($property_type))
      $this->db->where_in("$this->table.type", $property_type);

    /*Lọc các thuộc tính của sản phẩm*/
    if (isset($parent_id) && $parent_id !== '')
      $this->db->where("$this->table.parent_id", $parent_id);

    if (!empty($position_id))
      $this->db->where("$this->table.position_id", $position_id);
    if (!empty($type))
      $this->db->where("$this->table.type", $type);

    if (!empty($category_type))
      $this->db->where("$this->table.type", $category_type);
    if (!empty($user_id))
      $this->db->where("$this->table.user_id", $user_id);

    if (isset($page_type))
      $this->db->where("$this->table.style", $page_type);

    if (isset($page_type_not))
      $this->db->where("$this->table.style !=", $page_type_not);

    if (!empty($is_featured))
      $this->db->where("$this->table.is_featured", $is_featured);


    if (isset($is_status))
      $this->db->where("$this->table.is_status", $is_status);

    if (!empty($status_check_cronjob))
            $this->db->where("$this->table.status_check_cronjob",$status_check_cronjob);

    if (!empty($product_id))
      $this->db->where("$this->table.product_id", $product_id);

    if (!empty($category_id_page))
      $this->db->where("$this->table.category_id", $category_id_page);

    if (!empty($in))
      $this->db->where_in("$this->table.id", $in);

    if (!empty($or_in))
      $this->db->or_where_in("$this->table.id", $or_in);

    if (!empty($not_in))
      $this->db->where_not_in("$this->table.id", $not_in);

    if (!empty($or_not_in))
      $this->db->or_where_not_in("$this->table.id", $or_not_in);
    if (!empty($order_by))
      $this->db->order_by("$this->table." . $order_by, 'DESC');
    $this->db->group_by("$this->table.id");
    //query for datatables jquery
    $this->_get_datatables_query();

    if (!empty($search)) {
      $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
      if (!empty($this->column_search)) foreach ($this->column_search as $field) $this->db->like($field, $search);
      else $this->db->like("$this->table_trans.title", $search);
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

  public function getOneOrder($args = array())
  {
    $this->db->select('*');
    $this->db->from($this->table);
    if (!empty($args['email'])) $this->db->where('email', $args['email']);
    if (!empty($args['phone'])) $this->db->where('phone', $args['phone']);
    if (!empty($args['code'])) $this->db->where('code', $args['code']);
    return $this->db->get()->row();
  }

  public function getOrderById($id)
  {
    $this->db->select('*');
    $this->db->from($this->table);
     $this->db->where('id', $id);
    return $this->db->get()->row();
  }

}
