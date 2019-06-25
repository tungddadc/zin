<?php if (!empty($oneItem)):
    $url = getUrlProduct($oneItem);
    $album = !empty($oneItem->album) ? json_decode($oneItem->album) : [];
    array_push($album, $oneItem->thumbnail);
    ?>
    <!-- Main Container -->
    <section class="main-container col1-layout">
        <div class="container">
            <div class="row">

                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                </div>
                <!-- Breadcrumbs End -->

                <div class="col-sm-12 col-xs-12">

                    <article class="col-main">
                        <div class="product-view">
                            <div id="ajax-quickview" class="product-essential">
                                <div class="product-img-box col-lg-4 col-sm-4 col-xs-12">
                                    <?php echo !empty($oneItem->is_new) ? '<div class="new-label new-top-left"> New </div>' : '' ?>
                                    <div class="product-image">
                                        <div class="product-full">
                                            <img id="product-zoom"
                                                 src="<?php echo getImageThumb($album[0], 371, 371, true, true) ?>"
                                                 data-zoom-image="<?php echo getImageThumb($album[0], 0, 0, false, true) ?>"
                                                 alt="<?php echo getTitle($oneItem) ?>"/>
                                        </div>
                                        <div class="more-views">
                                            <div class="slider-items-products">
                                                <div id="gallery_01"
                                                     class="product-flexslider hidden-buttons product-img-thumb">
                                                    <div class="slider-items slider-width-col4 block-content">
                                                        <?php if (!empty($album)) foreach ($album as $item): ?>
                                                            <div class="more-views-items">
                                                                <a href="javascript:;"
                                                                   data-image="<?php echo getImageThumb($item, 375, 375, true, true) ?>"
                                                                   data-zoom-image="<?php echo getImageThumb($item, 500, 600, false, true) ?>"
                                                                   title="<?php echo getTitle($oneItem) ?>">
                                                                    <img id="product-zoom"
                                                                         src="<?php echo getImageThumb($item, 76, 76, true, true) ?>"
                                                                         alt="<?php echo getTitle($oneItem) ?>"/>
                                                                </a>
                                                            </div>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="agency">
                                            <div class="panel panel-danger">
                                                <div class="panel-heading panel-danger">
                                                    <h4 class="panel-title">Ưu đãi dành cho đại lý</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <a href="<?php echo base_url('dieu-kien-va-chinh-sach-dai-ly.html') ?>"
                                                       class="btn btn-warning btn-block"
                                                       title="Điều kiện và chính sách đại lý">Điều kiện và chính sách
                                                        đại lý</a>
                                                    <a href="<?php echo base_url('gia-dai-ly-va-uu-dai.html') ?>"
                                                       class="btn btn-warning btn-block"
                                                       title="Giá đại lý và ưu đãi">Giá đại lý và ưu đãi</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($oneItem->post_related)) {
                                            $listId = json_decode($oneItem->post_related, true);
                                            if (!empty($listId)) $listPostRelated = getPostRelated($listId);
                                            if (!empty($listPostRelated)) {
                                                ?>
                                                <div class="post_related">
                                                    <h2>Tin tức liên quan</h2>
                                                    <?php foreach ($listPostRelated as $item): ?>
                                                        <div class="item">
                                                            <a href="<?php echo getUrlNews($item) ?>">
                                                                <div class="left">
                                                                    <img src="<?php echo getImageThumb($item->thumbnail, 300, 200, true) ?>"
                                                                         alt="<?php echo $item->title ?>">
                                                                </div>
                                                                <div class="right">
                                                                    <h3><?php echo $item->title ?></h3>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php
                                            }
                                        }

                                        ?>

                                    </div>
                                    <!-- end: more-images -->
                                </div>
                                <div class="product-shop col-lg-5 col-sm-5 col-xs-12">
                                    <div class="product-next-prev">
                                        <?php if (!empty($oneNext)): ?>
                                            <a class="product-next" href="<?php echo getUrlProduct($oneNext) ?>"
                                               title="<?php echo getTitle($oneNext) ?>"><span></span></a>
                                        <?php endif; ?>
                                        <?php if (!empty($onePrev)): ?>
                                            <a class="product-prev" href="<?php echo getUrlProduct($onePrev) ?>"
                                               title="<?php echo getTitle($onePrev) ?>"><span></span></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-name">
                                        <h1><?php echo $oneItem->title ?></h1>
                                    </div>
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <div style="width:<?php echo round(($oneItem->vote / 5) * 100) ?>%"
                                                 class="rating"></div>
                                        </div>
                                        <p class="rating-links">
                                            <a href="<?php echo getUrlProduct($oneItem) ?>#reviews_tabs" rel="nofollow"
                                               title="Phản hồi về sản phẩm">
                                                <?php echo $oneItem->total_vote ?> lượt phản hồi về sản phẩm này</a>
                                        </p>
                                        <div class="email-addto-box">
                                            <ul class="add-to-links">
                                                <li>
                                                    <a class="link-wishlist" data-id="<?php echo $oneItem->id ?>"
                                                       href="javascript:;"
                                                       title="Yêu thích sản phẩm này" rel="nofollow"><span>Yêu thích sản phẩm này</span></a>
                                                </li>
                                                <li>
                                                    <span class="separator">|</span>
                                                    <a class="link-compare" data-id="<?php echo $oneItem->id ?>"
                                                       href="javascript:;" title="So sánh sản phẩm này"
                                                       rel="nofollow"><span>So sánh sản phẩm này</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php echo form_open('cart/add', ['id' => 'product_addtocart_form']) ?>
                                    <input name="product_id" value="<?php echo $oneItem->id ?>" type="hidden">
                                    <input name="image"
                                           value="<?php echo getImageThumb($oneItem->thumbnail, 100, 100, true) ?>"
                                           type="hidden">
                                    <div class="price-block">
                                        <div class="price-box">
                                            <?php if ($this->session->userdata('is_agency') == true && !empty($oneItem->price_agency)): ?>
                                                <p class="special-price">
                                                    <span class="price-label">Giá đại lý:</span>
                                                    <span class="price"><?php echo formatMoney($oneItem->price_agency) ?></span>
                                                </p>
                                            <?php else: ?>
                                                <?php if (!empty($oneItem->price_sale)): ?>
                                                    <p class="special-price">
                                                        <span class="price-label">Giá khuyến mại:</span>
                                                        <span class="price"><?php echo formatMoney($oneItem->price_sale) ?></span>
                                                    </p>
                                                    <p class="old-price">
                                                        <span class="price-label">Giá gốc:</span>
                                                        <span class="price"><?php echo formatMoney($oneItem->price) ?></span>
                                                    </p>
                                                <?php else: ?>
                                                    <p class="special-price">
                                                        <span class="price-label">Giá:</span>
                                                        <span class="price"><?php echo formatMoney($oneItem->price) ?></span>
                                                    </p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <p class="availability in-stock pull-right">
                                                <?php echo $this->session->userdata('is_agency') == true ? '<span class="agency">Đại lý</span>' : '' ?>
                                                <?php echo !empty($data_stock[0]->Amount) ? '<span class="instock">Còn hàng</span>' : '<span class="outstock">Hết hàng</span>' ?>
                                            </p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="sold pull-left">Lượt xem:
                                                        <strong><?php echo $oneItem->viewed ?></strong> đã xem. </p>
                                                    <p class="sold pull-right">Đã bán
                                                        <strong><?php echo $oneItem->viewed > 1000 ? $oneItem->viewed - 555 : $oneItem->viewed - 333 ?></strong>
                                                        sản phẩm. </p>
                                                    <p class="sold clearfix">Tỷ lệ bảo hành: <strong> <5%</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="d-flex pricing-style1">
                                        <div class="col">
                                            <div class="pricing-plan">
                                                <div class="pricing-head">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape.svg"
                                                         class="shape" alt="">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape_hover.svg"
                                                         class="shape_hover" alt="">
                                                    <div class="name">đại lý</div>
                                                    <div class="price">
                                                        <span class="value">$99 / tháng</span>
                                                    </div>
                                                </div>
                                                <div class="pricing-body">
                                                    <p>Số lượng áp dụng từ 01~05</p>
                                                    <p>Miễn phí vận chuyển đơn hàng trên 2000000</p>
                                                    <p>Đơn hàng tối thiểu 200000</p>
                                                </div>
                                                <div class="pricing-footer">
                                                    <a href="#" class="p-button">GET PLAN</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="pricing-plan">
                                                <div class="pricing-head">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape.svg"
                                                         class="shape" alt="">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape_hover.svg"
                                                         class="shape_hover" alt="">
                                                    <div class="name">đại lý</div>
                                                    <div class="price">
                                                        <span class="value">$99 / tháng</span>
                                                    </div>
                                                </div>
                                                <div class="pricing-body">
                                                    <p>Số lượng áp dụng từ 01~05</p>
                                                    <p>Miễn phí vận chuyển đơn hàng trên 2000000</p>
                                                    <p>Đơn hàng tối thiểu 200000</p>
                                                </div>
                                                <div class="pricing-footer">
                                                    <a href="#" class="p-button">GET PLAN</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="pricing-plan">
                                                <div class="pricing-head">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape.svg"
                                                         class="shape" alt="">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape_hover.svg"
                                                         class="shape_hover" alt="">
                                                    <div class="name">đại lý</div>
                                                    <div class="price">
                                                        <span class="value">$99 / tháng</span>
                                                    </div>
                                                </div>
                                                <div class="pricing-body">
                                                    <p>Số lượng áp dụng từ 01~05</p>
                                                    <p>Miễn phí vận chuyển đơn hàng trên 2000000</p>
                                                    <p>Đơn hàng tối thiểu 200000</p>
                                                </div>
                                                <div class="pricing-footer">
                                                    <a href="#" class="p-button">GET PLAN</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="pricing-plan">
                                                <div class="pricing-head">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape.svg"
                                                         class="shape" alt="">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape_hover.svg"
                                                         class="shape_hover" alt="">
                                                    <div class="name">đại lý</div>
                                                    <div class="price">
                                                        <span class="value">$99 / tháng</span>
                                                    </div>
                                                </div>
                                                <div class="pricing-body">
                                                    <p>Số lượng áp dụng từ 01~05</p>
                                                    <p>Miễn phí vận chuyển đơn hàng trên 2000000</p>
                                                    <p>Đơn hàng tối thiểu 200000</p>
                                                </div>
                                                <div class="pricing-footer">
                                                    <a href="#" class="p-button">GET PLAN</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="pricing-plan">
                                                <div class="pricing-head">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape.svg"
                                                         class="shape" alt="">
                                                    <img src="<?php echo $this->templates_assets ?>images/shape_hover.svg"
                                                         class="shape_hover" alt="">
                                                    <div class="name">đại lý</div>
                                                    <div class="price">
                                                        <span class="value">$99 / tháng</span>
                                                    </div>
                                                </div>
                                                <div class="pricing-body">
                                                    <p>Số lượng áp dụng từ 01~05</p>
                                                    <p>Miễn phí vận chuyển đơn hàng trên 2000000</p>
                                                    <p>Đơn hàng tối thiểu 200000</p>
                                                </div>
                                                <div class="pricing-footer">
                                                    <a href="#" class="p-button">GET PLAN</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->


                                    <div style="    border-bottom: 1px #ddd dotted;">
                                        <aside class="onlinepromo">
                                            <b>Thông tin mô tả sản phẩm</b>
                                            <div class="infopr">
                                                <?php echo $oneItem->description ?>
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="add-to-box">
                                        <div class="add-to-cart" data-id="<?php echo $oneItem->id ?>">
                                            <div class="pull-left">
                                                <div class="custom pull-left">
                                                    <span class="qty-label">Số lượng:</span>
                                                    <button onClick="CART.quantity_reduced(this)" class="reduced items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>" type="button">
                                                        <i class="fa fa-minus">&nbsp;</i>
                                                    </button>
                                                    <input onkeyup="CART.changeInputQuantity(this)" type="text" class="input-text qty" title="Số lượng" value="1" maxlength="<?php echo $oneItem->quantity ?>" name="quantity">
                                                    <button onClick="CART.quantity_increase(this)" class="increase items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : ''
                                    ?>" type="button">
                                                        <i class="fa fa-plus">&nbsp;</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button class="button btn-cart" title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ</button>
                                        </div>
                                    </div>
                                    <?php echo form_close()
                                    ?>
                                    <div class="short-description">
                                        <h2>Lưu ý</h2>
                                        <p>Mức giá trên là dành cho cửa hàng. Chúng tôi sẽ có chính sách giá riêng dành cho đại lý linh kiện.
                                        Hân hạnh được hợp tác cùng quý Đại lý trên toàn quốc. Để xem được giá đại lý, quý khách vui lòng tạo tài khoản và gửi yêu cầu
                                        cấp quyền đại lý cho quý khách.</p>
                                    </div>


                                    <?php if (!empty($data_similar)): ?>
                                        <div class="buy-more">
                                            <div class="panel panel-danger">
                                                <div class="panel-heading panel-danger">
                                                    <h4 class="panel-title">Sản phẩm cùng loại khác màu</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <?php foreach ($data_similar as $item): ?>
                                                        <div class="add-to-box">
                                                            <div class="add-to-cart">
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-3">
                                                                        <img src="<?php echo getImageThumb($item->thumbnail, 75, 75, true) ?>"
                                                                             alt="<?php echo getTitle($item) ?>">
                                                                    </div>
                                                                    <div class="col-xs-9">
                                                                        <h2><a href="<?php echo getUrlProduct($item) ?>"
                                                                               title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
                                                                        </h2>
                                                                        <div class="custom pull-left">
                                                                            <button onClick="CART.quantity_reduced(this)"
                                                                                    class="reduced items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>"
                                                                                    type="button">
                                                                                <i class="fa fa-minus">&nbsp;</i>
                                                                            </button>
                                                                            <input onkeyup="CART.changeInputQuantity(this)"
                                                                                   type="text" class="input-text qty"
                                                                                   title="Số lượng" value="1"
                                                                                   maxlength="<?php echo $item->quantity ?>"
                                                                                   name="quantity">
                                                                            <button onClick="CART.quantity_increase(this)"
                                                                                    class="increase items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>"
                                                                                    type="button">
                                                                                <i class="fa fa-plus">&nbsp;</i>
                                                                            </button>
                                                                            <button onclick="CART.add_more(<?php echo $item->id ?>,this)"
                                                                                    class="button btn-cart pull-right"
                                                                                    title="Thêm vào giỏ hàng"
                                                                                    type="submit">Thêm vào giỏ
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <div class="showmore"><a class="btn btn-default btn-sm">Xem thêm
                                                            »</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div id="social-share"></div>
                                </div>
                                <div class="product-buy col-lg-3 col-sm-3 col-xs-12">
                                    <div class="info">
                                        <p>Thương hiệu: <strong><?php if (!empty($oneBrand)): ?><a
                                                    href="<?php echo getUrlBrand($oneBrand) ?>"
                                                    title="<?php echo getTitle($oneBrand) ?>"><?php echo $oneBrand->title ?></a> <?php endif; ?>
                                            </strong></p>
                                        <p>Mã sản phẩm: <strong><?php echo $oneItem->model ?></strong></p>
                                        <p>Mã vạch: <strong><?php echo (string)$oneItem->barcode ?></strong></p>
                                    </div>
                                    <div class="pstock-list">
                                        <?php if (!empty($data_stock)) foreach ($data_stock as $item): ?>
                                            <p class="pstock-item pstock-item-01 pstock-district-001"
                                               style="display: block;">
                                                <?php echo $item->StockName ?>
                                                - <?php echo $item->Amount > 0 ? '<span class="text-primary">Còn hàng ' . ($this->session->userdata('admin_group_id') == true ? "($item->Amount)" : "") . '</span>' : '<span class="text-danger">Hết hàng</span>' ?>
                                            </p>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php $this->load->view($this->template_path . 'product/_box_features') ?>
                                </div>
                            </div>
                            <?php if (!empty($data_related)): $totalItem = count($data_related) ?>
                                <div class="row clearfix accessories">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h2 class="panel-title">Linh kiện cùng đời máy</h2>
                                            </div>
                                            <div class="panel-body accessories-slider">
                                                <?php foreach ($data_related as $item): ?>
                                                    <div class="item add-to-cart">
                                                        <a href="<?php echo getUrlProduct($item) ?>"
                                                           title="<?php echo getTitle($item) ?>">
                                                            <img src="<?php echo getImageThumb($item->thumbnail, 100, 100) ?>"
                                                                 alt="<?php echo getTitle($item) ?>"
                                                                 class="img-thumbnail">
                                                            <h2><?php echo $item->title ?></h2>
                                                        </a>
                                                        <div class="custom pull-left">
                                                            <button onClick="CART.quantity_reduced(this)"
                                                                    class="reduced items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>"
                                                                    type="button">
                                                                <i class="fa fa-minus">&nbsp;</i>
                                                            </button>
                                                            <input autocomplete="disabled"
                                                                   onkeyup="CART.changeInputQuantity(this)" type="text"
                                                                   class="input-text qty" title="Số lượng" value="1"
                                                                   maxlength="<?php echo $item->quantity ?>"
                                                                   name="quantity">
                                                            <button onClick="CART.quantity_increase(this)"
                                                                    class="increase items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>"
                                                                    type="button">
                                                                <i class="fa fa-plus">&nbsp;</i>
                                                            </button>
                                                            <button onclick="CART.add_more(<?php echo $item->id ?>,this)"
                                                                    class="button btn-cart pull-right"
                                                                    title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row clearfix">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="product-collateral">
                                        <div class="add_info">
                                            <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                                                <li class="active"><a href="#product_tabs_description"
                                                                      data-toggle="tab">Đặc tính sản phẩm</a></li>
                                                <li><a href="#reviews_tabs" data-toggle="tab">Phản hồi đánh giá</a></li>
                                            </ul>
                                            <div id="productTabContent" class="tab-content">
                                                <div class="tab-pane fade in active" id="product_tabs_description">
                                                    <div class="std">
                                                        <?php echo $oneItem->content ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="reviews_tabs">
                                                    <div class="box-collateral box-reviews" id="customer-reviews">
                                                        <div class="box-reviews1">
                                                            <div class="form-add">
                                                                <?php echo form_open('product/ajax_vote', ['id' => 'review-form']) ?>
                                                                <input type="hidden" name="id"
                                                                       value="<?php echo $oneItem->id ?>">
                                                                <h3>Phản hồi của khách hàng về sản phẩm
                                                                    "<?php echo $oneItem->title ?>"</h3>
                                                                <fieldset>
                                                                    <h4>Bạn đánh giá sản phẩm này như thế nào ? <em
                                                                                class="required">*</em></h4>
                                                                    <div id="product-review-table">
                                                                        <div class="rateit"
                                                                             data-id="<?php echo $oneItem->id ?>"
                                                                             data-rateit-value="0"
                                                                             data-rateit-starwidth="16"
                                                                             data-rateit-starheight="16"
                                                                             data-rateit-min="0"
                                                                             data-rateit-max="5"></div>
                                                                        <input type="hidden" name="vote" value="5">
                                                                    </div>

                                                                    <div class="review1">
                                                                        <ul class="form-list">
                                                                            <?php if ($this->session->userdata('is_logged') == true): ?>
                                                                                <li>
                                                                                    <label class="required"
                                                                                           for="nickname_field">Tài
                                                                                        khoản</label>
                                                                                    <div class="input-box">
                                                                                        <input type="text"
                                                                                               class="input-text"
                                                                                               id="nickname_field"
                                                                                               name="username" disabled
                                                                                               value="<?php echo $this->_user_login->fullname ?>">
                                                                                    </div>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                            <li>
                                                                                <label class="required"
                                                                                       for="fullname_field">Tên<em>*</em></label>
                                                                                <div class="input-box">
                                                                                    <input type="text"
                                                                                           class="input-text"
                                                                                           id="fullname_field"
                                                                                           name="name">
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <label class="required "
                                                                                       for="review_field">Phản
                                                                                    hồi<em>*</em></label>
                                                                                <div class="input-box">
                                                                                <textarea rows="3" cols="5"
                                                                                          id="review_field"
                                                                                          name="message"></textarea>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="buttons-set">
                                                                            <?php if (GG_CAPTCHA_MODE == TRUE): ?>
                                                                                <div class="form-group m-form__group">
                                                                                    <div class="g-recaptcha"
                                                                                         data-sitekey="<?php echo GG_CAPTCHA_SITE_KEY ?>"></div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <button class="button submit"
                                                                                    title="Submit Review" type="submit">
                                                                                <span>Gửi đánh giá</span></button>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <?php echo form_close() ?>
                                                            </div>
                                                        </div>
                                                        <div class="box-reviews2">
                                                            <h3>Đánh giá bởi khách hàng</h3>
                                                            <div class="box visible">
                                                                <ul>
                                                                    <?php if (!empty($data_vote)) foreach ($data_vote as $k => $item): ?>
                                                                        <li class="<?php echo $k % 2 == 0 ? '' : 'even' ?>">
                                                                            <div class="review">
                                                                                <h6><a href="#">Excellent</a></h6>
                                                                                <div class="rating-box">
                                                                                    <div class="rating"
                                                                                         style="width:<?php echo round(($item->vote / 5) * 100) ?>%;"></div>
                                                                                </div>
                                                                                <small>
                                                                                    Đánh giá bởi
                                                                                    <span><?php echo $item->name ?> </span>
                                                                                    ngày <?php echo timeAgo($item->created_time, 'd/m/Y') ?>
                                                                                </small>
                                                                                <div class="review-txt">
                                                                                    <?php echo $item->message ?>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                            <!--<div class="actions">
                                                                <a class="button view-all" id="revies-button"
                                                                   href="#"><span><span>Xem thêm</span></span></a>
                                                            </div>-->
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="comments" data-id="<?php echo $oneItem->id ?>" class="comment-fr">
                                        <div class="cmt-head">
                                            <div class="table">
                                                <div class="cell">
                                                    <strong>Bình Luận</strong>
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
                                                           value="<?php echo $this->_user_login->fullname ?>"
                                                           class="form-control">
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
                                                <button type="submit" class="smooth send send_comment">Gửi bình luận
                                                </button>
                                            </div>
                                            <?php echo form_close() ?>
                                        <?php endif; ?>
                                    </div>

                                    <div>Tags: <?php echo getTags($oneItem->meta_keyword) ?></div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="product-collateral">
                                        <div class="add_info">
                                            <ul id="tab_infomation" class="nav nav-tabs product-tabs">
                                                <li class="active"><a href="#tab_warranty" data-toggle="tab">Thông tin
                                                        bảo hành </a></li>
                                                <li><a href="#tab_return" data-toggle="tab">Quy định đổi trả</a></li>
                                                <li><a href="#tab_bank" data-toggle="tab">Tài khoản ngân hàng</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="tab_warranty">
                                                    <div class="std">
                                                        <?php echo !empty($this->settings['block']['warranty']) ? $this->settings['block']['warranty'] : '' ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_return">
                                                    <div class="std">
                                                        <?php echo !empty($this->settings['block']['return']) ? $this->settings['block']['return'] : '' ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_bank">
                                                    <div class="std">
                                                        <?php echo !empty($this->settings['block']['bank']) ? $this->settings['block']['bank'] : '' ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Related Slider -->
                            <div class="related-pro">
                                <div class="slider-items-products">
                                    <div class="related-block">
                                        <div class="home-block-inner">
                                            <div class="block-title">
                                                <h2>Sản phẩm cùng thương hiệu</h2>
                                            </div>
                                        </div>
                                        <div id="related-products-slider" class="product-flexslider hidden-buttons">
                                            <div class="slider-items slider-width-col4 products-grid block-content">
                                                <?php $this->load->view($this->template_path . 'product/_list_product_slider', ['data' => $listProductBrand]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- End related products Slider -->

                            <!-- Upsell Product Slider -->
                            <div class="upsell-pro">
                                <div class="slider-items-products">
                                    <div class="upsell-block">
                                        <div class="home-block-inner">
                                            <div class="block-title">
                                                <h2>Sản phẩm đã xem</h2>
                                            </div>
                                        </div>
                                        <div id="upsell-products-slider" class="product-flexslider hidden-buttons">
                                            <div class="slider-items slider-width-col4 products-grid block-content">
                                                <?php $this->load->view($this->template_path . 'product/_list_product_slider', ['data' => $listProductViewed]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Upsell  Slider -->
                        </div>
                    </article>
                    <!--	/////======    End article  ========= //// -->
                </div>


            </div>
        </div>
    </section>
    <!-- Main Container End -->
    <script>
        var urlCurrentMenu = '<?php echo !empty($oneParent) ? getUrlCateProduct($oneParent) : '' ?>';
        var is_realtime_visitor = true;
    </script>
<?php endif; ?>