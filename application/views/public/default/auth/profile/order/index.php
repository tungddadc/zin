<div class="my-account">
  <div class="page-title">
    <h2>Quản lý đơn hàng</h2>
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
            <th>Order #</th>
            <th>Ngày đặt</th>
            <th>Địa chỉ</th>
            <th><span class="nobr">Tổng tiền</span></th>
            <th width="160">Trạng thái</th>
            <th>&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          <?php $this->load->view($this->template_path.'auth/profile/order/item'); ?>
          </tbody>
        </table>
        <div class="phantrang">
          <?php echo $pagination; ?>
        </div>
      </div>
    </div>
  </div>
</div>