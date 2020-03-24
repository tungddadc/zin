<?php if(!empty($data)) foreach ($data as $item): ?>
	<li class="item col-lg-4 col-md-6 col-xs-12">
		<div class="item-inner">
			<div class="item-img">
				<div class="item-img-info">
					<a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>" class="product-image">
						<img src="<?php echo getImageThumb($item->thumbnail,768,482,true,true) ?>"
							 data-src="<?php echo getImageThumb($item->thumbnail,768,482,true,true) ?>"
							 class="lazy"
							 alt="<?php echo getTitle($item) ?>">
					</a>
					<!--                        --><?php //echo !empty($item->is_new) ? '<div class="new-label new-top-left">New</div>' : '<div class="new-label new-top-left">Đã bán: '.($item->viewed - 555).'</div>' ?>
					<?php echo !empty($item->is_sale) && !empty($item->price) ? '<div class="hot-label hot-top-left">-'.round((($item->price - $item->price_sale)/$item->price)*100).'%</div>' : '' ?>
				</div>

			</div>
			<div class="item-info">
				<div class="info-inner">
					<div class="item-title">
						<a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
					</div>
					<div class="item-content">
						<div class="box-hover">
							<ul class="add-to-links">
								<li>
									<a class="link-quickview" data-url="<?php echo getUrlProduct($item) ?>" href="javascript:;" rel="nofollow" title="Xem Quickview">
										<i class="fa fa-search" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a class="link-wishlist" data-id="<?php echo $item->id ?>" href="javascript:;" rel="nofollow" title="Yêu thích sản phẩm này">
										<i class="fa fa-heart" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a class="link-compare" data-id="<?php echo $item->id ?>" href="javascript:;" rel="nofollow" title="So sánh sản phẩm này">
										<i class="fa fa-balance-scale" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a class=link-add-to-cart href="javascript:;" onclick="CART.add(<?php echo $item->id ?>,1)" title="Thêm vào giỏ hàng">
										<i class="fa fa-cart-plus" aria-hidden="true"></i>
									</a>
								</li>
							</ul>
						</div>
						<div class="item-price">
							<div class="price-box">
								<?php if(!empty($item->price_sale)): ?>
									<p class="old-price"><span class="price-label">Giá gốc:</span> <span class="price"><?php echo formatMoney($item->price) ?> </span> </p>
									<p class="special-price"><span class="price-label">Giá khuyến mại</span> <span class="price"><?php echo formatMoney($item->price_sale) ?></span> </p>
								<?php else: ?>
									<p class="special-price"><span class="price-label">Giá</span> <span class="price"><?php echo formatMoney($item->price) ?></span> </p>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</li>
<?php endforeach;else echo "<div class='text-center'>Nội dung đang được cập nhật !</div>" ?>
