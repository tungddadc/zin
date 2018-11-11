<!-- Main Container -->
<?php
$url_red = !empty($this->input->get('url')) ? site_url("auth/ajax_register?url=" . urlencode($this->input->get('url'))) : site_url("auth/ajax_register");

?>
<section class="main-container col1-layout">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-xs-12 col-xs-offset-2">
        <article class="col-main">
          <div class="account-login">
            <div class="page-title">
              <h2>Tạo tài khoản mới</h2>
            </div>
            <fieldset class="col1-set">
              <form class="content sb_form" method="post" action="<?php echo $url_red ?>">
                <ul class="form-list">
                  <li>
                    <label for="email">Tài khoản <span class="required">*</span></label>
                    <input name="username" title="Tài khoản " class="input-text required-entry" id="email"
                           type="text" value="">
                  </li>
                  <li>
                    <label for="email">Email <span class="required">*</span></label>
                    <input name="email" title="Email" class="input-text required-entry" type="text" value="">
                  </li>
                  <li>
                    <label for="email">Họ và tên <span class="required">*</span></label>
                    <input name="fullname" title="Họ và tên" class="input-text required-entry" type="text" value="">
                  </li>
                  <li>
                    <label for="email">Địa chỉ <span class="required">*</span></label>
                    <input name="address" title="Địa chỉ" class="input-text required-entry" type="text" value="">
                  </li>
                  <li>
                    <label for="email">Số điện thoại <span class="required">*</span></label>
                    <input name="phone" title="Số điện thoại" class="input-text required-entry" type="text" value="">
                  </li>
                  <li>
                    <label for="pass">Mật khẩu <span class="required">*</span></label>
                    <input name="password" title="Mật khẩu" class="input-text required-entry validate-password"
                           type="password">
                  </li>
                  <li>
                    <label for="pass">Nhập lại mật khẩu <span class="required">*</span></label>
                    <input name="repassword" title="Nhập lại mật khẩu"
                           class="input-text required-entry validate-password"
                           type="password">
                  </li>

                </ul>
                <div class="buttons-set">
                  <button name="send" class="button login"  type="submit"><span>Đăng ký</span></button>
              </form>
            </fieldset>
          </div>
        </article>
        <!--	///*///======    End article  ========= //*/// -->
      </div>

    </div>
  </div>
</section>
<!-- Main Container End -->