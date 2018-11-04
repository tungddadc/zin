<?php
    /**
     * Created by PhpStorm.
     * User: Steven Nguyen
     * Date: 28/06/2018
     * Time: 12:56 SA
     */
    defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view($this->template_path . 'account/_header') ?>
<section class="page-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <?php $this->load->view($this->template_path . 'account/_sidebar') ?>
            </div>
            <div class="col-lg-10">
                <div class="wrap-profile-summary">
                    <div class="content-profile-summary">
                        <div class="top">
                            <div class="level">
                                <?php if(!empty($this->session->userdata('account')['is_vip'])):?>
                                    <i class="lnr lnr-diamond"></i>
                                    <div class="content">
                                        <span>Người dùng VIP (<small class="text-danger">Ngày hết hạn: <?php echo !empty($account->expired_time) ? timeAgo($account->expired_time,'d/m/Y') : '' ?></small>)</span>
                                    </div>
                                <?php else: ?>
                                    <img src="<?php echo $this->templates_assets ?>images/level.png" alt="">
                                    <div class="content">
                                        <span>Người dùng phổ thông</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!--<a href="javascript:;" data-toggle='modal' data-target="#sl-payment" title="Nạp tiền" class="buy-point"><i class="lnr lnr-diamond"></i>Nạp tiền</a>-->
                        </div>
                        <div class="type-account">
                            <a href="javascript:;" title="Tài khoản thường" class="regular item">
                                <img src="<?php echo $this->templates_assets ?>images/account-regular.png" alt="">
                                <div class="content">
                                    <span>Tài khoản thường</span>
                                    <span>Tải tất cả các ảnh miễn phí</span>
                                </div>
                            </a>
                            <a href="javascript:;" title="Tài khoản VIP" class="vip item">
                                <img src="<?php echo $this->templates_assets ?>images/account-vip.png" alt="">
                                <div class="content">
                                    <span>Tài khoản VIP</span>
                                    <span>Tải tất cả các ảnh miễn phí và kho ảnh VIP</span>
                                </div>
                            </a>
                        </div>
                        <div class="block-item-profile">
                            <div class="heading">
                                <h3>Đã tải xuống gần đây</h3>
                                <a href="<?php echo base_url('account/my_download') ?>" title="Xem thêm" class="view-more">Xem thêm <i class="arrow_triangle-right"></i></a>
                            </div>
                            <div class="row row13">
                                <?php if(!empty($data_download)) foreach ($data_download as $item): ?>
                                <div class="col-md-4">
                                    <div class="item-profile-primary">
                                        <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo $item->title ?>" class="img">
                                            <img src="<?php echo getImageThumb($item->thumbnail, 257,257) ?>" alt="<?php echo $item->title ?>">
                                        </a>
                                        <div class="title"><a href="<?php echo getUrlProduct($item) ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="block-item-profile">
                            <div class="heading">
                                <h3>Đề xuất cho bạn</h3>
                            </div>
                            <div class="row row13">
                                <?php if(!empty($data_recommend)) foreach ($data_recommend as $item): ?>
                                    <div class="col-md-4">
                                        <div class="item-profile-primary">
                                            <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo $item->title ?>" class="img">
                                                <img src="<?php echo getImageThumb($item->thumbnail, 257,257) ?>" alt="<?php echo $item->title ?>">
                                            </a>
                                            <div class="title"><a href="<?php echo getUrlProduct($item) ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <?php if(!empty($data_faqs)): ?>
                        <div class="heading">
                            <a href="<?php echo getUrlCateNews($data_faqs['oneCategory']) ?>" title="<?php echo $data_faqs['oneCategory']->title ?>" class="title"><?php echo $data_faqs['oneCategory']->title ?></a>
                            <a href="<?php echo getUrlCateNews($data_faqs['oneCategory']) ?>" title="<?php echo $data_faqs['oneCategory']->title ?>" class="view-more">Xem thêm <i class="arrow_triangle-right"></i></a>
                        </div>
                        <div class="list-question">
                            <ul>
                                <?php if(!empty($data_faqs['list_data'])) foreach ($data_faqs['list_data'] as $item): ?>
                                    <li><a href="<?php echo getUrlCateNews($data_faqs['oneCategory'])."#question".$item->id ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
