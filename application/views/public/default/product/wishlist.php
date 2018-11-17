<section id="page-wishlist" class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>Sản phẩm yêu thích của tôi</h2>
                        </div>
                        <div class="my-wishlist">
                            <div class="table-responsive">
                                <?php if($this->session->userdata('is_logged') == true): ?>
                                <fieldset>
                                    <table id="wishlist-table" class="clean-table linearize-table data-table">
                                        <thead>
                                        <tr class="first last">
                                            <th class="customer-wishlist-item-image"></th>
                                            <th class="customer-wishlist-item-info"></th>
                                            <th class="customer-wishlist-item-quantity">Số lượng</th>
                                            <th class="customer-wishlist-item-price">Giá tiền</th>
                                            <th class="customer-wishlist-item-cart"></th>
                                            <th class="customer-wishlist-item-remove"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($data)) foreach ($data as $k => $item): ?>
                                            <tr data-id="<?php echo $item->id ?>" class="<?php echo $k == 0 ? 'first odd' : '' ?> <?php echo ($k == count($data) - 1) ? 'last' : '' ?> <?php echo ($k%2 == 0 && $k != 0) ? 'odd' : 'even' ?>">
                                                <td class="wishlist-cell0 customer-wishlist-item-image">
                                                    <a title="<?php echo getTitle($item) ?>" href="<?php echo getUrlProduct($item) ?>" class="product-image">
                                                        <img width="150" alt="<?php echo getTitle($item) ?>" src="<?php echo getImageThumb($item->thumbnail,150,150,true) ?>">
                                                    </a>
                                                </td>
                                                <td class="wishlist-cell1 customer-wishlist-item-info">
                                                    <h3 class="product-name"><a title="<?php echo getTitle($item) ?>" href="<?php echo getUrlProduct($item) ?>"><?php echo getTitle($item) ?></a></h3>
                                                    <div class="description std">
                                                        <div class="inner"><?php echo $item->description ?></div>
                                                    </div>
                                                <td data-rwd-label="Quantity" class="wishlist-cell2 customer-wishlist-item-quantity">
                                                    <div class="cart-cell">
                                                        <div class="add-to-cart-alt">
                                                            <input type="text" value="1" name="qty[]" class="input-text qty validate-not-negative-number" pattern="\d*">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-rwd-label="Price" class="wishlist-cell3 customer-wishlist-item-price">
                                                    <div class="cart-cell">
                                                        <div class="price-box" style="margin-bottom: 0">
                                                            <?php $data_detail = getProductDetail($item->id); ?>
                                                            <?php if($this->session->userdata('is_agency') == true && !empty($data_detail)): ?>
                                                                <span class="regular-price"> <span class="price"><?php echo formatMoney($data_detail[0]->price_agency) ?></span> </span>
                                                            <?php else: ?>
                                                                <?php if(!empty($item->price_sale)): ?>
                                                                    <span class="regular-price"> <span class="price"><?php echo formatMoney($item->price_sale) ?></span> <small><?php echo formatMoney($item->price) ?></small> </span>
                                                                <?php else: ?>
                                                                    <span class="regular-price"> <span class="price"><?php echo formatMoney($item->price) ?></span> </span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="wishlist-cell4 customer-wishlist-item-cart">
                                                    <div class="cart-cell">
                                                        <button class="button btn-cart" title="Thêm sản phẩm này vào giỏ hàng" type="button"><span><span>Thêm vào giỏ hàng</span></span></button>
                                                    </div>
                                                </td>
                                                <td class="wishlist-cell5 customer-wishlist-item-remove last">
                                                    <a class="remove-item" title="Xóa sản phẩm này khỏi yêu thích" href="javascript:;"><span><span></span></span></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="buttons-set buttons-set2">
                                        <button class="button btn-primary btn-add-all-to-cart pull-right" title="Thêm tất cả vào giỏ hàng" type="button"><span>Thêm toàn bộ vào giỏ hàng</span></button>
                                        <button class="button btn-danger btn-delete-all pull-left" title="Xóa toàn bộ sản phẩm khỏi yêu thích của tôi" type="button"><span>Xóa toàn bộ yêu thích</span></button>
                                    </div>
                                </fieldset>
                                <?php else: ?>
                                    <div class="text-center" style="margin-top: 15px">Bạn phải đăng nhập để được xem yêu thích của bạn! </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <?php $this->load->view($this->template_path.'auth/profile/sidebar'); ?>

        </div>
    </div>
</section>