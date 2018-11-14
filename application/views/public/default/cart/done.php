  <div class="h-wrap">
    <div class="container">
      <div class="bk-success">
        <h3 class="title"><i class="fa fa-smile-o"></i> CẢM ƠN BẠN ĐÃ ĐẶT HÀNG CỦA CHÚNG TÔI</h3>
        <p>Đơn hàng được khởi tạo thành công. Mã đơn hàng <strong><?php echo $order->id ?></strong></p>
        <p>Thông tin chi tiết đơn hàng được gửi về <?php echo $order->email ?></p>
        <p><span>Nếu có bất kì thắc mắc hoặc cần thông tin hỗ trợ, bạn vui lòng liên hệ Hotline</span> <a class="smooth" href="tel:<?php echo $this->settings['hotline'] ?>" title="" rel="nofollow,noindex"><?php echo $this->settings['hotline'] ?></a></p>
        <a class="smooth def-btn" href="<?php echo base_url() ?>">Tiếp tục mua sắm</a>
      </div>
    </div>
  </div>
