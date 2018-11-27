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
        <div class="col-md-3 col-md-4 col-sm-3 hidden-xs">
            <div class="side-banner">
                <?php $bannerSidebarTop = listBannerByPosition(2);if(!empty($bannerSidebarTop)) foreach ($bannerSidebarTop as $item): ?>
                    <a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
                        <img src="<?php echo getImageThumb($item->thumbnail,265,425) ?>" alt="banner sidebar">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12 home-slider">
            <?php $home_slider = listBannerByPosition(1); ?>
            <?php if(!empty($home_slider)): ?>
            <div id="thm-slideshow" class="thm-slideshow slider-block">
                <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
                    <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
                        <ul>
                            <?php foreach ($home_slider as $item): ?>
                            <li data-transition='random' data-slotamount='7' data-masterspeed='1000'
                                data-thumb='<?php echo getImageThumb($item->thumbnail,850,440) ?>'>
                                <img src='<?php echo getImageThumb($item->thumbnail,850,440) ?>' alt="<?php echo $item->title ?>"
                                        data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat'/>
                                <div class="info">
                                    <!--<div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-endspeed='500'
                                         data-speed='500' data-start='1100' data-easing='Linear.easeNone'
                                         data-splitin='none' data-splitout='none' data-elementdelay='0.1'
                                         data-endelementdelay='0.1'><span><?php /*echo $item->title */?></span>
                                    </div>
                                    <div class='tp-caption Title sft  tp-resizeme ' data-endspeed='500' data-speed='500'
                                         data-start='1450' data-easing='Power2.easeInOut' data-splitin='none'
                                         data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'>
                                        <?php /*echo $item->description */?>
                                    </div>-->
                                    <div class='tp-caption sfb  tp-resizeme ' data-endspeed='500' data-speed='500'
                                         data-start='1500' data-easing='Linear.easeNone' data-splitin='none'
                                         data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'>
                                        <a href='<?php echo $item->url ?>' rel="nofollow" title="Xem chi tiết" class="buy-btn">Xem chi tiết</a></div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<section class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <div class="row">
                    <?php $bannerHomeTop = listBannerByPosition(4);if(!empty($bannerHomeTop)) foreach ($bannerHomeTop as $item): ?>
                        <div class="col-sm-6 col-xs-12">
                            <a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
                                <img style="width: 100%" src="<?php echo getImageThumb($item->thumbnail,410,210) ?>" alt="banner sidebar">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="content-page">
                    <div class="category-product">
                        <div class="navbar nav-menu">
                            <div class="navbar-collapse">
                                <div class="new_title">
                                    <h2>Sản phẩm mới nhất</h2>
                                </div>
                            </div>
                        </div>
                        <div class="product-bestseller">
                            <div class="product-bestseller-content">
                                <div class="product-bestseller-list">
                                    <div class="category-products">
                                        <?php $this->load->view($this->template_path . 'product/_list_product', ['data' => !empty($home_product_latest) ? $home_product_latest : '']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="offer-banner">
                    <?php $bannerCenterHome = listBannerByPosition(5);if(!empty($bannerCenterHome)) foreach ($bannerCenterHome as $item): ?>
                        <a href="<?php echo $item->url ?>" title="banner center home" rel="nofollow">
                            <img src="<?php echo getImageThumb($item->thumbnail,410,210) ?>" alt="banner center home">
                        </a>
                    <?php endforeach; ?>
                </div>
                <!-- bestsell slider -->
                <div class="bestsell-pro">
                    <div>
                        <div class="slider-items-products">
                            <div class="bestsell-block">
                                <div class="block-title">
                                    <h2>Sản phẩm bán chạy</h2>
                                </div>
                                <div id="bestsell-slider" class="product-flexslider hidden-buttons">
                                    <div class="slider-items slider-width-col4 products-grid block-content">
                                        <?php $this->load->view($this->template_path . 'product/_list_product_slider', ['data' => !empty($home_product_sale) ? $home_product_sale : '']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="featured-pro-block">
                    <div class="slider-items-products">
                        <div class="new-arrivals-block">
                            <div class="block-title">
                                <h2>Sản phẩm nổi bật</h2>
                            </div>
                            <div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
                                <div class="home-block-inner"></div>
                                <div class="slider-items slider-width-col4 products-grid block-content">
                                    <?php $this->load->view($this->template_path . 'product/_list_product_slider', ['data' => !empty($home_product_featured) ? $home_product_featured : '']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="featured-add-box">
                    <?php $bannerSidebar = listBannerByPosition(3);if(!empty($bannerSidebar)) foreach ($bannerSidebar as $item): ?>
                        <a href="<?php echo $item->url ?>" title="banner center home" rel="nofollow">
                            <img class="hidden-xs" src="<?php echo getImageThumb($item->thumbnail,265,500) ?>" alt="banner center home">
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
                                     src="<?php echo getImageThumb($item->thumbnail, 340, 160, true) ?>">
                            </a>
                        </div>
                        <div class="blog-preview_info">
                            <h4 class="blog-preview_title">
                                <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>">Standard
                                    blog post with photo</a>
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