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
            <div class="col-md-2 col-sm-4 col-xs-12 logo-block">
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
            <div class="col-md-3 col-sm-8 col-xs-3 hidden-xs category-search-form">
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


        <!--Main menu-->
            <div class="col-md-5 hidden-sm hidden-xs">
                <?php echo navMenuMain('main-menu','main-menu-desktop') ?>
            </div>
        <!--Main menu-->

        <!--Login, SignIn, SignOut, Cart-->
            <div class="col-md-2 hidden-sm hidden-xs">
                <ul class="menu-icon">

                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <ul class="dropdown-menu">
                                <?php if ($this->session->userdata('is_logged')) :?>
                                <li>
                                    <a title="<?php echo $this->_user_login->fullname ?>" href="<?php echo base_url('profile') ?>">Thông tin tài khoản</a>
                                </li>
                                <li>
                                    <a title="Đăng xuất" href="<?php echo base_url('auth/logout') ?>">Đăng xuất</a>
                                </li>
                                <?php else: ?>
                                <li>
                                    <a title="Đăng ký Tài khoản" href="<?php echo base_url('auth/register') ?>">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <span>Đăng ký</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo redirect_login() ?>" title="Đăng nhập bằng tài khoản">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                                        <span>Đăng nhập</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('auth/window/Facebook') ?>" title="Đăng nhập bằng tài khoản">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        <span>Đăng nhập bằng Facebok</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('auth/window/Google') ?>" title="Đăng nhập bằng tài khoản">
                                        <i class="fa fa-google" aria-hidden="true"></i>
                                        <span>Đăng nhập bằng Google</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                            </ul>
                        </a>

                    </li>
                    <li class="cart-icon">
                        <a href="<?php echo base_url('cart') ?>">
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
                    <li class="location-icon">
                        <a href="<?php echo site_url('cua-hang-dai-ly.html?near=1') ?>">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </a>
                    </li>


                </ul>
            </div>

        <!--Login, SignIn, SignOut, Cart-->

        </div>
    </div>
</header>