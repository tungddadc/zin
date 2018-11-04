<!-- Modal login -->
<div class="modal fade modal-login" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="modalAccountTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="icon_close " data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" title="">Đăng Nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1" title="">Đăng Ký</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <h2>Đăng nhập với tài khoản</h2>
                        <?php echo form_open('account/ajax_form_login', array('id'=>'form-login')) ?>
                        <div class="form-login">
                            <div class="form-group">
                                <label for="loginInputName">Tên đăng nhập:</label>
                                <input id="loginInputName" type="text" name="identity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="loginInputPassword1">Mật khẩu:</label>
                                <input id="loginInputPassword1" type="password" name="password" class="form-control">
                            </div>
                            <div class="submit_">
                                <button type="submit" class="btn">Đăng nhập</button>
                                <a href="javascript:;" title="Quên mật khẩu" data-toggle="modal" data-target="#modalForgetAccount">Quên mật khẩu?</a>
                            </div>
                            <p>Hoặc</p>
                            <div class="link-socials">
                                <a href="<?php echo base_url('account/window/Facebook') ?>" title="Login Facebook"><i class="social_facebook"></i></a>
                                <a href="<?php echo base_url('account/window/Google') ?>" title="Login Google"><i class="social_googleplus"></i></a>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                    <div class="tab-pane fade" id="menu1">
                        <h2>Đăng ký với tài khoản</h2>
                        <div class="link-socials">
                            <a href="<?php echo base_url('account/window/Facebook') ?>" title="Login Facebook"><i class="social_facebook"></i></a>
                            <a href="<?php echo base_url('account/window/Google') ?>" title="Login Google"><i class="social_googleplus"></i></a>
                        </div>
                        <p>Hoặc</p>
                        <?php echo form_open('account/ajax_register',array('id' => 'form-register')) ?>
                        <div class="form-login">
                            <div class="form-group">
                                <label for="registerInputName">Tên đăng nhập:</label>
                                <input id="registerInputName" type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="registerInputPassword1">Mật khẩu:</label>
                                <input id="registerInputPassword1" type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="registerInputPassword2">Nhập lại mật khẩu:</label>
                                <input id="registerInputPassword2" type="password" name="re-password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="registerInputEmail">Email: </label>
                                <input id="registerInputEmail" type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="registerInputCompany">Tên công ty: </label>
                                <input id="registerInputCompany" type="text" name="company" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="registerInputMST">MST/ĐKKD: </label>
                                <input id="registerInputMST" type="text" name="mst" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="registerInputCMT">Căn cước/CMND : </label>
                                <input id="registerInputCMT" type="text" name="cmnd" class="form-control">
                            </div>

                             <div class="form-group">
                                 <div class="g-recaptcha mb-4" data-sitekey="<?php echo GG_CAPTCHA_SITE_KEY ?>"></div>
                            </div>

                            <button type="submit" class="btn">Đăng ký</button>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End modal login -->

<!-- Modal login -->
<div class="modal fade modal-login" id="modalForgetAccount" tabindex="-1" role="dialog" aria-labelledby="modalForgetTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="icon_close " data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
            </div>
            <div class="modal-body">
                <h2>Quên mật khẩu tài khoản ?</h2>
                <?php echo form_open('account/ajax_form_forget_password', array('id'=>'form-forget-password')) ?>
                <div class="form-login">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="submit_">
                        <button type="submit" class="btn">Lấy lại mật khẩu</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- End modal login -->