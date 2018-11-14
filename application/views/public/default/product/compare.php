<section id="page-compare" class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>So sánh sản phẩm</h2>
                        </div>
                        <div class="my-wishlist">
                            <div class="table-responsive">
                                <fieldset>
                                    <table id="wishlist-table" class="clean-table linearize-table data-table">
                                        <thead>
                                        <tr class="first last">
                                            <th class="customer-wishlist-item-image"></th>
                                            <th class="customer-wishlist-item-info"></th>
                                            <th class="customer-wishlist-item-quantity">Đặc tính</th>
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
                                                    <?php echo $item->description ?>
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
                                                    <a class="remove-item" title="Xóa sản phẩm này" href="javascript:;"><span><span></span></span></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="buttons-set buttons-set2">
                                        <button class="button btn-primary btn-add-all-to-cart pull-right" title="Thêm tất cả vào giỏ hàng" type="button"><span>Thêm toàn bộ vào giỏ hàng</span></button>
                                        <button class="button btn-danger btn-delete-all pull-left" title="Xóa toàn bộ sản phẩm" type="button"><span>Xóa toàn bộ</span></button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                <div class="side-banner"><img src="<?php echo $this->templates_assets ?>images/side-banner.jpg" alt="banner"></div>
                <div class="block block-account">
                    <div class="block-title">Tài khoản của tôi</div>
                    <div class="block-content">
                        <ul>
                            <li><a href="#">Account Dashboard</a></li>
                            <li><a href="#">Account Information</a></li>
                            <li><a href="#">Address Book</a></li>
                            <li><a href="#">My Orders</a></li>
                            <li><a href="#">Billing Agreements</a></li>
                            <li><a href="#">Recurring Profiles</a></li>
                            <li><a href="#">My Product Reviews</a></li>
                            <li><a href="#">My Tags</a></li>
                            <li class="current"><a href="#">My Wishlist</a></li>
                            </li>
                            <li><a href="#">My Downloadable</a></li>
                            <li class="last"><a href="#">Newsletter Subscriptions</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>