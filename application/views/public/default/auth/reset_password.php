<!-- Main Container -->
<section class="main-container col1-layout">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-xs-12 col-xs-offset-3">
        <article class="col-main">
          <div class="account-login">
            <fieldset class="col1-set">
              <div class="col-2 "><strong>Reset mật khẩu</strong>
                <?php
                if(!empty($user_id)):
                ?>
                <form class="content sb_form" method="post" action="">
                  <ul class="form-list">
                    <li>
                      <label for="email">Mật khẩu mới <span class="required">*</span></label>

                      <?php echo form_input($new_password); ?>
                    </li>
                    <li>
                      <label for="email">Nhập lại mật khẩu mới <span class="required">*</span></label>

                      <?php echo form_input($new_password_confirm); ?>
                    </li>
                    <?php echo form_error('new_confirm') ?>

                    <?php echo form_input($user_id); ?>
                    <?php echo form_hidden($csrf); ?>
                    <input type="hidden" name="key_forgotten" value="<?php echo $code; ?>">
                  </ul>
                  <div class="buttons-set">
                    <button name="send" class="button login" id="send2" type="submit"><span>Gửi</span></button>
                </form>
                  <?php
                else:
                  echo '<p>Key thay đổi mật khẩu của bạn đã hết hạn. Vui lòng click <a href="'.site_url('auth/forgotpassword').'">vào đây</a> để tạo cấp lại key mới.</p>';
                endif;
                ?>
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