<?php if (!empty($oneItem)):
    $url = getUrlPage($oneItem);
    ?>
    <div class="clearfix"></div>
    <!-- Main Container -->
    <section class="main-container" style="margin-top: 0">
        <div class="clearfix"></div>
        <div class="top-agency clear-after">
            <div class="img-right">
                <img src="<?php echo !empty($oneItem->banner) ? getImageThumb($oneItem->banner) : $this->templates_assets . 'images/background_sieu_thi_large.jpg'; ?>"
                 alt="Hệ thống siêu thị">
            </div>
            <div class="top-agency__abs">
                <ul>
                    <li>
                        <img src="<?php echo $this->templates_assets . 'images/boy-1299640_960_720.png' ?>" alt=""><b
                                class="so" id="total_agency"
                                data-val="<?php echo countAgency() ?>"><?php echo countAgency() ?></b> CỬA HÀNG
                        <p>Trên toàn quốc</p>
                    </li>
                    <li>
                        <img src="<?php echo $this->templates_assets . 'images/Customer-png.png' ?>" alt=""><b
                                class="so" id="serve_customer"
                                data-val="<?php echo countMember() ?>"><?php echo countMember() ?></b> KHÁCH
                        <p>được phục vụ mỗi ngày</p>
                    </li>
                    <li>
                        <img src="<?php echo $this->templates_assets . 'images/customer_service_png_357586.png' ?>"
                             alt=""><b><?php echo $this->settings['open_door'] ?></b> MỞ CỬA
                        <p>kể cả chủ nhật & ngày lễ</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">

            <div class="main-agency">
                <form action="#" class="form_filter">
                    <h2>TÌM CỬA HÀNG, ĐẠI LÝ</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="city_id" class="form-control select2"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="district_id" class="form-control select2"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="search_key">
                                <input type="text" name="text_search" class="form-control"
                                       placeholder="Nhập tên đường, tỉnh thành, quận huyện"
                                       onkeyup="live_search(this.value)">
                                <ul class="result ">
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="list-agency" id="_list_agency">
                    <div class="list-agency__title">
                        <a href="javascript:;"><i class="fa fa-map-marker" aria-hidden="true"></i> Xem siêu thị gần bạn</a>
                    </div>
                    <div class="list-agency__content">
                        <h2>DANH SÁCH CỬA HÀNG, ĐẠI LÝ</h2>
                        <ul>
                            <?php if (!empty($data)) foreach ($data as $item): ?>
                                <li>
                                    <a href="<?php echo getUrlAgency($item) ?>"><?php echo $item->title ?>
                                        , <?php echo $item->address ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="list-agency__un">
                        <h2>CÁC TIỆN ÍCH Ở CỬA HÀNG, ĐẠI LÝ</h2>
                        <ul class="clear-after">
                            <li>
                                <i class="iconshop-parking"></i>&nbsp;Giữ xe miễn phí
                            </li>
                            <li>
                                <i class="iconshop-wifi"></i>&nbsp;Wifi miễn phí
                            </li>
                            <li>
                                <i class="iconshop-guide"></i>&nbsp;Hướng dẫn dùng sản phẩm, tải nhạc, game, app miễn
                                phí
                            </li>
                            <li>
                                <i class="iconshop-trial"></i>&nbsp;Xem và dùng thử sản phẩm miễn phí
                            </li>
                            <li>
                                <i class="iconshop-staff"></i>&nbsp;Nhân viên thân thiện, nhiệt tình
                            </li>
                            <li>
                                <i class="iconshop-return"></i><a href="/chinh-sach-doi-tra-san-pham.html">&nbsp;Đổi trả
                                    sản phẩm trong 1
                                    tháng</a>
                            </li>
                            <li>
                                <i class="iconshop-guarantee"></i><a href="/chinh-sach-bao-hanh.html">&nbsp;Hỗ trợ bảo
                                    hành chính hãng</a>
                            </li>
                            <li>
                                <i class="iconshop-ship"></i><a href="/don-vi-van-chuyen.html">&nbsp;Có giao hàng tận
                                    nơi</a>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                        <div class="fb-comments" data-href="<?php echo current_url() ?>" width="100%"
                             data-numposts="5"></div>
                        <div class="clearfix"></div>
                        <div id="comments" data-id="<?php echo $oneItem->id ?>" class="comment-fr">
                            <div class="cmt-head">
                                <div class="table">
                                    <div class="cell">
                                        <strong>Bình Luận từ hệ thống</strong>
                                    </div>
                                    <div class="cell text-right">
                                        <select name="comment_sort" style="width: 100px">
                                            <option>Mới nhất</option>
                                            <option>Cũ nhất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="cmt-list"></div>
                            <?php if ($this->session->userdata('is_logged')): ?>
                                <?php echo form_open('product/ajax_save_comment', ['class' => 'form-input form-comment']) ?>
                                <input type="hidden" name="account_id"
                                       value="<?php echo $this->session->userdata('user_id') ?>">
                                <input type="hidden" name="product_id" value="<?php echo $oneItem->id ?>">
                                <div class="clearfix">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Tên của bạn"
                                               value="<?php echo $this->_user_login->fullname ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Email"
                                               value="<?php echo $this->session->userdata('email') ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="content" placeholder="Mời bạn để lại bình luận"
                                              class="form-control"></textarea>
                                </div>
                                <div class="fr-photo"></div>
                                <div class="fr-ctrl">
                                    <button type="submit" class="smooth send send_comment">Gửi bình luận</button>
                                </div>
                                <?php echo form_close() ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Main Container End -->
<?php endif; ?>
<script !src="">
    var ddgannhat = '<?php if (!empty($this->input->get('near'))) echo 1 ?>';
</script>
