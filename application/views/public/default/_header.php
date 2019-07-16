<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:42 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="top-banners">
    <div class="banner"><?php echo $this->settings['block']['header_top'] ?></div>
</div>
<!-- Header -->
<header>
    <div class="header-container">
        <div class="container">
            <div class="flex_row">
                <!-- Header Language -->
                <div class="pull-left">
                    <div class="welcome-msg">Tổng Đài CSKH: <?php echo $this->settings['hotline'] ?></div>
                </div>
                <!-- Header Top Links -->
                <div class="pull-right hidden-xs">
                    <div class="toplinks">
                        <div class="links">
                          <div class="check">
                            <a title="Tin tức" href="<?php echo base_url('tin-tuc.html') ?>">
                              <span class="hidden-xs">Tin tức</span>
                              <span class="icon_new"><img src="<?php echo $this->templates_assets ?>images/new.png" alt="New"></span>
                            </a>
                          </div>
                          <div class="check">
                            <a title="Hỏi đáp" href="<?php echo base_url('hoi-dap.html') ?>">
                              <span class="hidden-xs">Hỏi đáp</span>
                              <span class="icon_new"><img src="<?php echo $this->templates_assets ?>images/new.png" alt="New"></span>
                            </a>
                          </div>

                            <?php if ($this->session->userdata('is_logged')): ?>
                                <div class="check">
                                    <a title="<?php echo $this->_user_login->fullname ?>"
                                       href="<?php echo base_url('profile') ?>">
                                        <i class="fa fa-user-circle-o"></i>
                                        <span class="hidden-xs"><?php echo $this->_user_login->fullname ?></span>
                                    </a>
                                </div>
                                <div class="check">
                                    <a title="Đăng xuất" href="<?php echo base_url('auth/logout') ?>">
                                        <i class="fa fa-user-circle-o"></i>
                                        <span class="hidden-xs">Đăng xuất</span>
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
                                            <a href="<?php echo redirect_login() ?>" title="Đăng nhập bằng tài khoản"
                                               class="btn btn-block btn-social btn-warning">
                                                <span class="fa fa-user"></span>
                                                Đăng nhập bằng tài khoản
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="<?php echo base_url('auth/window/Facebook') ?>"
                                               title="Đăng nhập bằng Facebook"
                                               class="btn btn-block btn-social btn-facebook">
                                                <span class="fa fa-facebook"></span>
                                                Đăng nhập bằng Facebook
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="<?php echo base_url('auth/window/Google') ?>"
                                               title="Đăng nhập bằng Google"
                                               class="btn btn-block btn-social btn-google">
                                                <span class="fa fa-google-plus"></span>
                                                Đăng nhập bằng Google
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a
                                                    href="https://oauth.zaloapp.com/v3/auth?app_id=<?php echo ZALO_APP_ID_CFG ?>&redirect_uri=<?php echo urlencode(ZALO_CAL_BACK) ?>"
                                                    title="Đăng nhập bằng Zalo"
                                                    class="btn btn-block btn-social btn-zalo">
                                                <span class="fa fa-zalo"></span>
                                                Đăng nhập bằng Zalo
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="check">
                                <a title="Checkout" href="<?php echo base_url('wishlist') ?>">
                                    <span class="hidden-xs">Sản phẩm yêu thích</span>
                                </a>
                            </div>

                            <div class="check">
                                <a title="Checkout" href="<?php echo base_url('so-sanh-san-pham') ?>">
                                    <span class="hidden-xs">So sánh sản phẩm</span>
                                </a>
                            </div>

                            <div class="check">
                                <a title="Lịch sử đơn hàng" href="<?php echo base_url('profile/order') ?>">
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
                             src="<?php echo getImageThumb($this->settings['logo'], 260, 50, false, false) ?>">
                    </a>
                </div>
                <!-- End Header Logo -->
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-3 category-search-form">               
                <div class="search-box">
                    <div id="search_mini_form">
                        <input name="search" class="searchbox" id="search" value="<?php echo ($this->_controller === 'search' && !empty($this->uri->segment(2))) ? urldecode($this->uri->segment(2)) : '' ?>" type="text" maxlength="128" autocomplete="off" placeholder="Tìm kiếm sản phẩm...">
                        <button title="Search" class="search-btn-bg btnSearch" id="submit-button" type="submit"></button>
                        <div class="product_search"></div>
                    </div>
                </div>               
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 header-icon">
                <div class="mm-toggle-wrap">
                    <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span></div>
                </div>


                <?php if($this->agent->is_mobile()): ?>
                    <div class="search-box mm-search hidden-xs">
                        <div id="search_mini_form">
                            <input name="search" class="searchbox" id="search" value="<?php echo ($this->_controller === 'search' && !empty($this->uri->segment(2))) ? urldecode($this->uri->segment(2)) : '' ?>" type="text" maxlength="128" autocomplete="off" placeholder="Tìm kiếm sản phẩm...">
                            <button title="Search" class="search-btn-bg btnSearch" id="submit-button" type="submit"></button>
                            <div class="product_search"></div>
                        </div>
                    </div>
                <!--
                <div class="mm-search">
                    <div id="search1">
                        <div class="input-group">
                            <input type="text" class="form-control simple" placeholder="Tìm kiếm sản phẩm.." name="search" value="<?php /*echo ($this->_controller === 'search' && !empty($this->uri->segment(2))) ? urldecode($this->uri->segment(2)) : '' */?>">
                            <div class="input-group-btn">
                                <button class="btn btn-default btnSearch" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>-->
                <?php endif; ?>


                <div class="top-cart-contain">
                    <!-- Top Cart -->
                    <div class="mini-cart1">
                        <div class="basket1">
                            <a href="<?php echo site_url('cua-hang-dai-ly.html?near=1') ?>"><span class="price">Tìm cửa hàng</span>
                              <span class="cart_count hidden-xs">gần bạn</span>
                            </a>
                        </div>
                    </div>
                  <div class="mini-cart">
                        <div class="basket">
                            <a href="<?php echo base_url('cart') ?>"><span class="price hidden-xs">Giỏ hàng</span>
                                <span class="cart_count hidden-xs"><?php echo $this->cart->total_items() ?>
                                    sản phẩm/ <?php echo number_format($this->cart->total(),0,',','.') ?>đ</span>
                            </a>
                        </div>
                        <div class="k_list_cart">
                        </div>
                    </div>
                    <!-- Top Cart -->
                    <div id="ajaxconfig_info" style="display: none;"><a href="<?php echo base_url() ?>"></a>
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
    <nav id="menu-main" class="hidden-xs">
        <div class="nav-container">
            <div class="mega-container visible-lg visible-md visible-sm">
                <div class="navleft-container">
                    <div class="mega-menu-title">
                        <h3><i class="fa fa-navicon"></i> <span>Thương hiệu</span></h3>
                    </div>
                    <div id="menu-category" class="mega-menu-category" style="<?php if ($this->_controller != 'home') echo 'display:none'; ?>">
                        <?php echo navMenuBrand('nav','','nav') ?>
                    </div>
                </div>
            </div>

            <!-- features box -->
            <div class="our-features-box hidden-xs">
                <div class="features-block">
                    <div class="offer-block">
                        <?php echo navMenuMain() ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- end header -->
