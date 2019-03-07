<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:42 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Footer -->
<footer class="footer">
    <div class="newsletter-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="newsletter newsletter-footer">
                        <?php echo form_open('contact/subscriber') ?>
                            <div>
                                <h4><span>Đăng ký bản tin</span></h4>
                                <input name="email" title="Đăng ký để nhận tin khuyến mại" class="input-text" id="newsletter1" type="text" placeholder="Nhập email của bạn vào đây">
                                <button class="subscribe" type="submit"><span>Đăng ký</span></button>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--newsletter-->
    <div class="footer-middle footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Chính sách công ty</h4>
                        <?php echo navMenuFooter1('links') ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Thông tin tài khoản</h4>
                        <?php echo navMenuFooter2('links') ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Thông tin</h4>
                        <?php echo navMenuFooter3('links') ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>Liên hệ với chúng tôi</h4>
                    <?php $contact = $this->settings['contact'][$this->session->userdata('public_lang_code')]; ?>
                    <div class="contacts-info">
                        <address><i class="add-icon"></i><?php echo $contact['title'] ?>. <?php echo $contact['address'] ?></address>
                        <div class="phone-footer"><i class="building-icon"></i>Văn phòng: <?php echo $this->settings['address_office'] ?></div>
                        <div class="phone-footer"><i class="phone-icon"></i><?php echo $contact['phone'] ?></div>
                        <div class="email-footer"><i class="email-icon"></i><a href="mailto:<?php echo $contact['email'] ?>"><?php echo $contact['email'] ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="social">
                        <ul>
                            <li class="fb"><a target="_blank" href="<?php echo $this->settings['social_facebook'] ?>" title="<?php echo $this->settings['social_facebook'] ?>"></a></li>
                            <li class="googleplus"><a target="_blank" href="<?php echo $this->settings['social_google'] ?>" title="<?php echo $this->settings['social_google'] ?>"></a></li>
                            <li class="youtube"><a target="_blank" href="<?php echo $this->settings['social_youtube'] ?>" title="<?php echo $this->settings['social_youtube'] ?>"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="payment-accept"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-1.png"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-2.png"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-3.png"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-4.png"> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle footer-link">
        <div class="container">
            <?php echo navMenuFooterCol('nav-link') ?>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 coppyright">
                    <?php echo !empty($this->settings['block']['footer_copyright']) ? $this->settings['block']['footer_copyright'] : '' ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<a id="toTop" style="display: none;" href="javascript:;" rel="nofollow"><span id="toTopHover"></span></a>

<div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon" style="left:0;">
    <a href="tel:<?php echo $this->settings['hotline'] ?>" title="<?php echo $this->settings['hotline'] ?>" data-original-title="Liên hệ với chúng tôi">
        <div class="coccoc-alo-ph-circle"></div>
        <div class="coccoc-alo-ph-circle-fill"></div>
        <div class="coccoc-alo-ph-img-circle"></div>
        <span class="phone_text">Tư vấn miễn phí</span>
    </a>
</div>
<div class="alo-floating left">
    <a href="tel:<?php echo $this->settings['hotline'] ?>" title="Liên hệ với chúng tôi"><i class="fa fa-phone"></i><strong><?php echo $this->settings['hotline'] ?></strong></a>
</div>