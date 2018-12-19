<!-- Main Container -->
<section class="main-container col1-layout">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <article class="col-main">
          <div class="account-login">
            <div class="page-title">
              <h2>Đăng nhập hoặc tạo tài khoản mới</h2>
            </div>
            <fieldset class="col2-set">
              <div class="col-1 new-users"><strong>Tạo tài khoản</strong>
                <div class="content">
                  <p>Đăng ký tài khoản để dễ dàng mua hàng một cách nhanh nhất cũng như mua với giá đại lý của hệ thống.</p>
                  <div class="buttons-set">
                    <?php
                    $url_red = !empty($this->input->get('url')) ? site_url("auth/ajax_login?url=" . urlencode($this->input->get('url'))) :site_url("auth/ajax_login");

                    ?>
                    <button class="button create-account"
                            onclick="window.location='<?php echo site_url("auth/register") ?>';" type="button"><span>Tạo tài khoản</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-2 registered-users"><strong>Đăng nhập</strong>
                <form class="content sb_form" method="post" action="<?php echo $url_red ?>">
                  <p>Nếu bạn có tài khoản với chúng tôi, vui lòng đăng nhập.</p>
                  <ul class="form-list">
                    <li>
                      <label for="email">Tài khoản hoặc email <span class="required">*</span></label>
                      <input name="identity" title="Tài khoản hoặc email" class="input-text required-entry" id="email"
                             type="text" value="">
                      <?php echo form_error('identity', '<p class="text-danger">', '</p>') ?>
                    </li>
                    <li>
                      <label for="pass">Mật khẩu <span class="required">*</span></label>
                      <input name="password" title="Mật khẩu" class="input-text required-entry validate-password"
                             id="pass" type="password">
                      <?php echo form_error('password', '<p class="text-danger">', '</p>') ?>
                    </li>
                  </ul>
                  <div class="buttons-set">
                    <button name="send" class="button login" id="send2" type="submit"><span>Đăng nhập</span></button>
                    <a class="forgot-word" href="<?php echo site_url('auth/forgotpassword') ?>">Quên mật khẩu?</a></div>
                </form>
              </div>
            </fieldset>
          </div>
        </article>
        <!--	///*///======    End article  ========= //*/// -->
      </div>

    </div>
  </div>
</section>
<!-- Main Container End -->