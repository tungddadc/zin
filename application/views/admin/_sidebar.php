<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 14/12/2017
 * Time: 12:21 SA
 */
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->templates_assets;?>img/avatar.png" class="img-circle" alt="<?php echo $this->session->user;?>">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->user;?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu CMS</li>
            <li class="">
                <a href="<?php echo BASE_ADMIN_URL ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Quản lý Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo site_url('admin/groups');?>">
                            <i class="fa fa-users"></i> Danh sách nhóm
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/users');?>">
                            <i class="fa fa-user"></i> Danh sách Users
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/users');?>">
                            <i class="fa fa-user"></i> Danh sách Khách hàng
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/newsletter');?>">
                            <i class="fa fa-user"></i> Báo giá khuyến mãi
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('admin/media');?>">
                    <i class="fa fa-image"></i> <span>Quản lý Media</span>
                </a>
            </li>
			<!--Property MODULE-->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-list-ol"></i> <span>Quản lý thuộc tính</span>
					<span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
				</a>

				<ul class="treeview-menu">
					<li>
						<a href="<?php echo site_url('admin/property/size');?>">
							<i class="fa fa-list-ol"></i> <span>Kích thước sản phẩm</span>
						</a>
					</li>

                    <li>
						<a href="<?php echo site_url('admin/property/taste');?>">
							<i class="fa fa-list-ol"></i> <span>Mùi vị sản phẩm</span>
						</a>
					</li>
				</ul>
			</li>
			<!--Property MODULE-->

            <!--Banner MODULE-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-picture-o"></i> <span>Quản lý banner</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo site_url('admin/property/banner');?>">
                            <i class="fa fa-list-ol"></i> <span>Vị trí banner</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/banner');?>">
                            <i class="fa fa-file-text "></i> <span>Danh sách banner</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--Banner MODULE-->
            <!--Bai viet MODULE-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Quản lý bài viết</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo site_url('admin/category/post');?>">
                            <i class="fa fa-list-ol"></i> <span>Danh mục bài viết</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/post');?>">
                            <i class="fa fa-file-text "></i> <span>Bài viết</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--Bai viet MODULE-->
            <!--San pham MODULE-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>Quản lý sản phẩm</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo site_url('admin/category/product');?>">
                            <i class="fa fa-list-ol"></i> <span>Danh mục sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/category/brand');?>">
                            <i class="fa fa-list-ol"></i> <span>Thương hiệu</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/property/gift');?>">
                            <i class="fa fa-gift"></i> <span>Quà tặng</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/product');?>">
                            <i class="fa fa-file-text "></i> <span>Sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/order');?>">
                            <i class="fa fa-address-card-o"></i> <span>Đơn hàng</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--San pham MODULE-->

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Quản lý page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <!--<li>
                        <a href="<?php /*echo site_url('admin/category/page');*/?>">
                            <i class="fa fa-list-ol"></i> <span>Danh mục page</span>
                        </a>
                    </li>-->
                    <li class="">
                        <a href="<?php echo site_url('admin/page');?>">
                            <i class="fa fa-file"></i> <span>Danh sách Page</span>
                        </a>
                    </li>
                </ul>
            </li>


            <!--Bai viet MODULE-->
            <li class="header">Settings</li>
            <li class="">
                <a href="<?php echo site_url('admin/setting');?>">
                    <i class="fa fa-cogs"></i> <span>Cấu hình chung</span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo site_url('admin/menus');?>">
                    <i class="fa fa-bars"></i> <span>Cấu hình Menu</span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo site_url('admin/logaction');?>">
                    <i class="fa fa-exclamation-triangle"></i> <span>Logs</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
