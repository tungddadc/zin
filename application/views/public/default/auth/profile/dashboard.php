<div class="my-account">
  <div class="page-title">
    <h2>My Dashboard</h2>
  </div>
  <div class="dashboard">
    <div class="welcome-msg"> <strong>Xin chào <?php echo $this->_user_login->fullname ?>!</strong>
    </div>
    <div class="recent-orders">
      <div class="title-buttons"><strong>Đơn đặt hàng gần đây</strong> <a href="<?php echo getUrlProfile('order') ?>">Tất cả đơn hàng</a> </div>
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
      </div>
    </div>
    <div class="box-account">
      <div class="page-title">
        <h2>Thông tin tài khoản</h2>
      </div>
      <div class="col2-set">
        <div class="col-1">
          <h5>Thông tin liên hệ</h5>
          <a href="<?php echo getUrlProfile('edit') ?>">Sửa</a>
          <p><?php echo $this->_user_login->fullname ?><br>
            <?php echo $this->_user_login->email ?><br>
            <a href="<?php echo getUrlProfile('changepassword') ?>">Thay đổi mật khẩu</a> </p>
        </div>
        <div class="col-2">
          <h5>Thông tin đại lý</h5>
          <a href="<?php echo getUrlProfile('agency') ?>">Sửa</a>
          <p> Đăng ký làm đại lý để được nhận giá rẻ hơn. </p>
        </div>
      </div>
    </div>
  </div>
</div>