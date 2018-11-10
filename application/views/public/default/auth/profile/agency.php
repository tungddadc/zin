<div class="my-account">
  <?php
  if ($this->session->userdata['is_agency'] != true) {
    ?>
    <fieldset class="col1-set account-login">
      <div class="page-title">
        <h2>Đăng ký đại lý</h2>
      </div>
      <form class="content sb_form" method="post" action="#">
        <ul class="form-list">
          <li>
            <label>Tên đại lý <span class="required">*</span></label>
            <input name="ac_name" title="Tên đại lý" class="input-text required-entry " type="text" value="">
          </li>
          <li>
            <label>Địa chỉ đại lý <span class="required">*</span></label>
            <input name="ac_address" title="Địa chỉ đại lý" class="input-text required-entry " type="text" value="">
          </li>
          <li>
            <label>Địa chỉ giao hàng <span class="required">*</span></label>
            <input name="ac_shipping" title="Địa chỉ nhận hàng" class="input-text required-entry " type="text" value="">
          </li>
          <li>
            <label>Lĩnh vực kinh doanh <span class="required">*</span></label>
            <input name="ac_business" title="Lĩnh vực kinh doanh" class="input-text required-entry " type="text"
                   value="">
          </li>
          <li>
            <label>Hotline <span class="required">*</span></label>
            <input name="ac_hotline" title="Hotline" class="input-text required-entry " type="text" value="">
          </li>
        </ul>
        <div class="buttons-set">
          <button class="button login" type="submit"><span>Đăng ký</span></button>
      </form>
    </fieldset>
    <?php
  } else {

    if ($this->_user_login->ac_is_status == 2) {
      ?>
      <fieldset class="col1-set account-login">
        <div class="page-title">
          <h2>Đăng ký đại lý</h2>
        </div>
        <h5>Bạn đã đăng ký làm đại lý của chúng tôi. Chờ chúng tôi xét duyệt đơn của bạn.</h5>
      </fieldset>
      <?php
    } else {
      ?>
      <fieldset class="col1-set account-login">
        <div class="page-title">
          <h2>Thông tin đại lý</h2>
        </div>
        <form class="content sb_form" method="post" action="#">

          <ul class="form-list">
            <li>
              <label>Tên đại lý</label>
              <input title="Tên đại lý" class="input-text required-entry " type="text" disabled
                     value="<?php echo $this->_user_login->ac_name ?>">
            </li>
            <li>
              <label>Địa chỉ đại lý </label>
              <input title="Địa chỉ đại lý" class="input-text required-entry " type="text" disabled
                     value="<?php echo $this->_user_login->ac_address ?>">
            </li>
            <li>
              <label>Địa chỉ giao hàng </label>
              <input title="Địa chỉ nhận hàng" class="input-text required-entry " type="text" disabled
                     value="<?php echo $this->_user_login->ac_shipping ?>">
            </li>
            <li>
              <label>Lĩnh vực kinh doanh </label>
              <input title="Lĩnh vực kinh doanh" class="input-text required-entry " disabled type="text"
                     value="<?php echo $this->_user_login->ac_business ?>">
            </li>
            <li>
              <label>Hotline </label>
              <input title="Hotline" class="input-text required-entry " disabled type="text"
                     value="<?php echo $this->_user_login->ac_hotline ?>">
            </li>
          </ul>
        </form>
      </fieldset>
      <?php
    }
  }
  ?>

</div>