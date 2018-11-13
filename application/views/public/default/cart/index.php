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
                            <h2>Shopping Cart</h2>
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
                                            <td class="a-right last" colspan="50"><button title="Continue Shopping" class="button btn-continue" onclick="setLocation('#')" type="button"><span>Continue Shopping</span></button>
                                                <button name="update_cart_action" title="Update Cart" class="button btn-update" type="submit" value="update_qty"><span>Update Cart</span></button>
                                                <button name="update_cart_action" title="Clear Cart" class="button btn-empty" id="empty_cart_button" type="submit" value="empty_cart"><span>Clear Cart</span></button></td>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            if(!empty($this->cart->contents())) foreach ($this->cart->contents() as $key => $item):
                                        ?>
                                        <tr class="first odd">
                                            <td class="image">
                                                <a title="Sample Product" class="<?php echo $item['name'] ?>" href="<?php echo getUrlProduct(array('slug'=>$item['slug'],'id'=>$item['id'])) ?>">
                                                    <img width="75" alt="Sample Product" src="<?php echo getImageThumb($item['image'],75,80,true) ?>">
                                                </a>
                                            </td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="<?php echo getUrlProduct(array('slug'=>$item['slug'],'id'=>$item['id'])) ?>"><?php echo $item['name'] ?></a>
                                                </h2>
                                            </td>
                                            <td class="a-center">
                                                <a title="Edit item parameters" class="edit-bnt" href="#"></a>
                                            </td>
                                            <td class="a-right"><span class="cart-price"> <span class="price"><?php echo number_format($item['price']) ?> đ</span> </span></td>
                                            <td class="a-center movewishlist"><input name="cart[<?php echo $key ?>][qty]" title="Qty" class="input-text qty" size="4" maxlength="12" value="<?php echo $item['qty'] ?>"></td>
                                            <td class="a-right movewishlist"><span class="cart-price"> <span class="price"><?php echo number_format($item['subtotal']) ?> đ</span> </span></td>
                                            <td class="a-center last"><a title="Remove item" class="button remove-item" href="#"><span><span>Remove item</span></span></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </form>
                        </div>
                        <!-- BEGIN CART COLLATERALS -->
                        <div class="cart-collaterals row">
                            <div class="col-sm-4">
                                <div class="shipping">
                                    <h3>Thông tin khách hàng</h3>
                                    <div class="shipping-form">
                                        <form id="shipping-zip-form" action="#estimatePost/" method="post">
                                            <p>Vui lòng nhập địa chỉ chính xác để chúng tôi giao hàng sớm nhất cho bạn.</p>
                                            <ul class="form-list">
                                                <li>
                                                    <label class="required" for="country"><em>*</em>Họ và tên</label>
                                                    <div class="input-box">
                                                        <input name="full_name" class="input-text fullwidth"  type="text" value="<?php if(!empty($this->_user_login)) echo $this->_user_login->fullname; ?>">
                                                    </div>
                                                </li>
                                                <li>
                                                    <label class="required" for="country"><em>*</em>Thành phố</label>
                                                    <div class="input-box">
                                                        <select name="city_id" ></select>
                                                    </div>
                                                </li><li>
                                                    <label class="required" for="country"><em>*</em>Quận huyện</label>
                                                    <div class="input-box">
                                                        <select name="district_id" ></select>
                                                    </div>
                                                </li>

                                                <li>
                                                    <label for="region_id" class="required"><em>*</em>Địa chỉ</label>
                                                    <div class="input-box">
                                                        <input name="address" class="input-text fullwidth"  type="text" value="<?php if(!empty($this->_user_login)) echo $this->_user_login->address; ?>">
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="region_id" class="required"><em>*</em>Số điện thoại</label>
                                                    <div class="input-box">
                                                        <input name="phone" class="input-text fullwidth"  type="text" value="<?php if(!empty($this->_user_login)) echo $this->_user_login->phone; ?>">
                                                    </div>
                                                </li>
                                            </ul>
                                            <!--buttons-set11-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="discount">
                                    <h3>Mã giảm giá</h3>
                                    <form id="discount-coupon-form" action="#couponPost/" method="post">
                                        <label for="coupon_code">Enter your coupon code if you have one.</label>
                                        <input name="remove" id="remove-coupone" type="hidden" value="0">
                                        <input name="coupon_code" class="input-text fullwidth" id="coupon_code" type="text" value="">
                                        <button title="Apply Coupon" class="button coupon " onclick="discountForm.submit(false)" type="button" value="Apply Coupon"><span>Apply Coupon</span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="totals col-sm-4">
                                <h3>Shopping Cart Total</h3>
                                <div class="inner">
                                    <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                                        <colgroup>
                                            <col>
                                            <col width="1">
                                        </colgroup>
                                        <tfoot>
                                        <tr>
                                            <td class="a-left" colspan="1"><strong>Grand Total</strong></td>
                                            <td class="a-right"><strong><span class="price">$77.38</span></strong></td>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <tr>
                                            <td class="a-left" colspan="1"> Subtotal </td>
                                            <td class="a-right"><span class="price">$77.38</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <ul class="checkout">
                                        <li>
                                            <button title="Proceed to Checkout" class="button btn-proceed-checkout" type="button"><span>Proceed to Checkout</span></button>
                                        </li>
                                        <br>
                                        <li><a title="Checkout with Multiple Addresses" href="multiple_addresses.html">Checkout with Multiple Addresses</a> </li>
                                        <br>
                                    </ul>
                                </div>
                                <!--inner-->

                            </div>
                        </div>

                        <!--cart-collaterals-->
                        <div class="crosssel">
                            <div class="new_title">
                                <h2>you may be interested</h2>
                            </div>
                            <div class="category-products">
                                <ul class="products-grid">
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product10.jpg"> </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"> <span class="regular-price"> <span class="price">$155.00</span> </span> </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product1.jpg"> </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"> <span class="regular-price"> <span class="price">$225.00</span> </span> </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product2.jpg"> </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"> <span class="regular-price"> <span class="price">$99.00</span> </span> </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product3.jpg"> </a>
                                                    <div class="new-label new-top-left">new</div>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box">
                                                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $156.00 </span> </p>
                                                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $167.00 </span> </p>
                                                            </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>

        </div>
    </div>
</section>
<!-- Main Container End -->

