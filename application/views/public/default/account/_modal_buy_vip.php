<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 04/07/2018
 * Time: 10:10 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="sl-buy-vip" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content md-content">
            <button type="button" class="md-close" data-dismiss="modal">&times;</button>
            <h3 class="title">Mua VIP</h3>
            <?php echo form_open('checkout/ajax_checkout_vip',array('id' => 'form_checkout_vip')) ?>

            <fieldset class="form-group">
                <legend><h5>Chọn gói VIP:</h5></legend>
                <?php if(!empty($this->settings['config']['vip_list_package'])):
                    $dataPackage = explode('|',$this->settings['config']['vip_list_package']);
                    foreach ($dataPackage as $k => $package): ?>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="package_id" value="<?php echo $package ?>" <?php echo $k == 0 ? 'checked' : '' ?>>
                                Gói VIP <?php echo $package ?> tháng (<?php echo formatMoney($this->settings['config']['vip_package'][$package]) ?>))
                            </label>
                        </div>
                    <?php endforeach; endif; ?>
            </fieldset>
            <br>
            <div class="text-center">
                <button class="butn v3 v4" type="reset" data-dismiss="modal">Hủy</button> &nbsp;&nbsp;&nbsp;
                <button class="butn v3" type="submit">Thanh toán</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>