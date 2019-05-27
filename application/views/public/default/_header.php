<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:42 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header>
    <div class="container">
        <div class="row">
            <!--logo-->
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 logo-block">
                <div class="logo">
                    <a title="<?php echo $this->settings['title'] . ' | ' . $this->settings['name'] ?>"
                       href="<?php echo base_url() ?>">
                        <img alt="<?php echo $this->settings['title'] . ' | ' . $this->settings['name'] ?>"
                             src="<?php echo getImageThumb($this->settings['logo'], 260, 50, true, false) ?>">
                    </a>
                </div>

            </div>
            <!--logo-->

            <!--Search form-->
            <div class="col-lg-3 col-md-8 col-sm-6 col-xs-6 category-search-form">
                <?php if($this->agent->is_mobile() == false): ?>
                    <div class="search-box">
                        <div id="search_mini_form">
                            <input name="search" class="searchbox" id="search" value="<?php echo ($this->_controller === 'search' && !empty($this->uri->segment(2))) ? urldecode($this->uri->segment(2)) : '' ?>" type="text" maxlength="128" autocomplete="off" placeholder="Tìm kiếm sản phẩm...">
                            <button title="Search" class="search-btn-bg btnSearch" id="submit-button" type="submit"></button>
                            <div class="product_search"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!--Search form-->

            <div class="hidden-lg col-md-2 col-sm-1 col-xs-2">
                <a href="javascript:void(0)" class="btn-menu-mobile hidden-lg mm-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
            </div>

        <!--Main menu-->
            <div class="col-lg-5 hidden-md hidden-sm hidden-xs position-static">
                <?php echo navMenuMain('main-menu','main-menu-desktop') ?>
            </div>
        <!--Main menu-->

        <!--Login, SignIn, SignOut, Cart-->
            <div class="col-lg-2 hidden-md hidden-sm hidden-xs">
                <ul class="menu-icon">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($this->session->userdata('is_logged')) :?>
                            <li>
                                <a class="btn btn-block btn-social btn-primary" title="<?php echo $this->_user_login->fullname ?>" href="<?php echo base_url('profile') ?>">Thông tin tài khoản</a>
                            </li>
                            <li>
                                <a class="btn btn-block btn-social btn-danger" title="Đăng xuất" href="<?php echo base_url('auth/logout') ?>">Đăng xuất</a>
                            </li>
                            <?php else: ?>
                            <li>                                    
                                <a class="btn btn-block btn-social btn-info" title="Đăng ký Tài khoản" class="btn btn-primary btn-block" href="<?php echo base_url('auth/register') ?>">
                                    Đăng ký tài khoản
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block btn-social btn-warning" href="<?php echo redirect_login() ?>" title="Đăng nhập bằng tài khoản">
                                    Đăng nhập bằng tài khoản
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block btn-social btn-primary" href="<?php echo base_url('auth/window/Facebook') ?>" title="Đăng nhập bằng Facebook">
                                    Đăng nhập bằng Facebok
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block btn-social btn-danger" href="<?php echo base_url('auth/window/Google') ?>" title="Đăng nhập bằng Google">
                                    Đăng nhập bằng Google
                                </a>
                            </li>
                            <?php endif; ?>
                            
                        </ul>

                    </li>

                    <li class="cart-icon">
                        <a href="<?php echo base_url('cart') ?>" title="Giỏ hàng của bạn">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                            <span class="cart_count"><?php echo $this->cart->total_items() ?></span>
                        </a>
                        <div class="k_list_cart">
                        </div>
                        <div id="ajaxconfig_info" style="display: none;"><a href="<?php echo base_url() ?>"></a>
                            <input type="hidden" value="">
                            <input id="enable_module" type="hidden" value="1">
                            <input class="effect_to_cart" type="hidden" value="1">
                            <input class="title_shopping_cart" type="hidden" value="Go to shopping cart">
                        </div>
                    </li>
                    <li class="compare">
                        <a title="So sánh sản phẩm" href="<?php echo base_url('so-sanh-san-pham') ?>">
                            <i class="fa fa-compass" aria-hidden="true"></i>
                        </a>

                    </li>
                    <li class="location-icon">
                        <a href="<?php echo site_url('cua-hang-dai-ly.html?near=1') ?>" title="Tìm cửa hàng gần đây">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </a>
                    </li>


                </ul>
            </div>

        <!--Login, SignIn, SignOut, Cart-->

        </div>
    </div>
</header>

<div id="mobile-menu" class="hidden-lg">
    <?php echo navMenuMain('mobile-menu'); ?>
    <ul class="mobile-menu-icon">
        <?php if ($this->session->userdata('is_logged')) :?>
        <li>
            <a class="btn btn-block btn-social btn-primary" title="<?php echo $this->_user_login->fullname ?>" href="<?php echo base_url('profile') ?>"><?php echo $this->_user_login->fullname ?></a>
        </li>
        <li>
            <a class="btn btn-block btn-social btn-danger" title="Đăng xuất" href="<?php echo base_url('auth/logout') ?>">Đăng xuất</a>
        </li>
        <?php else: ?>
        <li>
            <a class="btn btn-block btn-social btn-info" title="Đăng ký Tài khoản" class="btn btn-primary btn-block" href="<?php echo base_url('auth/register') ?>">
                Đăng ký tài khoản
            </a>
        </li>
        <li>
            <a class="btn btn-block btn-social btn-warning" href="<?php echo redirect_login() ?>" title="Đăng nhập bằng tài khoản">
                Đăng nhập bằng tài khoản
            </a>
        </li>
        <li>
            <a class="btn btn-block btn-social btn-primary" href="<?php echo base_url('auth/window/Facebook') ?>" title="Đăng nhập bằng Facebook">
                Đăng nhập bằng Facebok
            </a>
        </li>
        <li>
            <a class="btn btn-block btn-social btn-danger" href="<?php echo base_url('auth/window/Google') ?>" title="Đăng nhập bằng Google">
                Đăng nhập bằng Google
            </a>
        </li>

        <?php endif; ?>
        <li class="cart-icon">
            <a href="<?php echo base_url('cart') ?>" title="Giỏ hàng của bạn">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                <span class="cart_count"><?php echo $this->cart->total_items() ?> sản phẩm</span>
            </a>
        </li>
        <li class="compare">
            <a title="So sánh sản phẩm" href="<?php echo base_url('so-sanh-san-pham') ?>">
                <i class="fa fa-compass" aria-hidden="true"></i>
                <span>So sánh sản phẩm</span>
            </a>

        </li>
        <li class="location-icon">
            <a href="<?php echo site_url('cua-hang-dai-ly.html?near=1') ?>" title="Tìm cửa hàng gần đây">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>Cửa hàng gần đây</span>
            </a>
        </li>
    </ul>
</div>

