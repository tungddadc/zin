<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:42 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="top-banners">
    <div class="banner"> BLACK FRIDAY giảm giá kịch sàn <span>20%</span></div>
</div>
<!-- Header -->
<header>
    <div class="header-container">
        <div class="container">
            <div class="row">
                <!-- Header Language -->
                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 pull-left">
                    <div class="welcome-msg">Đặt hàng online gọi <?php echo $this->settings['hotline'] ?></div>
                </div>
                <!-- Header Top Links -->
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 pull-right hidden-xs">
                    <div class="toplinks">
                        <div class="links">
                            <?php if($this->session->userdata('is_logged')): ?>
                                <div class="check">
                                    <a title="Tài khoản" href="<?php echo base_url('account') ?>">
                                        <i class="fa fa-user-circle-o"></i>
                                        <span class="hidden-xs">Tài khoản</span>
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="check">
                                    <a title="Đăng ký Tài khoản" href="<?php echo base_url('auth/register') ?>">
                                        <i class="fa fa-user-circle-o"></i>
                                        <span class="hidden-xs">Đăng ký</span>
                                    </a>
                                </div>
                                <div class="dropdown block-company-wrapper hidden-xs">
                                    <a class="block-company dropdown-toggle" role="button" href="#"
                                       data-toggle="dropdown" data-target="#"> Login <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a href="<?php echo redirect_login() ?>" title="Đăng nhập bằng tài khoản" class="btn btn-block btn-social btn-warning">
                                                <span class="fa fa-user"></span>
                                                Đăng nhập bằng tài khoản
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="<?php echo base_url('auth/window/Facebook') ?>" title="Đăng nhập bằng Facebook" class="btn btn-block btn-social btn-facebook">
                                                <span class="fa fa-facebook"></span>
                                                Đăng nhập bằng Facebook
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="<?php echo base_url('auth/window/Google') ?>" title="Đăng nhập bằng Google" class="btn btn-block btn-social btn-google">
                                                <span class="fa fa-google-plus"></span>
                                                Đăng nhập bằng Google
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="<?php echo base_url('auth/login_zalo') ?>" title="Đăng nhập bằng Zalo" class="btn btn-block btn-social btn-zalo">
                                                <span class="fa fa-zalo"></span>
                                                Đăng nhập bằng Zalo
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="check">
                                <a title="Checkout" href="<?php echo base_url('wishlisht') ?>">
                                    <span class="hidden-xs">Sản phẩm yêu thích</span>
                                </a>
                            </div>

                            <div class="check">
                                <a title="Lịch sử đơn hàng" href="<?php echo base_url('cart/history') ?>">
                                    <span class="hidden-xs">Lịch sử đơn hàng</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Header Top Links -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-block">
                <!-- Header Logo -->
                <div class="logo">
                    <a title="<?php echo $this->settings['title'] . ' | ' . $this->settings['name'] ?>"
                       href="<?php echo base_url() ?>">
                        <img alt="<?php echo $this->settings['title'] . ' | ' . $this->settings['name'] ?>"
                             src="<?php echo getImageThumb($this->settings['logo'], 141, 39) ?>">
                    </a>
                </div>
                <!-- End Header Logo -->
            </div>
            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-3 hidden-xs category-search-form">
                <div class="search-box">
                    <form id="search_mini_form" action="" method="get">
                        <!-- Autocomplete End code -->
                        <input name="q" class="searchbox" id="search" type="text" maxlength="128"
                               value="Search entire store here...">
                        <button title="Search" class="search-btn-bg" id="submit-button" type="submit"></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 card_wishlist_area">
                <div class="mm-toggle-wrap">
                    <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span></div>
                </div>
                <div class="top-cart-contain">
                    <!-- Top Cart -->
                    <div class="mini-cart">
                        <div class="basket dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><a
                                    href="<?php echo base_url('cart') ?>"><span class="price hidden-xs">Giỏ hàng</span>
                                <span class="cart_count hidden-xs"><?php echo $this->cart->total_items() ?>
                                    sản phẩm/ <?php echo $this->cart->total() .' đ' ?></span> </a></div>
                        <div>
                            <div class="top-cart-content">
                                <!--block-subtitle-->
                                <ul class="mini-products-list" id="cart-sidebar">
                                    <li class="item first">
                                        <div class="item-inner">
                                            <a title="Retis lapen casen" class="product-image"
                                                                   href="<?php echo base_url() ?>_l"><img
                                                        alt="Retis lapen casen" src="products-images/product4.jpg"> </a>
                                            <div class="product-details">
                                                <div class="access"><a title="Remove This Item" class="btn-remove1"
                                                                       href="#">Remove</a> <a title="Edit item"
                                                                                              class="btn-edit" href="#"><i
                                                                class="icon-pencil"></i><span
                                                                class="hidden">Edit item</span></a></div>
                                                <!--access--><strong>1</strong> x <span class="price">$179.99</span>
                                                <p class="product-name"><a href="#">Retis lapen casen...</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item last">
                                        <div class="item-inner"><a title="Retis lapen casen" class="product-image"
                                                                   href="product_detail.html"><img
                                                        alt="Retis lapen casen" src="products-images/product3.jpg"> </a>
                                            <div class="product-details">
                                                <div class="access"><a title="Remove This Item" class="btn-remove1"
                                                                       href="#">Remove</a> <a title="Edit item"
                                                                                              class="btn-edit" href="#"><i
                                                                class="icon-pencil"></i><span
                                                                class="hidden">Edit item</span></a></div>
                                                <!--access--><strong>1</strong> x <span class="price">$80.00</span>
                                                <p class="product-name"><a href="#">Retis lapen casen...</a></p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <!--actions-->
                                <div class="actions">
                                    <button title="Checkout" class="btn-checkout" type="button"><span>Thanh toán</span></button>
                                    <a class="view-cart" href="<?php echo base_url('cart') ?>"><span>Xem giỏ hàng</span></a></div>
                            </div>
                        </div>
                    </div>
                    <!-- Top Cart -->
                    <div id="ajaxconfig_info" style="display: none;"><a
                                href="<?php echo base_url() ?>"></a>
                        <input type="hidden" value="">
                        <input id="enable_module" type="hidden" value="1">
                        <input class="effect_to_cart" type="hidden" value="1">
                        <input class="title_shopping_cart" type="hidden" value="Go to shopping cart">
                    </div>
                </div>
                <!-- mgk wishlist -->
            </div>
        </div>
    </div>
    <nav class="hidden-xs">
        <div class="nav-container">
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="mega-container visible-lg visible-md visible-sm">
                    <div class="navleft-container">
                        <div class="mega-menu-title">
                            <h3><i class="fa fa-navicon"></i> Thương hiệu</h3>
                        </div>
                        <div class="mega-menu-category">
                            <?php $listBrandCategory = getAllBrand(); ?>
                            <ul class="nav">
                                <?php if(!empty($listBrandCategory)) foreach ($listBrandCategory as $item): ?>
                                <li class="<?php echo empty($item->list_child) ? 'nosub' : '' ?>">
                                    <a href="<?php echo getUrlBrand($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
                                    <?php if(!empty($item->list_child)): ?>
                                    <div class="wrap-popup column1">
                                        <div class="popup">
                                            <ul class="nav">
                                                <?php foreach ($item->list_child as $itemChild): ?>
                                                <li><a href="<?php echo getUrlBrand($itemChild) ?>" title="<?php echo getTitle($itemChild) ?>"><?php echo $itemChild->title ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- features box -->
            <div class="our-features-box hidden-xs">
                <div class="features-block">
                    <div class="col-lg-9 col-md-9 col-xs-12 col-sm-9 offer-block">
                        <?php echo navMenuMain() ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- end header -->
