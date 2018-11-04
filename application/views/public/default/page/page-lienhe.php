<?php if (!empty($oneItem)): ?>
    <?php $this->load->view($this->template_path . 'account/_header') ?>
    <section class="page-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="block-contact-form ">
                        <div class="title-contact">
                            <h4>Gửi thư liên hệ!</h4>
                        </div>
                        <?php echo form_open('contact/submit'); ?>
                        <div class="row row8">
                            <div class="form-group col-lg-6">
                                <input type="text" name="fullname" class="form-control" placeholder="Họ và tên*">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" name="email" class="form-control" placeholder="Email*">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" name="title" class="form-control" placeholder="Tiêu đề">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại">
                            </div>
                            <div class="form-group col-12">
                                <textarea rows="5" name="content" class="form-control" placeholder="Nội dung*"></textarea>
                            </div>
                        </div>
                        <div class="bottom-contact-form">
                            <div class="captcha">
                                <div class="g-recaptcha" data-sitekey="<?php echo GG_CAPTCHA_SITE_KEY ?>"></div>
                                <?php echo form_error('g-recaptcha-response'); ?>
                            </div>
                            <button class="btn" type="submit">send</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="block-contact-info">
                        <div class="title-contact">
                            <h4>Thông tin về chúng tôi</h4>
                        </div>
                        <div class="item-info">
                            <i class="icon_mail"></i>
                            <p><span>Email:</span> <?php echo $this->settings['email'] ?></p>
                        </div>
                        <div class="item-info">
                            <i class="icon_phone"></i>
                            <p><span>Phone:</span> <?php echo $this->settings['hotline'] ?></p>
                        </div>
                        <div class="item-info">
                            <i class="icon_pin"></i>
                            <p><span>Add:</span> <?php echo $this->settings['address'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
    var google_maps_lat = '<?php echo $this->settings['contact']['maps_latitude'] ?>';
    var google_maps_long = '<?php echo $this->settings['contact']['maps_longitude'] ?>';
    var dataMap = {};
</script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<?php endif ?>