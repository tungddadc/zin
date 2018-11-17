<div class="my-account">
  <div class="page-title">
    <h2>Chi tiết đơn hàng</h2>
    <div class="box-account">
      <div class="col2-set">
        <div class="col-1">
          Họ và tên: <b><?php echo $data->full_name ?></b>
        </div>
        <div class="col-2">
          Địa chỉ: <b><?php echo $data->address ?></b>
        </div>
      </div>
      <div class="col2-set">
        <div class="col-1">
          Email: <b><?php echo $data->email ?></b>
        </div>
        <div class="col-2">
          Số điện thoại: <b><?php echo $data->phone ?></b>
        </div>
      </div>
      <div class="col2-set">
        <div class="col-1">
          Thành phố: <b><?php echo getCityById($data->city_id) ?></b>
        </div>
        <div class="col-2">
          Phường xã: <b><?php echo getDistrict($data->district_id) ?></b>
        </div>
      </div>
      <div class="col2-set">
        <div class="col-1">
          Địa chỉ viết hóa đơn: <b><?php echo $data->bill_address ?></b>
        </div>
        <div class="col-2">
          Ngày nhận: <b><?php echo $data->shipped_time ?></b>
        </div>
      </div>
    </div>
  </div>
  <div class="dashboard">
    <div class="recent-orders">
      <div class="table-responsive">
        <table class="data-table" id="my-orders-table">
          <colgroup><col>
            <col>
            <col>
            <col width="1">
            <col width="1">
            <col width="1">
          </colgroup><thead>
          <tr class="first last">
            <th>Tên sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Số lượng</th>
            <th><span class="nobr">Tổng tiền</span></th>
          </tr>
          </thead>
          <tbody>
          <?php
          $total=0;
            if(!empty($orderDetail)) foreach ($orderDetail as $item){
              $total=$total + $item->quantity * $item->price;
              ?>
              <tr>
                <td><a href="<?php echo getUrlProduct(array('id'=>$item->id_product,'slug'=>$item->slug)) ?>"><?php echo $item->title ?></a></td>
                <td><?php echo formatMoney($item->price) ?></td>
                <td><?php echo $item->quantity ?></td>
                <td><?php echo formatMoney($item->quantity * $item->price) ?></td>
              </tr>
              <?php
            }
          ?>
          <tr>
            <td colspan="4" class="text-right"><h4><b>Tổng tiền: <?php echo formatMoney($total) ?></b></h4></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>