<?php if (!empty($oneItem)):
    $url = getUrlProduct($oneItem);
    $album = !empty($oneItem->album) ? json_decode($oneItem->album) : null;
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
                                                 src="<?php echo getImageThumb($album[0], 375, 375, true) ?>"
                                                 data-zoom-image="<?php echo getImageThumb($album[0]) ?>"
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
                                                                   data-image="<?php echo getImageThumb($item, 375, 375, true) ?>"
                                                                   data-zoom-image="<?php echo getImageThumb($item) ?>"
                                                                   title="<?php echo getTitle($oneItem) ?>">
                                                                    <img id="product-zoom"
                                                                         src="<?php echo getImageThumb($item, 76, 76) ?>"
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
                                                    <a href="" class="btn btn-warning btn-block"
                                                       title="Điều kiện và chính sách đại lý">Điều kiện và chính sách
                                                        đại lý</a>
                                                    <a href="" class="btn btn-warning btn-block"
                                                       title="Giá đại lý và ưu đãi">Giá đại lý và ưu đãi</a>
                                                </div>
                                            </div>
                                        </div>
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
                                            <div style="width:<?php echo round(($oneItem->vote/5)*100) ?>%" class="rating"></div>
                                        </div>
                                        <p class="rating-links">
                                            <a href="<?php echo getUrlProduct($oneItem) ?>#reviews_tabs" rel="nofollow" title="Phản hồi về sản phẩm">
                                                <?php echo $oneItem->total_vote ?> lượt phản hồi về sản phẩm này</a>
                                        </p>
                                        <div class="email-addto-box">
                                            <ul class="add-to-links">
                                                <li><a class="link-wishlist" href="javascript:;"
                                                       title="Yêu thích sản phẩm này" rel="nofollow"><span>Yêu thích sản phẩm này</span></a>
                                                </li>
                                                <li><span class="separator">|</span> <a class="link-compare"
                                                                                        href="javascript:;"
                                                                                        title="So sánh sản phẩm này"
                                                                                        rel="nofollow"><span>So sánh sản phẩm này</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php echo form_open('cart/add', ['id' => 'product_addtocart_form']) ?>
                                    <input name="product_id" value="<?php echo $oneItem->id ?>" type="hidden">
                                    <input name="image" value="<?php echo getImageThumb($oneItem->thumbnail,100,100,true) ?>" type="hidden">
                                    <div class="price-block">
                                        <div class="price-box">
                                            <?php if($this->session->userdata('is_agency') == true && !empty($data_detail)): ?>
                                                <p class="special-price">
                                                    <span class="price-label">Giá đại lý:</span>
                                                    <span class="price"><?php echo formatMoney($data_detail[0]->price_agency) ?></span>
                                                </p>
                                            <?php else: ?>
                                                <?php if(!empty($oneItem->price_sale)): ?>
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
                                                <?php echo $this->session->userdata('is_agency') == true ? '<span class="agency">Đại lý</span>' : ''  ?>
                                                <?php echo $oneItem->quantity > 0 ? '<span>Còn hàng</span>' : '' ?>
                                            </p>
                                            <p class="sold">Đã bán <strong>90</strong> sản phẩm / tháng. </p>
                                            <p class="sold">Lượt xem: <strong><?php echo $oneItem->viewed ?></strong> đã xem. </p>
                                            <p class="sold">Tỷ lệ bảo hành: <strong> <5%</strong></p>
                                        </div>
                                    </div>
                                    <div class="add-to-box">
                                        <div class="add-to-cart" data-id="<?php echo $oneItem->id ?>">
                                            <div class="pull-left">
                                                <div class="custom pull-left">
                                                    <span class="qty-label">Số lượng:</span>
                                                    <button onClick="CART.quantity_reduced(this)" class="reduced items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : ''  ?>" type="button">
                                                        <i class="fa fa-minus">&nbsp;</i>
                                                    </button>
                                                    <input onkeyup="CART.changeInputQuantity(this)" type="text" class="input-text qty" title="Số lượng" value="1" maxlength="<?php echo $oneItem->quantity ?>" name="quantity">
                                                    <button onClick="CART.quantity_increase(this)" class="increase items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : ''  ?>" type="button">
                                                        <i class="fa fa-plus">&nbsp;</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button class="button btn-cart" title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ</button>
                                        </div>
                                    </div>
                                    <?php echo form_close() ?>
                                    <div class="buy-more">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading panel-danger">
                                                <h4 class="panel-title">Sản phẩm cùng loại khác màu</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="add-to-box">
                                                    <div class="add-to-cart">
                                                        <div class="pull-left">
                                                            <div class="custom pull-left"><span class="qty-label">Số lượng:</span>
                                                                <button onClick="let result = document.getElementById('quantity_1'); let qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;"
                                                                        class="reduced items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : ''  ?>" type="button"><i
                                                                            class="fa fa-minus">&nbsp;</i></button>
                                                                <input type="text" class="input-text qty" title="Qty"
                                                                       value="1"
                                                                       maxlength="12" id="quantity_1" name="qty">
                                                                <button onClick="let result = document.getElementById('quantity_1'); let qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                                                        class="increase items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : ''  ?>" type="button"><i
                                                                            class="fa fa-plus">&nbsp;</i></button>
                                                            </div>
                                                        </div>
                                                        <button class="button btn-cart pull-right"
                                                                title="Thêm vào giỏ hàng" type="submit">Thêm
                                                            vào giỏ
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="short-description">
                                        <h2>Khuyến mãi</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue
                                            nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi
                                            ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate
                                            adipiscing cursus eu, suscipit id nulla. Donec a neque libero. </p>
                                    </div>-->
                                    <div id="social-share"></div>
                                </div>
                                <div class="product-buy sticky_box col-lg-3 col-sm-3 col-xs-12">
                                    <div class="info">
                                        <p>Thương hiệu: <strong><?php if(!empty($oneBrand)): ?><a href="<?php echo getUrlBrand($oneBrand) ?>" title="<?php echo getTitle($oneBrand) ?>"><?php echo $oneBrand->title ?></a> <?php endif; ?></strong></p>
                                        <p>Mã sản phẩm: <strong><?php echo $oneItem->model ?></strong></p>
                                    </div>
                                    <?php $this->load->view($this->template_path . 'product/_box_features') ?>
                                </div>
                            </div>
                            <div class="row accessories">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Linh kiện cùng đời máy</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                            <div class="col-sm-3 col-xs-6 item"><a href="" title=""><img
                                                            src="<?php echo getImageThumb() ?>" alt=""
                                                            class="img-thumbnail"></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                                                <input type="hidden" name="id" value="<?php echo $oneItem->id ?>">
                                                                <h3>Phản hồi của khách hàng về sản phẩm
                                                                    "<?php echo $oneItem->title ?>"</h3>
                                                                <fieldset>
                                                                    <h4>Bạn đánh giá sản phẩm này như thế nào ? <em class="required">*</em></h4>
                                                                    <div id="product-review-table">
                                                                        <div class="rateit"
                                                                             data-id="<?php echo $oneItem->id ?>"
                                                                             data-rateit-value="<?php echo !empty($vote->avg) ? $vote->avg : 0 ?>"
                                                                             data-rateit-starwidth="16"
                                                                             data-rateit-starheight="16"
                                                                             data-rateit-min="0"
                                                                             data-rateit-max="5"></div>
                                                                        <input type="hidden" name="vote" value="5">
                                                                    </div>

                                                                    <div class="review1">
                                                                        <ul class="form-list">
                                                                            <?php if($this->session->userdata('is_logged') == true): ?>
                                                                            <li>
                                                                                <label class="required"
                                                                                       for="nickname_field">Tài khoản</label>
                                                                                <div class="input-box">
                                                                                    <input type="text"
                                                                                           class="input-text"
                                                                                           id="nickname_field"
                                                                                           name="username" disabled value="<?php echo $this->session->userdata('username') ?>">
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
                                                                                          name="content"></textarea>
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
                                                                    <?php  ?>
                                                                    <li>
                                                                        <div class="review">
                                                                            <h6><a href="#">Excellent</a></h6>
                                                                            <div class="rating-box">
                                                                                <div class="rating"
                                                                                     style="width:100%;"></div>
                                                                            </div>
                                                                            <small>Review by
                                                                                <span>Leslie Prichard </span>on
                                                                                1/3/2014
                                                                            </small>
                                                                            <div class="review-txt"> I have purchased
                                                                                shirts
                                                                                from Minimalism a few times and am never
                                                                                disappointed. The quality is excellent
                                                                                and the
                                                                                shipping is amazing. It seems like it's
                                                                                at your
                                                                                front door the minute you get off your
                                                                                pc. I
                                                                                have received my purchases within two
                                                                                days -
                                                                                amazing.
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="even">
                                                                        <div class="review">
                                                                            <h6>
                                                                                <a href="#/catalog/product/view/id/60/">Amazing</a>
                                                                            </h6>
                                                                            <div class="rating-box">
                                                                                <div class="rating"
                                                                                     style="width:100%;"></div>
                                                                            </div>
                                                                            <small>Review by <span>Sandra Parker</span>on
                                                                                1/3/2014
                                                                            </small>
                                                                            <div class="review-txt"> Minimalism is the
                                                                                online
                                                                                !
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="actions">
                                                                <a class="button view-all" id="revies-button"
                                                                   href="#"><span><span>Xem thêm</span></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                            fringilla augue nec est tristique auctor. Donec non est at
                                                            libero
                                                            vulputate rutrum. Morbi ornare lectus quis justo gravida
                                                            semper.
                                                            Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id
                                                            nulla.
                                                            Donec a neque libero. Pellentesque aliquet, sem eget laoreet
                                                            ultrices, ipsum metus feugiat sem, quis fermentum turpis
                                                            eros eget
                                                            velit. Donec ac tempus ante. Fusce ultricies massa massa.
                                                            Fusce
                                                            aliquam, purus eget sagittis vulputate, sapien libero
                                                            hendrerit est,
                                                            sed commodo augue nisi non neque. Lorem ipsum dolor sit
                                                            amet,
                                                            consectetur adipiscing elit. Sed tempor, lorem et placerat
                                                            vestibulum, metus nisi posuere nisl, in accumsan elit odio
                                                            quis mi.
                                                            Cras neque metus, consequat et blandit et, luctus a nunc.
                                                            Etiam
                                                            gravida vehicula tellus, in imperdiet ligula euismod eget.
                                                            Pellentesque habitant morbi tristique senectus et netus et
                                                            malesuada
                                                            fames ac turpis egestas. Nam erat mi, rutrum at sollicitudin
                                                            rhoncus, ultricies posuere erat. Duis convallis, arcu nec
                                                            aliquam
                                                            consequat, purus felis vehicula felis, a dapibus enim lorem
                                                            nec
                                                            augue.</p>
                                                        <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum,
                                                            gravida et
                                                            mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum
                                                            ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere
                                                            cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing
                                                            nisl ut dolor dignissim semper. Nulla luctus malesuada
                                                            tincidunt.
                                                            Class aptent taciti sociosqu ad litora torquent per conubia
                                                            nostra,
                                                            per inceptos himenaeos. Integer enim purus, posuere at
                                                            ultricies eu,
                                                            placerat a felis. Suspendisse aliquet urna pretium eros
                                                            convallis
                                                            interdum. Quisque in arcu id dui vulputate mollis eget non
                                                            arcu.
                                                            Aenean et nulla purus. Mauris vel tellus non nunc mattis
                                                            lobortis.</p>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_return">
                                                    <div class="std">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                            fringilla augue nec est tristique auctor. Donec non est at
                                                            libero
                                                            vulputate rutrum. Morbi ornare lectus quis justo gravida
                                                            semper.
                                                            Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id
                                                            nulla.
                                                            Donec a neque libero. Pellentesque aliquet, sem eget laoreet
                                                            ultrices, ipsum metus feugiat sem, quis fermentum turpis
                                                            eros eget
                                                            velit. Donec ac tempus ante. Fusce ultricies massa massa.
                                                            Fusce
                                                            aliquam, purus eget sagittis vulputate, sapien libero
                                                            hendrerit est,
                                                            sed commodo augue nisi non neque. Lorem ipsum dolor sit
                                                            amet,
                                                            consectetur adipiscing elit. Sed tempor, lorem et placerat
                                                            vestibulum, metus nisi posuere nisl, in accumsan elit odio
                                                            quis mi.
                                                            Cras neque metus, consequat et blandit et, luctus a nunc.
                                                            Etiam
                                                            gravida vehicula tellus, in imperdiet ligula euismod eget.
                                                            Pellentesque habitant morbi tristique senectus et netus et
                                                            malesuada
                                                            fames ac turpis egestas. Nam erat mi, rutrum at sollicitudin
                                                            rhoncus, ultricies posuere erat. Duis convallis, arcu nec
                                                            aliquam
                                                            consequat, purus felis vehicula felis, a dapibus enim lorem
                                                            nec
                                                            augue.</p>
                                                        <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum,
                                                            gravida et
                                                            mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum
                                                            ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere
                                                            cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing
                                                            nisl ut dolor dignissim semper. Nulla luctus malesuada
                                                            tincidunt.
                                                            Class aptent taciti sociosqu ad litora torquent per conubia
                                                            nostra,
                                                            per inceptos himenaeos. Integer enim purus, posuere at
                                                            ultricies eu,
                                                            placerat a felis. Suspendisse aliquet urna pretium eros
                                                            convallis
                                                            interdum. Quisque in arcu id dui vulputate mollis eget non
                                                            arcu.
                                                            Aenean et nulla purus. Mauris vel tellus non nunc mattis
                                                            lobortis.</p>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_bank">
                                                    <div class="std">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                            fringilla augue nec est tristique auctor. Donec non est at
                                                            libero
                                                            vulputate rutrum. Morbi ornare lectus quis justo gravida
                                                            semper.
                                                            Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id
                                                            nulla.
                                                            Donec a neque libero. Pellentesque aliquet, sem eget laoreet
                                                            ultrices, ipsum metus feugiat sem, quis fermentum turpis
                                                            eros eget
                                                            velit. Donec ac tempus ante. Fusce ultricies massa massa.
                                                            Fusce
                                                            aliquam, purus eget sagittis vulputate, sapien libero
                                                            hendrerit est,
                                                            sed commodo augue nisi non neque. Lorem ipsum dolor sit
                                                            amet,
                                                            consectetur adipiscing elit. Sed tempor, lorem et placerat
                                                            vestibulum, metus nisi posuere nisl, in accumsan elit odio
                                                            quis mi.
                                                            Cras neque metus, consequat et blandit et, luctus a nunc.
                                                            Etiam
                                                            gravida vehicula tellus, in imperdiet ligula euismod eget.
                                                            Pellentesque habitant morbi tristique senectus et netus et
                                                            malesuada
                                                            fames ac turpis egestas. Nam erat mi, rutrum at sollicitudin
                                                            rhoncus, ultricies posuere erat. Duis convallis, arcu nec
                                                            aliquam
                                                            consequat, purus felis vehicula felis, a dapibus enim lorem
                                                            nec
                                                            augue.</p>
                                                        <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum,
                                                            gravida et
                                                            mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum
                                                            ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere
                                                            cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing
                                                            nisl ut dolor dignissim semper. Nulla luctus malesuada
                                                            tincidunt.
                                                            Class aptent taciti sociosqu ad litora torquent per conubia
                                                            nostra,
                                                            per inceptos himenaeos. Integer enim purus, posuere at
                                                            ultricies eu,
                                                            placerat a felis. Suspendisse aliquet urna pretium eros
                                                            convallis
                                                            interdum. Quisque in arcu id dui vulputate mollis eget non
                                                            arcu.
                                                            Aenean et nulla purus. Mauris vel tellus non nunc mattis
                                                            lobortis.</p>
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
                    <!--	///*///======    End article  ========= //*/// -->
                </div>


            </div>
        </div>
    </section>
    <!-- Main Container End -->
<?php endif; ?>

