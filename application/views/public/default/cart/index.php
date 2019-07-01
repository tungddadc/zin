<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 01/07/2018
 * Time: 3:41 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <article class="col-main">
                    <div class="cart">
                        <div class="page-title">
                            <h2>Đơn hàng của bạn</h2> - <span style="font-size: 18px;color: red;">Lưu ý: Zin Linh Kiện chấp nhận xử lý đơn hàng tối thiểu từ 200.000đ trở lên! Mong quý khách hàng thông cảm và tiếp tục chọn thêm sản phẩm!</span>
                        </div>
                        <div class="table-responsive">
                            <?php echo form_open('cart/update'); ?>
                            <fieldset>
                                <table class="data-table cart-table" id="shopping-cart-table">
                                    <colgroup>
                                        <col width="1">
                                        <col>
                                        <col width="1">
                                        <col width="1">
                                        <col width="1">
                                        <col width="1">
                                        <col width="1">
                                    </colgroup>
                                    <thead>
                                    <tr class="first last">
                                        <th rowspan="1">&nbsp;</th>
                                        <th rowspan="1"><span class="nobr">Tên sản phẩm</span></th>
                                        <th rowspan="1"></th>
                                        <th class="a-center" colspan="1"><span class="nobr">Giá</span></th>
                                        <th class="a-center" rowspan="1">Số lượng</th>
                                        <th class="a-center" colspan="1">Tổng cộng</th>
                                        <th class="a-center" rowspan="1">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr class="first last">
                                        <td class="a-right last" colspan="50">
                                            <button title="Continue Shopping" class="button btn-continue"
                                                    onclick="setLocation('#')"
                                                    type="button"><span>Tiếp tục mua hàng</span></button>
                                            <button name="update_cart_action" title="Update Cart"
                                                    class="button btn-update" type="submit"
                                                    value="update_qty"><span>Cập nhật giỏ hàng</span></button>
                                            <button name="update_cart_action" title="Clear Cart"
                                                    class="button btn-empty"
                                                    id="empty_cart_button" type="submit" value="empty_cart"><span>Xóa giỏ hàng</span>
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $total_weight = 0;
                                    if (!empty($this->cart->contents())) foreach ($this->cart->contents() as $key => $item):
                                        $oneProduct = getProductDetail($item['id']);
                                        $total_weight = !empty($oneProduct->weight) ? $total_weight + $oneProduct->weight : 0;
                                        ?>
                                        <tr class="first odd">
                                            <td class="image">
                                                <a title="Sample Product" class="<?php echo $item['name'] ?>"
                                                   href="<?php echo getUrlProduct(array('slug' => $item['slug'], 'id' => $item['id'])) ?>">
                                                    <img width="75" alt="<?php echo $item['name'] ?>"
                                                         src="<?php echo $item['image'] ?>">
                                                </a>
                                            </td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a
                                                            href="<?php echo getUrlProduct(array('slug' => $item['slug'], 'id' => $item['id'])) ?>"><?php echo $item['name'] ?></a>
                                                </h2>
                                            </td>
                                            <td class="a-center">
                                                <a title="Edit item parameters" class="edit-bnt" href="#"></a>
                                            </td>
                                            <td class="a-right"><span class="cart-price"> <span
                                                            class="price"><?php echo number_format($item['price']) ?>
                                                        đ</span> </span></td>
                                            <td class="a-center movewishlist"><input
                                                        name="cart[<?php echo $key ?>][qty]" title="Qty"
                                                        class="input-text qty" size="4" maxlength="12"
                                                        value="<?php echo $item['qty'] ?>"></td>
                                            <td class="a-right movewishlist"><span class="cart-price"> <span
                                                            class="price"><?php echo number_format($item['subtotal']) ?>
                                                        đ</span> </span></td>
                                            <td class="a-center last"><a title="Remove item" class="button remove-item"
                                                                         href="#"><span><span>Remove item</span></span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </fieldset>
                            </form>
                        </div>
                        <!-- BEGIN CART COLLATERALS -->
                        <form action="<?php echo site_url('cart/check_out') ?>" id="check_out">
                            <div class="cart-collaterals row">
                                <div class="col-sm-4">
                                    <div class="shipping">
                                        <h3>Thông tin khách hàng</h3>
                                        <div class="shipping-form">
                                            <div id="shipping-zip-form">
                                                <ul class="form-list">
                                                    <li>
                                                        <label class="required" for="country"><em>*</em>Họ và
                                                            tên</label>
                                                        <div class="input-box">
                                                            <input name="full_name" class="input-text fullwidth"
                                                                   type="text"
                                                                   value="<?php if (!empty($this->_user_login)) echo $this->_user_login->fullname; ?>">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <label for="region_id" class="required"><em>*</em>Địa
                                                            chỉ</label>
                                                        <div class="input-box">
                                                            <input name="address" class="input-text fullwidth"
                                                                   type="text"
                                                                   value="<?php if (!empty($this->_user_login)) echo $this->_user_login->address; ?>">
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <label class="required" for="country"><em>*</em>Tỉnh/Thành phố</label>
                                                        <div class="input-box">
                                                            <select name="city_id"></select>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <label class="required" for="country"><em>*</em>Quận/huyện</label>
                                                        <div class="input-box">
                                                            <select name="district_id"></select>
                                                        </div>
                                                    </li>


                                                    <li>
                                                        <label for="region_id" class="required"><em>*</em>Email</label>
                                                        <div class="input-box">
                                                            <input name="email" class="input-text fullwidth" type="text"
                                                                   value="<?php if (!empty($this->_user_login)) echo $this->_user_login->email; ?>">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <label for="region_id" class="required"><em>*</em>Số điện thoại</label>
                                                        <div class="input-box">
                                                            <input name="phone" class="input-text fullwidth" type="text"
                                                                   value="<?php if (!empty($this->_user_login)) echo $this->_user_login->phone; ?>">
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!--buttons-set11-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="shipping">
                                        <h3>Thông tin giao hàng</h3>
                                        <div class="bill-shipping-form">
                                            <ul class="form-list">
                                                <input type="hidden" name="total_weight" value="<?php echo $total_weight ?>">
                                                <li>
                                                    <label class="required" for="country"><em>*</em>Nơi lấy hàng</label>
                                                    <div class="input-box">
                                                        <select name="warehouse" class="fullwidth" style="width: 100%;">
                                                            <option value="">Chọn nơi lấy hàng</option>
                                                            <option value="1">Kho hàng Phủ Lý - Hà Nam</option>
                                                            <option value="2">Kho hàng Đê La Thành - Hà Nội</option>
                                                            <option value="3">Kho hàng Nguyễn Trãi - Hà Nội</option>
                                                        </select>
                                                    </div>
                                                </li>

                                                <li>
                                                    <label class="required" for="country"><em>*</em>Địa chỉ viết hóa đơn</label>
                                                    <div class="input-box">
                                                        <input name="bill_address" class="input-text fullwidth"
                                                               type="text" value="">
                                                    </div>
                                                </li>

                                                <li>
                                                    <label for="region_id" class="required">Thời gian nhận hàng</label>
                                                    <div class="input-box">
                                                        <input name="shipped_time" class="input-text fullwidth"
                                                               type="date" value="">
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="region_id" class="required">Nội dung</label>
                                                    <div class="input-box">
                                                        <textarea name="note" class="input-text fullwidth"
                                                                  rows="8"></textarea>
                                                    </div>
                                                </li>
                                            </ul>
                                            <!--buttons-set11-->
                                        </div>
                                    </div>
                                </div>

                                <div class="totals col-sm-4">
                                    <h3>Tổng đơn hàng</h3>
                                    <div class="inner">
                                        <div class="payment-box">
                                            <div class="payment-collapse">
                                                <div class="item">
                                                    <div class="head">
                                                        <div class="ct-head">
                                                            <p>C.O.D - Thanh toán khi nhận hàng</p>
                                                        </div>
                                                    </div>
                                                    <div class="ct" style="display: none;">
                                                        <div class="ct-info">
                                                            Sau khi nhận hàng xong, quý khách hàng thanh toán tiền cho
                                                            nhân viên vận chuyển của chúng
                                                            tôi. Chỉ áp dụng cho khu vực giao hàng trong quy định về vận
                                                            chuyển của chúng tôi.
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="discount">
                                            <div id="discount-coupon-form">
                                                <label for="coupon_code">Nhập mã phiếu giảm giá của bạn nếu bạn
                                                    có.</label>
                                                <input name="code" class="input-text fullwidth" id="coupon_code"
                                                       type="text" value="">
                                                <button title="Apply Coupon" class="button coupon "
                                                        onclick="CART.coupon_code()" type="button"
                                                        value="Apply Coupon"><span>Áp dụng</span></button>
                                                <div class="mess_coupon"></div>

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                                            <colgroup>
                                                <col>
                                                <col width="1">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td class="a-left" colspan="1"> Tổng cộng</td>
                                                    <td class="a-right"><span
                                                                class="price"><?php echo formatMoney($this->cart->total()) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="a-left" colspan="1"> Phí vận chuyển</td>
                                                    <td class="a-right"><span data-total="<?php echo $this->cart->total() ?>" class="price fee_ship">0đ</span></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td class="a-left" colspan="1"><strong>Tổng tiền</strong></td>
                                                <td class="a-right"><strong><span
                                                                class="price_sale"><?php echo formatMoney($this->cart->total()) ?></span></strong>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="voucher_id">
                                        <ul class="checkout">
                                            <li>
                                                <button title="Thanh toán" class="button btn-proceed-checkout"
                                                        type="button" onclick="CART.check_out()">
                                                    <span>Thanh toán</span></button>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--inner-->
                                </div>
                            </div>
                        </form>

                        <!--cart-collaterals-->

                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>

        </div>
    </div>
</section>
<!-- Main Container End -->

