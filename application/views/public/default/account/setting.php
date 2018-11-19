<?php
    /**
     * Created by PhpStorm.
     * User: Steven Nguyen
     * Date: 28/06/2018
     * Time: 12:56 SA
     */
    defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view($this->template_path . 'account/_header') ?>
<?php if(!empty($oneAccount)): ?>
<section class="page-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <?php $this->load->view($this->template_path . 'account/_sidebar') ?>
            </div>
            <div class="col-lg-10">
                <?php echo form_open('account/ajax_update',array('id' => 'form_account_update')) ?>
                <div class="wrap-profile-summary edit">
                    <div class="content-profile-edit">
                        <ul>
                            <li>
                                <div class="content-primary">
                                    <div class="content-left">
                                        <span>Thông tin cá nhân</span>
                                    </div>
                                    <a href="javascript:;" title="Chỉnh sửa" class="btn-edit btn-toggle-content">Chỉnh sửa <i class="lnr lnr-chevron-down" aria-hidden="true"></i></a>
                                </div>
                                <div class="content-absolute">
                                    <div class="form-group">
                                        <label for="">Tên tài khoản</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo $oneAccount->username ?>" autocomplete="disabled" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Họ và tên</label>
                                        <input type="text" name="fullname" class="form-control" value="<?php echo $oneAccount->fullname ?>" autocomplete="disabled">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="content-primary">
                                    <div class="content-left">
                                        <span>Hình đại diện</span>
                                    </div>
                                    <a href="javascript:;" title="Chỉnh sửa" class="btn-edit btn-toggle-content">Chỉnh sửa <i class="lnr lnr-chevron-down" aria-hidden="true"></i></a>
                                </div>
                                <div class="content-absolute">
                                    <div class="avatar_preview mb-3 text-center">
                                        <?php if(!empty($oneAccount->avatar)): ?>
                                            <img width="200" height="200"  src="<?php echo getImageThumb($oneAccount->avatar,200,200) ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn hình ảnh <span>*</span></label>
                                        <div class="input-file">
                                            <input id="avatar_upload" type="text" name="avatar" autocomplete="disabled" onclick="chooseImage('avatar_upload')">
                                            <p class="note-ipFile"><span><i class="lnr lnr-cloud-upload"></i>Thả hình ảnh ở đây hoặc nhấp để tải lên</span></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="content-primary">
                                    <div class="content-left">
                                        <span>Số điện thoại</span>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $oneAccount->phone ?>" autocomplete="disabled">
                                    </div>
                                    <a href="javascript:;" title="Chỉnh sửa" class="btn-edit btn-toggle-content">Chỉnh sửa <i class="lnr lnr-chevron-down" aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="content-primary">
                                    <div class="content-left">
                                        <span>Email</span>
                                        <input type="email" name="email" class="form-control" value="<?php echo $oneAccount->email ?>" autocomplete="disabled">
                                    </div>
                                    <a href="javascript:;" title="Chỉnh sửa" class="btn-edit btn-toggle-content">Chỉnh sửa <i class="lnr lnr-chevron-down" aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="content-primary">
                                    <div class="content-left">
                                        <span>Tài khoản xã hội</span>
                                        <div class="social">
                                            <a href="<?php echo base_url('auth/window/Facebook') ?>" title="Login Facebook"><i class="social_facebook_circle"></i></a>
                                            <a href="<?php echo base_url('auth/window/Google') ?>" title="Login Facebook"><i class="social_googleplus_circle"></i></a>
                                        </div>
                                    </div>
                                    <a href="javascript:;" title="Chỉnh sửa" class="btn-edit btn-toggle-content">Chỉnh sửa <i class="lnr lnr-chevron-down" aria-hidden="true"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>