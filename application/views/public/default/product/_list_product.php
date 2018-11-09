<ul class="products-grid">
    <?php if(!empty($data)) foreach ($data as $item): ?>
        <li class="item col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="item-inner">
                <div class="item-img">
                    <div class="item-img-info">
                        <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>" class="product-image">
                            <img src="<?php echo getImageThumb($item->thumbnail,178,216) ?>" alt="<?php echo getTitle($item) ?>">
                        </a>
                        <?php echo !empty($item->is_new) ? '<div class="new-label new-top-left">New</div>' : '' ?>
                        <div class="box-hover">
                            <ul class="add-to-links">
                                <li><a class="link-quickview" href="javascript:;" rel="nofollow" title="Xem Quickview"></a> </li>
                                <li><a class="link-wishlist" href="javascript:;" rel="nofollow" title="Yêu thích sản phẩm này"></a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="item-info">
                    <div class="info-inner">
                        <div class="item-title">
                            <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
                        </div>
                        <div class="item-content">
                            <div class="rating">
                                <div class="ratings">
                                    <div class="rating-box">
                                        <div style="width:80%" class="rating"></div>
                                    </div>
                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                </div>
                            </div>
                            <div class="item-price">
                                <div class="price-box">
                                    <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price">$100.00 </span> </p>
                                    <p class="special-price"><span class="price-label">Special Price</span> <span class="price">$90.00 </span> </p>
                                </div>
                            </div>
                            <div class="action">
                                <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>