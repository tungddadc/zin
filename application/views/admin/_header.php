<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 14/12/2017
 * Time: 12:20 SA
 */
?>
<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">
            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="<?php echo site_admin_url() ?>" class="m-brand__logo-wrapper">
                            <img alt=""
                                 src="<?php echo $this->templates_assets ?>images/logo.png" width="140">
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block
					 ">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                           class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                           class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                           class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>
            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                        id="m_aside_header_menu_mobile_close_btn">
                    <i class="la la-close"></i>
                </button>
                <!-- END: Horizontal Menu -->
                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-business"></i>
                                <span class="m-menu__link-text">
                                    Quản lý đơn hàng
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 73px;"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="<?php echo site_admin_url('order?is_status=2') ?>" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-signs-1"></i>
                                            <span class="m-menu__link-text">
                                                Đơn hàng mới nhất
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="<?php echo site_admin_url('order?is_status=3') ?>" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-signs-1"></i>
                                            <span class="m-menu__link-text">
                                                Đơn hàng chờ giao
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="<?php echo site_admin_url('order?is_status=1') ?>" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-signs-1"></i>
                                            <span class="m-menu__link-text">
                                                Đơn hàng hoàn thành
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="<?php echo site_admin_url('order?is_status=0') ?>" class="m-menu__link ">
                                            <i class="m-menu__link-icon flaticon-signs-1"></i>
                                            <span class="m-menu__link-text">
                                                Đơn hàng hủy
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item">
                            <a href="<?php echo site_admin_url('menu') ?>" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-menu-1"></i>
                                <span class="m-menu__link-text">
                                    Cấu hình menu
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">
                                <a href="<?php echo base_url() ?>" target="_blank"
                                   class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                    <span class="m-nav__link-icon">
                                        <i class="la la-home"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="<?php echo $this->templates_assets ?>assets/app/media/img/users/user4.jpg"
                                                         class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                                    <span class="m-topbar__username m--hide">
													Nick
												</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center"
                                             style="background: url(<?php echo $this->templates_assets ?>assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="<?php echo $this->templates_assets ?>assets/app/media/img/users/user4.jpg"
                                                         class="m--img-rounded m--marginless" alt=""/>
                                                </div>
                                                <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	Mark Andre
																</span>
                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                        mark.andre@gmail.com
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="<?php echo site_admin_url('user/profile') ?>"
                                                           class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																			</span>
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="<?php echo site_admin_url('user/activity') ?>"
                                                           title="Activity" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
																			Activity
																		</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="<?php echo site_admin_url('user/logout') ?>"
                                                           title="Logout"
                                                           class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                            Logout
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>