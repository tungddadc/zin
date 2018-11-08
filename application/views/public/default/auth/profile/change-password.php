<div class="my-account">

  <fieldset class="col1-set account-login">
    <div class="page-title">
      <h2>Thay đổi mật khẩu</h2>
    </div>
    <form class="content sb_form" method="post" action="#">
      <ul class="form-list">
        <li>
          <label for="">Mật khẩu cũ</label>
          <input name="old" title="Mật khẩu cũ" class="input-text required-entry " type="password" value="">
        </li>
        <li>
          <label for="">Mật khẩu mới</label>
          <input name="new" title="Mật khẩu mới" class="input-text required-entry " type="password" value="">
        </li>
        <li>
          <label for="email">Nhập lại mật khẩu mới</label>
          <input name="new_confirm" title="Nhập lại mật khẩu mới" class="input-text required-entry " type="password" value="">
        </li>
      </ul>
      <div class="buttons-set">

        <input type="hidden" name="id" value="<?php echo $this->_user_login->id ?>">
        <?php echo form_hidden($csrf); ?>
        <button name="send" class="button login" type="submit"><span>Đăng ký</span></button>
    </form>
  </fieldset>
</div>