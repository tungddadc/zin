<div class="my-account">

  <fieldset class="col1-set account-login">
    <div class="page-title">
      <h2>Thông tin tài khoản</h2>
    </div>
    <form class="content sb_form" method="post" action="#">
      <ul class="form-list">

        <li>
          <label for="email">Email <span class="required">*</span></label>
          <input name="email" title="Email" disabled class="input-text required-entry " type="text" value="<?php echo $this->_user_login->email ?>">
        </li>
        <li>
          <label for="email">Họ và tên <span class="required">*</span></label>
          <input name="fullname" title="Họ và tên" class="input-text required-entry " type="text" value="<?php echo $this->_user_login->fullname ?>">
        </li>
        <li>
          <label for="email">Địa chỉ <span class="required">*</span></label>
          <input name="address" title="Địa chỉ" class="input-text required-entry " type="text" value="<?php echo $this->_user_login->address ?>">
        </li>
        <li>
          <label for="email">Số điện thoại <span class="required">*</span></label>
          <input name="phone" title="Số điện thoại" class="input-text required-entry " type="text" value="<?php echo $this->_user_login->phone ?>">
        </li>
        <li>
          <label for="email">Địa chỉ giao hàng</label>
          <input name="shipping_address" title="Địa chỉ giao hàng" class="input-text required-entry " type="text" value="<?php echo $this->_user_login->shipping_address ?>">
        </li>
      </ul>
      <div class="buttons-set">
        <button name="send" class="button login" type="submit"><span>Cập nhật</span></button>
    </form>
  </fieldset>
</div>