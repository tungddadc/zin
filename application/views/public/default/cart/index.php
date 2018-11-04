<?php
    /**
     * Created by PhpStorm.
     * User: Steven Nguyen
     * Date: 01/07/2018
     * Time: 3:41 CH
     */
    defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view($this->template_path . 'account/_header') ?>

<section class="page-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-9">
                <?php echo form_open('cart/update'); ?>
                <div class="my-store">
                    <div class="title-cart">
                        <p>Giỏ hàng của tôi<span> (<?php echo $this->cart->total_items() ?>)</span></p>
                    </div>
                    <div class="list-cart">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Thông tin sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Hoạt động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                    $is_contact = false; ?>
                                <?php if ($this->cart->contents()) foreach ($this->cart->contents() as $items):
                                    $oneProduct = getProduct($items['id']);
                                    $oneFormat = getPropertyByProduct($items['id'],'format');
                                    $oneColorMode = getPropertyByProduct($items['id'],'color_mode');
                                    if ($items['price'] == 0) $is_contact = true;
                                    ?>
                                    <tr>
                                        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                                        <td scope="row">
                                            <div class="cart_1">
                                                <a href="<?php echo getUrlProduct($oneProduct) ?>" target="_blank" title="<?php echo $oneProduct->title; ?>">
                                                    <img src="<?php echo getImageThumb($oneProduct->thumbnail,70,70) ?>" alt="<?php echo $oneProduct->title; ?>">
                                                </a>
                                                <p><a href="<?php echo getUrlProduct($oneProduct) ?>" target="_blank" title="<?php echo $oneProduct->title; ?>"><?php echo $oneProduct->title; ?></a></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="info">
                                                <p>Định dạng: <?php echo !empty($oneFormat->title) ?  $oneFormat->title : '' ?></p>
                                                <p>Chế độ màu: <?php echo !empty($oneColorMode->title) ?  $oneColorMode->title : '' ?></p>
                                                <p><strong>Kích cỡ: <?php echo $oneProduct->size ?> pixels</strong></p>
                                                <p><strong>Dung lượng: <?php echo $oneProduct->capacity ?></strong></p>
                                            </div>
                                        </td>
                                        <td><strong><?php echo $oneProduct->price ?></strong> đ</td>
                                        <td>
                                            <div class="btn-control">
                                                <a data-id="<?php echo $oneProduct->id ?>" class="icon-love" title="Thêm vào yêu thích">Thêm vào yêu thích</a>
                                                <a href="javascript:;" class="btnDeleteCart" title="Xóa">Xóa</a>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; else echo "<tr><td class='text-center' colspan='4'>" . lang('text_cart_empty') . "</td></tr>"; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pr-ne">
                        <button type="reset" onclick="window.location.href = '<?php echo base_url('cart/destroy') ?>'">Empty cart</button>
                        <button type="button" onclick="window.location.href = '<?php echo base_url('tat-ca-danh-muc-cp1') ?>'">Tiếp tục mua hàng</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="col-md-12 col-lg-3">
                <div class="payment">
                    <?php $couponCookie = get_cookie('coupon_apply');
                    if(!empty($couponCookie)) {
                        $valueCoupon = getValueCoupon($couponCookie, 'coupon');
                        $valueNumber = formatPercent($valueCoupon);
                    } ?>
                    <p>Mã giảm giá</p>
                    <div class="form">
                        <input type="text" name="coupon" value="<?php echo $couponCookie ?>" placeholder="Nhập mã...">
                        <button type="button" class="applyCoupon">Sử dụng</button>
                    </div>
                    <div class="surplus">
                        <p>Tổng tiền: </p>
                        <p><span class="total"><?php echo $this->cart->total(); ?></span> đ</p>
                    </div>
                    <p class="result-coupon text-right"><?php echo !empty($valueCoupon) ? "Bạn được giảm $valueCoupon" : (!empty($couponCookie) ? '<span class="text-danger">Mã hết hạn</span>' : '')?></p>
                    <div class="surplubtnDeleteCarts">
                        <p>Tổng cộng: <span class="total_number"><?php echo !empty($valueNumber) ? $this->cart->total() - ($this->cart->total()*$valueNumber) : $this->cart->total(); ?></span> đ</p>
                        <input type="hidden" name="total" value="<?php echo !empty($valueNumber) ? $this->cart->total() - ($this->cart->total()*$valueNumber) : $this->cart->total(); ?>">
                    </div>
                    <p>Phương thức thanh toán:</p>
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
                    <div class="payment-tt">
                        <button type="button" class="btnCheckout">Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
