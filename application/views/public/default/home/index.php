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
        <div class="col-md-6 col-xs-12 home-slider">
            <?php $home_slider = listBannerByPosition(1); ?>
            <?php if(!empty($home_slider)): ?>
            <div id="thm-slideshow" class="thm-slideshow slider-block">
                <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
                    <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
                        <ul>
                            <?php foreach ($home_slider as $item): ?>
                            <li data-transition='random' data-slotamount='7' data-masterspeed='1000'
                                data-thumb='<?php echo getImageThumb($item->thumbnail,710,330,true) ?>'>
                                <img src="<?php echo getImageThumb($item->thumbnail,710,330,true) ?>"
                                     data-src="<?php echo getImageThumb($item->thumbnail,710,330,true) ?>"
                                     class="lazy"
                                     data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat'
                                     alt="<?php echo getTitle($item) ?>">
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if($this->mobile_detect->is_mobile() == false): ?>
            <div class="col-md-6 col-xs-12 mini-promotion">
                <div class="mini-banner-wrap">
                    <?php $bannerRightSlider = listBannerByPosition(6);if(!empty($bannerRightSlider)) foreach ($bannerRightSlider as $item): ?>
                        <div class="mini-item">
                            <a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
                                <img src="<?php echo getImageThumb($item->thumbnail,190,165,true) ?>"
                                     data-src="<?php echo getImageThumb($item->thumbnail,190,165,true) ?>"
                                     class="lazy"
                                     style="width: 100%"
                                     alt="<?php echo getTitle($item) ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if($this->mobile_detect->is_mobile() == false): ?>
        <div class="row list-banner-bottom">
            <?php $bannerHomeTop = listBannerByPosition(4);if(!empty($bannerHomeTop)) foreach ($bannerHomeTop as $item): ?>
                <div class="col-sm-3 col-xs-12">
                    <a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
                        <img src="<?php echo getImageThumb($item->thumbnail,285,150,true) ?>"
                             data-src="<?php echo getImageThumb($item->thumbnail,285,150,true) ?>"
                             class="lazy"
                             style="width: 100%"
                             alt="<?php echo getTitle($item) ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<section class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php if(!empty($home_product['listCategory'])) foreach ($home_product['listCategory'] as $oneCategory): ?>
                    <div class="content-page">
                        <div class="category-product">
                            <div class="navbar nav-menu">
                                <div class="navbar-collapse">
                                    <div class="nav-category">
                                        <a href="<?php echo getUrlCateProduct($oneCategory) ?>" title="<?php echo getTitle($oneCategory) ?>"><h2><?php echo $oneCategory->title ?></h2></a>

                                        <div class="view-list-child">
                                            <?php
                                            $listCategory = $home_product['listCategoryChild'][$oneCategory->id];
                                            $listCategory = array_slice($listCategory, 0, 5);
                                            if(!empty($listCategory)) foreach ($listCategory as $itemChild): ?>
                                                <a href="<?php echo getUrlCateProduct($itemChild) ?>" title="<?php echo getTitle($itemChild) ?>"><?php echo $itemChild->title ?></a>
                                            <?php endforeach; ?>
                                            <span class="list-all"><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="<?php echo getUrlCateProduct($oneCategory) ?>" title="Xem tất cả sản phẩm trong <?php echo getTitle($oneCategory) ?>">Xem tất cả</a></span>
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
            </div>
        </div>
    </div>
</section>

<!-- Latest Blog -->
<div class="container">
    <div class="row">
        <div class="blog-outer-container slider-keyword">
            <div class="block-title">
                <h2>TỪ KHÓA HOT</h2>
            </div>
            <div class="blog-inner owl-carousel owl-theme">
                <?php $listKeyword = navHotKeyword();
                if(!empty($listKeyword)) foreach ($listKeyword as $item): $item = (object) $item; ?>
                    <div class="item">
                        <a style="background: rgb(<?php echo rand(000,255) ?>, <?php echo rand(000,255) ?>, <?php echo rand(000,255) ?>);" target="_blank" href="<?php echo site_url('search/'.$item->title) ?>" title="<?php echo $item->title ?>" class="btn">
                            <span><?php echo $item->title ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

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