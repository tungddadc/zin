<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:40 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
		<div class="col-md-9 col-sm-8 col-xs-12">
			<div class="home-slider">
				<?php $home_slider = listBannerByPosition(1);
				if (!empty($home_slider)): ?>

					<div id="sync1" class="owl-carousel">
						<?php foreach ($home_slider as $item) : ?>
							<div class="item">
								<a title="<?php echo getTitle($item) ?>" href="<?php echo $item->url ?>">
									<img src="<?php echo getImageThumb($item->thumbnail, 1920, 630, true) ?>"
										 alt="<?php echo getTitle($item) ?>">
								</a>
							</div>
						<?php endforeach; ?>

					</div>
				<?php endif; ?>

				<?php
				if (!empty($home_slider)): ?>
					<div id="sync2" class="owl-carousel">
						<?php foreach ($home_slider as $item) : ?>
							<div class="item">
								<a title="<?php echo getTitle($item) ?>"
								   href="<?php echo $item->url ?>"><?php echo $item->description ?></a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
		<div class="col-md-3 col-sm-4 hidden-xs padding-0">
			<div class="side-banner">
				<aside class="homenews">
					<figure>
						<h2><a href="<?php echo site_url('tin-tuc.html') ?>">Tin công nghệ</a>

						</h2>
						<div class="_circle">
							<div class="circle circle1"></div>
							<div class="circle circle2"></div>
							<div class="circle circle3"></div>
						</div>
					</figure>
					<ul>
						<li>
							<?php
							if (!empty($home_news)) {
								?>
								<a href="<?php getUrlNews($home_news[0]) ?>">
									<img width="100" height="70"
										 src="<?php echo getImageThumb($home_news[0]->thumbnail, 100, 70, true); ?>"
										 alt="<?php echo $home_news[0]->title ?>">
									<h3><?php echo $home_news[0]->title ?></h3>
									<span><?php echo timeAgo($home_news[0]->created_time) ?></span>
								</a>
								<?php
							}
							?>

						</li>
					</ul>
					<div class="twobanner">
						<?php $bannerSidebarTop = listBannerByPosition(2, 2);
						if (!empty($bannerSidebarTop)) foreach ($bannerSidebarTop as $item): ?>
							<a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
								<img src="<?php echo getImageThumb($item->thumbnail, 398, 110, true) ?>"
									 data-src="<?php echo getImageThumb($item->thumbnail, 398, 110, true) ?>"
									 class="lazy" alt="<?php echo getTitle($item) ?>">
							</a>
						<?php endforeach; ?>
					</div>

				</aside>
			</div>
		</div>
    </div>
</div>

<section class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                
                <?php if (!empty($home_product['listCategory'])) foreach ($home_product['listCategory'] as $oneCategory): ?>
                    <div class="content-page">
                        <div class="category-product">
                            <div class="navbar nav-menu">
                                <div class="navbar-collapse">
                                    <div class="new_title">
                                        <h2 class="nav-category-title">
                                            <a href="<?php echo getUrlCateProduct($oneCategory) ?>" title="<?php echo getTitle($oneCategory) ?>"><?php echo $oneCategory->title ?></a>
                                        </h2>
                                        <div class="view-list-child">
                                            <?php
                                            $listCategory = $home_product['listCategoryChild'][$oneCategory->id];
                                            $listCategory = array_slice($listCategory, 0, 5);
                                            if (!empty($listCategory)) foreach ($listCategory as $itemChild): ?>
                                                <a href="<?php echo getUrlCateProduct($itemChild) ?>"
                                                   title="<?php echo getTitle($itemChild) ?>"><?php echo $itemChild->title ?></a>
                                            <?php endforeach; ?>
                                            <span class="list-all"><i class="fa fa-angle-double-right"
                                                                      aria-hidden="true"></i><a
                                                        href="<?php echo getUrlCateProduct($oneCategory) ?>"
                                                        title="Xem tất cả sản phẩm trong <?php echo getTitle($oneCategory) ?>">Xem tất cả</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-bestseller">
                                <div class="product-bestseller-content">
                                    <div class="product-bestseller-list">
                                        <div class="category-products">
                                            <?php $this->load->view($this->template_path . 'product/_list_product', ['data' => $home_product['listProduct'][$oneCategory->id]]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="offer-banner">
                    <?php $bannerCenterHome = listBannerByPosition(5);if(!empty($bannerCenterHome)) foreach ($bannerCenterHome as $item): ?>
                        <a href="<?php echo $item->url ?>" title="banner center home" rel="nofollow">
                            <img src="<?php echo getImageThumb($item->thumbnail,410,210,false,false) ?>" alt="banner center home">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                <?php $listFeedback = getFeedback();
                if(!empty($listFeedback)): ?>
                <div class="testimonials">
                    <div class="ts-testimonial-widget">
                        <div class="slider-items-products">
                            <div id="testimonials-slider" class="product-flexslider hidden-buttons home-testimonials">
                                <div class="slider-items slider-width-col4 fadeInUp owl-carousel owl-theme">
                                    <?php  foreach ($listFeedback as $item): ?>
                                        <div class="holder">
                                            <p><?php echo $item->content ?></p>
                                            <div class="testimonial-arrow-down"></div>
                                            <div class="thumb">
                                                <div class="customer-img">
                                                    <img src="<?php echo getImageThumb($item->thumbnail) ?>" alt="<?php echo $item->name ?>">
                                                </div>
                                                <div class="customer-bio">
                                                    <strong class="name">
                                                        <a href="javascript:;" title="<?php echo $item->name ?>"><?php echo $item->name ?></a>
                                                    </strong>
                                                    <span><strong><?php echo $item->company ?></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="side-banner">
                    <?php $bannerSidebar = listBannerByPosition(3);if(!empty($bannerSidebar)) foreach ($bannerSidebar as $item): ?>
                        <a href="<?php echo $item->url ?>" title="banner center home" rel="nofollow">
                            <img src="<?php echo getImageThumb($item->thumbnail,265,500,true) ?>"
                                 data-src="<?php echo getImageThumb($item->thumbnail,265,500,true) ?>"
                                 class="lazy hidden-xs"
                                 alt="<?php echo getTitle($item) ?>">
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="">
                    <?php $this->load->view($this->template_path . 'product/_box_features') ?>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Latest Blog -->
<div class="container">
    <div class="row">
        <div class="blog-outer-container">
            <div class="block-title">
                <h2>Tin mới nhất</h2>
            </div>
            <div class="blog-inner">
                <?php if (!empty($home_news)) foreach ($home_news as $item): ?>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="entry-thumb image-hover2">
                            <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>">
                                <img alt="<?php echo getTitle($item) ?>"
                                     src="<?php echo getImageThumb($item->thumbnail, 340, 160, true, false) ?>">
                            </a>
                        </div>
                        <div class="blog-preview_info">
                            <h4 class="blog-preview_title">
                                <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
                            </h4>
                            <ul class="post-meta">
                                <li><i class="fa fa-eye"></i><?php echo $item->viewed ?></li>
                                <li><i class="fa fa-clock-o"></i><?php echo timeAgo($item->created_time, 'd/m/Y') ?>
                                </li>
                            </ul>
                            <div class="blog-preview_desc">
                                <?php echo $item->description ?>
                            </div>
                            <a class="blog-preview_btn" href="<?php echo getUrlNews($item) ?>"
                               title="<?php echo getTitle($item) ?>">Xem thêm</a></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- End Latest Blog -->
