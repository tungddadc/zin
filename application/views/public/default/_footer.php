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
                    <div class="newsletter">
                        <?php echo form_open('contact/subscriber') ?>
                            <div>
                                <h4><span>newsletter</span></h4>
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
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Shopping Guide</h4>
                        <ul class="links">
                            <li><a title="How to buy" href="blog.html">Blog</a></li>
                            <li><a title="FAQs" href="faq.html">FAQs</a></li>
                            <li><a title="Payment" href="#">Payment</a></li>
                            <li><a title="Shipment" href="#">Shipment</a></li>
                            <li><a title="Where is my order?" href="#">Where is my order?</a></li>
                            <li><a title="Return policy" href="#">Return policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Style Advisor</h4>
                        <ul class="links">
                            <li><a title="Your Account" href="login.html">Your Account</a></li>
                            <li><a title="Information" href="#">Information</a></li>
                            <li><a title="Addresses" href="#">Addresses</a></li>
                            <li><a title="Addresses" href="#">Discount</a></li>
                            <li><a title="Orders History" href="#">Orders History</a></li>
                            <li><a title="Order Tracking" href="#">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Information</h4>
                        <ul class="links">
                            <li><a title="Site Map" href="sitemap.html">Site Map</a></li>
                            <li><a title="Search Terms" href="#">Search Terms</a></li>
                            <li><a title="Advanced Search" href="#">Advanced Search</a></li>
                            <li><a title="About Us" href="about_us.html">About Us</a></li>
                            <li><a title="Contact Us" href="contact_us.html">Contact Us</a></li>
                            <li><a title="Suppliers" href="#">Suppliers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>Contact Us</h4>
                    <div class="contacts-info">
                        <address><i class="add-icon"></i>ABC Town Luton Street,<br>
                            New York 226688</address>
                        <div class="phone-footer"><i class="phone-icon"></i>+ 0800 567 345</div>
                        <div class="email-footer"><i class="email-icon"></i><a href="mailto:abc@example.com">abc@example.com</a></div>
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
                            <li class="fb"><a href="#"></a></li>
                            <li class="tw"><a href="#"></a></li>
                            <li class="googleplus"><a href="#"></a></li>
                            <li class="rss"><a href="#"></a></li>
                            <li class="pintrest"><a href="#"></a></li>
                            <li class="linkedin"><a href="#"></a></li>
                            <li class="youtube"><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="payment-accept"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-1.png"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-2.png"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-3.png"> <img alt="" src="<?php echo $this->templates_assets ?>images/payment-4.png"> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 coppyright">
                    © 2017 ThemesSoft. All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<a id="toTop" style="display: none;" href="#"><span id="toTopHover"></span></a>
