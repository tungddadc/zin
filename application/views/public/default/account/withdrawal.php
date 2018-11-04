<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 04/07/2018
 * Time: 12:15 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
$numberPointAccount = getPointByUser($this->session->userdata('account')['account_id']);
?>
<?php $this->load->view($this->template_path . 'account/_header') ?>
<section id="form-mmo" class="page-profile">
    <div class="container">
        <h2 class="up-title">Đăng ký rút tiền</h2>
        <div class="uploader">
            <?php echo form_open('account/withdrawal', array('id' => 'form_withdrawal')) ?>
            <input type="hidden" name="account_id" value="<?php echo $this->session->userdata('account')['account_id'] ?>">
            <div class="fr-line">
                <p>Tỷ giá  : </p>
                <input type="text" value="<?php echo $this->settings['config']['point_fee'] ?> đ" placeholder="Tỷ giá" readonly disabled>
            </div>
            <div class="fr-line">
                <p>Số tiền rút: </p>
                <input type="number" name="point" max="<?php echo $numberPointAccount - ($numberPointAccount * round($this->settings['config']['commission_percent'] / 100,2)) ?>" placeholder="Số tiền rút">
            </div>
            <div class="fr-line">
                <button type="submit" class="submit">Gửi lệnh rút tiền</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</section>
