<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 04/07/2018
 * Time: 12:15 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view($this->template_path . 'account/_header') ?>
<section id="form-mmo" class="page-profile">
    <div class="container">
        <h2 class="up-title">Đăng ký tài khoản upload kiếm tiền</h2>
        <div class="uploader">
            <?php echo form_open('account/register_make_money', array('id' => 'form_register_make_money')) ?>
            <input type="hidden" name="account_id" value="<?php echo $this->session->userdata('account')['account_id'] ?>">
            <div class="fr-line">
                <p>Họ và tên</p>
                <input type="text" name="fullname" placeholder="Họ và tên">
            </div>
            <div class="fr-line">
                <p>Số điện thoại</p>
                <input type="text" name="phone" placeholder="Số điện thoại">
            </div>
            <div class="fr-line">
                <p>Số tài khoản</p>
                <input type="text" name="bank_number" placeholder="Số tài khoản">
            </div>
            <div class="fr-line">
                <p>Ngân hàng</p>
                <select name="bank_name">
                    <option value="0">Ngân hàng</option>
                    <?php if(!empty($property_bank)) foreach ($property_bank as $item): ?>
                        <option value="<?php echo $item->title ?>"><?php echo $item->title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="fr-line">
                <p>Ảnh chân dung</p>
                <div class="hc-upload single">
                    <label>
                        <input type="text" name="avatar" autocomplete="disable" accept="image/x-png,image/gif,image/jpeg"
                               id="avatar_make_money" onclick="uploadImage(this)">
                        <span class="butn">Tải ảnh</span>
                        <span class="text">
                            <span class="i-title">Nhấp / kéo để tải ảnh lên</span>
                        </span>
                    </label>
                    <div class="img preview hidden">
                        <img src="//via.placeholder.com/200x200">
                        <button class="remove" type="button">&times;</button>
                    </div>
                </div>
            </div>
            <div class="fr-line">
                <p>Ảnh chứng minh thư (Mặt trước)</p>
                <div class="hc-upload single">
                    <label>
                        <input type="text" name="cmt_before" autocomplete="disable" accept="image/x-png,image/gif,image/jpeg" id="cmt_before"
                               onclick="uploadImage(this)">
                        <span class="butn">Tải ảnh</span>
                        <span class="text">
                            <span class="i-title">Nhấp / kéo để tải ảnh lên</span>
                        </span>
                    </label>
                    <div class="img preview hidden">
                        <img src="//via.placeholder.com/400x200">
                        <button class="remove" type="button">&times;</button>
                    </div>
                </div>
            </div>

            <div class="fr-line">
                <p>Ảnh chứng minh thư (Mặt sau)</p>
                <div class="hc-upload single">
                    <label>
                        <input type="text" name="cmt_after" autocomplete="disable" accept="image/x-png,image/gif,image/jpeg" id="cmt_after"
                               onclick="uploadImage(this)">
                        <span class="butn">Tải ảnh</span>
                        <span class="text">
                            <span class="i-title">Nhấp / kéo để tải ảnh lên</span>
                        </span>
                    </label>
                    <div class="img preview hidden">
                        <img src="//via.placeholder.com/400x200">
                        <button class="remove" type="button">&times;</button>
                    </div>
                </div>
            </div>

            <div class="fr-line">
                <p>Thiết kế mẫu</p>
                <div class="hc-upload single">
                    <label>
                        <input type="text" name="file_sample" autocomplete="disable" accept="image/x-png,image/gif,image/jpeg" id="file_sample"
                               onclick="uploadImage(this)">
                        <span class="butn">Tải ảnh</span>
                        <span class="text">
                            <span class="i-title">Nhấp / kéo để tải ảnh lên</span>
                             <span class="i-des">Hỗ trợ rar, zip, jpg, psd, ai, cdr, tif, abr, ppt, eps ... và các định dạng khác, kích thước dưới 2Mb</span>
                        </span>
                    </label>
                    <div class="img preview hidden">
                        <img src="//via.placeholder.com/400x200">
                        <button class="remove" type="button">&times;</button>
                    </div>
                </div>
            </div>
            <!--<div class="fr-line">
                <p>Thiết kế mẫu</p>
                <div class="hc-upload single">
                    <label>
                        <input type="text" name="file_sample" autocomplete="disable" id="file_sample"
                               onclick="uploadImage(this)">
                        <span class="butn">Tải ảnh</span>
                        <span class="text">
                            <span class="i-title">Nhấp / kéo để tải ảnh lên</span>
                            <span class="i-des">Hỗ trợ rar, zip, jpg, psd, ai, cdr, tif, abr, ppt, eps ... và các định dạng khác, kích thước dưới 2Mb</span>
                        </span>
                    </label>
                    <div class="img preview hidden">
                        <img src="//via.placeholder.com/400x400">
                        <button class="remove" type="button">&times;</button>
                    </div>
                </div>
            </div>-->
            <div class="fr-line">
                <button type="submit" class="submit">Gửi</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</section>
