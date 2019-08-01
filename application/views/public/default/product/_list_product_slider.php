<?php if (!empty($data)) foreach ($data as $item): ?>
    <div class="item">
        <div class="item-inner">
            <div class="item-img">
                <div class="item-img-info">
                    <a href="<?php echo getUrlProduct($item) ?>"
                       title="<?php echo getTitle($item) ?>"
                       class="product-image">
                        <img src="<?php echo getImageThumb($item->thumbnail,250,300,true,true) ?>"
                             data-src="<?php echo getImageThumb($item->thumbnail,250,300,true,true) ?>"
                             data-srcset="<?php echo getImageThumb($item->thumbnail,250,300,true,true) ?> 1x, <?php echo getImageThumb($item->thumbnail,250,300,true,true) ?> 2x"
                             class="lazy"
                             alt="<?php echo getTitle($item) ?>">
                    </a>
                    <?php echo !empty($item->is_new) ? '<div class="new-label new-top-left">New</div>' : '<div class="new-label new-top-left">Đã bán: '.($item->viewed - 555).'</div>' ?>
                    <?php echo !empty($item->is_sale) && !empty($item->price) ? '<div class="hot-label hot-top-left">-'.round((($item->price - $item->price_sale)/$item->price)*100).'%</div>' : '' ?>
                    <div class="box-hover">
                        <ul class="add-to-links">
                            <li><a class="link-quickview" data-url="<?php echo getUrlProduct($item) ?>" href="javascript:;" rel="nofollow" title="Xem Quickview"></a> </li>
                            <li><a class="link-wishlist" data-id="<?php echo $item->id ?>" href="javascript:;" rel="nofollow" title="Yêu thích sản phẩm này"></a> </li>
                            <li><a class="link-compare" data-id="<?php echo $item->id ?>" href="javascript:;" rel="nofollow" title="So sánh sản phẩm này"></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="item-info">
                <div class="info-inner">
                    <div class="item-title">
                        <a href="<?php echo getUrlProduct($item) ?>"
                           title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
                    </div>
                    <div class="item-content">
                        <div class="rating">
                            <div class="ratings">
                                <div class="rating-box">
                                    <div style="width:<?php echo round(($item->vote/5)*100) ?>%" class="rating"></div>
                                </div>
                                <p class="rating-links"> <a href="<?php echo getUrlProduct($item).'#tab_reviews' ?>"><?php echo $item->total_vote ?> đánh giá</a></p>
                            </div>
                        </div>
                        <div class="item-price">
                            <div class="price-slider owl-carousel">
                                
                                <?php if(!empty($item->price)): ?>
                                <div class="price-item">
                                    <div class="name">GIÁ LẺ CỬA HÀNG</div>
                                    <div class="price">
                                        <span class="value"><?php echo !empty($item->price) ? formatMoney($item->price) : "" ?></span>
                                    </div>                                        
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item->price_sale)): ?>
                                <div class="price-item">
                                    <div class="name">GIÁ BUÔN CỬA HÀNG</div>
                                    <div class="price">
                                        <span class="value"><?php echo !empty($item->price_sale) ? formatMoney($item->price_sale) : "" ?></span>
                                    </div>                                        
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item->price_kl)): ?>
                                <div class="price-item">
                                    <div class="name">GIÁ THAY KHÁCH LẺ</div>
                                    <div class="price">
                                        <span class="value"><?php echo !empty($item->price_kl) ? formatMoney($item->price_kl) : "" ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item->price_ek)): ?>
                                <div class="price-item">
                                    <div class="name">GIÁ THAY KHÁCH VIP</div>
                                    <div class="price">
                                        <span class="value"><?php echo !empty($item->price_ek) ? formatMoney($item->price_ek) : "" ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="action">
                            <a href="javascript:;" onclick="CART.add(<?php echo $item->id ?>,1)" class="button" title="Thêm vào giỏ hàng"><span>Thêm vào giỏ hàng</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;else echo "<div class='text-center'>Nội dung đang được cập nhật !</div>" ?>