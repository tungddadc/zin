<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
  <div class="block block-account">
    <div class="block-title">Tài khoản của tôi</div>
    <div class="block-content">
      <ul>
        <li><a href="<?php echo getUrlProfile() ?>">Tổng quan tài khoản</a></li>
        <li><a href="<?php echo getUrlProfile('edit') ?>">Thông tin tài khoản</a></li>
        <li><a href="<?php echo getUrlProfile('order') ?>">Đơn đặt hàng</a></li>
        <li class=""><a href="<?php echo site_url('wishlist') ?>">Sản phẩm yêu thích</a></li>
        <li class=""><a href="<?php echo getUrlProfile('agency') ?>">Đăng ký đại lý</a></li>
        <li class=""><a href="<?php echo site_url('profile/changepassword') ?>">Thay đổi mật khẩu</a></li>
        <li><a href="<?php echo site_url('auth/login') ?>">Đăng xuất</a></li>
      </ul>
    </div>
  </div>
</aside>