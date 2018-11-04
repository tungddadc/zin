<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 04/07/2018
 * Time: 10:10 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="sl-payment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content md-content">
            <button type="button" class="md-close" data-dismiss="modal">&times;</button>
            <h3 class="title">Nạp tiền <small>(Mức mua tối thiểu: <strong><?php echo $this->settings['config']['point_buy_min'] ?> đ</strong>)</small></h3>
            <?php echo form_open('checkout/ajax_checkout_payment',array('id' => 'form_checkout_payment')) ?>
            <div class="form-group row">
                <label for="number_point" class="col-sm-6 col-form-label">Số tiền cần mua: </label>
                <div class="col-sm-6">
                    <input type="number" name="number_point" id="number_point" value="<?php echo $this->settings['config']['point_buy_min'] ?>" class="form-control">
                    <input type="hidden" name="per_point" value="<?php echo $this->settings['config']['point_fee'] ?>">
                    <input type="hidden" name="amount" value="<?php echo $this->settings['config']['point_buy_min']*$this->settings['config']['point_fee'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-sm-6 col-form-label">Số tiền phải thanh toán: </label>
                <div class="col-sm-6">
                    <strong class="form-control-plaintext result-amount"><?php echo formatMoney($this->settings['config']['point_buy_min']*$this->settings['config']['point_fee']) ?></strong>
                </div>
            </div>

            <h6>Chọn phương thức thanh toán:</h6>
            <div class="row">
                <div class="col-6">
                    <label class="i-pay">
                        <input type="radio" name="payment" value="bank">
                        <span>
                            <img src="<?php echo $this->templates_assets ?>images/bank.jpg" alt="Thanh toán qua internet banking"/>
                        </span>
                    </label>
                </div>
                <div class="col-6">
                    <label class="i-pay">
                        <input type="radio" name="payment" value="visa">
                        <span>
                            <img src="<?php echo $this->templates_assets ?>images/visa.png" alt="Thanh toán bằng Visa"/>
                        </span>
                    </label>
                </div>
            </div>
            <br>
            <div class="text-center">
                <button class="butn v3 v4" type="reset" data-dismiss="modal">Hủy</button> &nbsp;&nbsp;&nbsp;
                <button class="butn v3" type="submit">Thanh toán</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>