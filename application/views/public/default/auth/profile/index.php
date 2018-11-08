<!-- Main Container -->
<section class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-sm-push-3">
        <article class="col-main">
          <?php if(!empty($main_profile)) echo $main_profile; ?>
        </article>
        <!--	///*///======    End article  ========= //*/// -->
      </div>
      <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
        <div class="side-banner"><img alt="banner" src="<?php echo site_url() ?>images/side-banner.jpg"></div>
        <div class="block block-account">
          <div class="block-title">My Account</div>
          <div class="block-content">
            <ul>
              <li><a href="<?php echo getUrlProfile() ?>">Tổng quan tài khoản</a></li>
              <li><a href="<?php echo getUrlProfile('edit') ?>">Thông tin tài khoản</a></li>
              <li><a href="#">Đơn đặt hàng</a></li>
              <li><a href="#">Review sản phẩm</a></li>
              <li class=""><a href="#">My Wishlist</a></li>
              <li class=""><a href="<?php echo site_url('profile/changepassword') ?>">Thay đổi mật khẩu</a></li>
              <li><a href="<?php echo site_url('auth/login') ?>">Đăng xuất</a></li>
            </ul>
          </div>
        </div>
        <div class="block block-compare">
          <div class="block-title "><span>Compare Products (2)</span></div>
          <div class="block-content">
            <ol id="compare-items">
              <li class="item odd">
                <input class="compare-item-id" type="hidden" value="2173">
                <a title="Remove This Item" class="btn-remove1" href="#"></a> <a class="product-name" href="#"> Sofa with Box-Edge Polyester Wrapped Cushions</a> </li>
              <li class="item last even">
                <input class="compare-item-id" type="hidden" value="2174">
                <a title="Remove This Item" class="btn-remove1" href="#"></a> <a class="product-name" href="#"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a> </li>
            </ol>
            <div class="ajax-checkout">
              <button title="Submit" class="button button-compare" type="submit"><span>Compare</span></button>
              <button title="Submit" class="button button-clear" type="submit"><span>Clear</span></button>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Main Container End -->