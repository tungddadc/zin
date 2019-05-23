<?php if (!empty($oneItem)):
    $url = getUrlProduct($oneItem);
    $album = !empty($oneItem->album) ? json_decode($oneItem->album) : [];
    array_push($album, $oneItem->thumbnail);
//    $arr = get_defined_vars();
//    dd($arr);
    ?>

    <section class="main-container col1-layout">
        <div class="container">
            <div class="row">
                <!-- Breadcrumbs -->
                <div class="col-xs-12">
                    <div class="breadcrumbs">
                        <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                    </div>
                </div>
                <!-- Breadcrumbs End -->

                <div id="ajax-quickview" class="product-essential">
                    <div class="product-img-box col-md-7 col-sm-6 col-xs-12">

                        <!-- end: more-images -->
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <?php if (!empty($data_related)): $totalItem = count($data_related) ?>
                                    <div class="row clearfix accessories">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h2 class="panel-title">Sản phẩm liên quan</h2>
                                            </div>
                                            <div class="panel-body accessories-slider">
                                                <?php foreach ($data_related as $item): ?>
                                                    <div class="item add-to-cart">
                                                        <a href="<?php echo getUrlProduct($item) ?>"
                                                           title="<?php echo getTitle($item) ?>">
                                                            <img src="<?php echo getImageThumb($item->thumbnail, 100, 100) ?>"
                                                                 alt="<?php echo getTitle($item) ?>" class="img-thumbnail">
                                                            <h2><?php echo $item->title ?></h2>
                                                        </a>
                                                        <div class="custom related-product-btn">
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
                                                                    class="button btn-cart"
                                                                    title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="agency">
                                    <div class="panel panel-info">
                                        <div class="panel-heading panel-info">
                                            <h4 class="panel-title">Chính sách đại lý</h4>
                                        </div>
                                        <div class="panel-body">
                                            <a href="<?php echo base_url('dieu-kien-va-chinh-sach-dai-ly.html') ?>"
                                               class="btn btn-warning btn-block"
                                               title="Điều kiện và chính sách đại lý">Điều kiện và chính sách
                                                </a>
                                            <a href="<?php echo base_url('gia-dai-ly-va-uu-dai.html') ?>"
                                               class="btn btn-warning btn-block"
                                               title="Giá đại lý và ưu đãi">Giá đại lý và ưu đãi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="product-shop col-md-5 col-sm-6 col-xs-12">
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
                        </div>

                        <?php echo form_open('cart/add', ['id' => 'product_addtocart_form']) ?>
                        <input name="product_id" value="<?php echo $oneItem->id ?>" type="hidden">
                        <input name="image" value="<?php echo getImageThumb($oneItem->thumbnail, 100, 100, true) ?>"
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
                            </div>
                        </div>
                        <ul class="desc-pr">
                            <li><?php echo $oneItem->description; ?></li>
                            <!--                            <li>--><?php //echo ;
                            ?><!--</li>-->
                        </ul>
                        <div class="add-to-box">
                            <div class="add-to-cart" data-id="<?php echo $oneItem->id ?>">
                                <div class="pull-left">
                                    <div class="custom pull-left">
                                        <span class="qty-label">Số lượng:</span>
                                        <button onClick="CART.quantity_reduced(this)"
                                                class="reduced items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>"
                                                type="button">
                                            <i class="fa fa-minus">&nbsp;</i>
                                        </button>
                                        <input onkeyup="CART.changeInputQuantity(this)" type="text"
                                               class="input-text qty" title="Số lượng" value="1"
                                               maxlength="<?php echo $oneItem->quantity ?>" name="quantity">
                                        <button onClick="CART.quantity_increase(this)"
                                                class="increase items-count <?php echo $this->session->userdata('is_agency') == true ? 'is-agency' : '' ?>"
                                                type="button">
                                            <i class="fa fa-plus">&nbsp;</i>
                                        </button>
                                    </div>
                                </div>
                                <button class="button btn-cart" title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                        <div id="social-share"></div>

                        <?php if (!empty($data_similar)): ?>
                            <div class="buy-more">
                                <div class="panel panel-info">
                                    <div class="panel-heading panel-info">
                                        <h4 class="panel-title">Sản phẩm cùng loại</h4>
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
                                                                        title="Thêm vào giỏ hàng" type="submit">Thêm vào
                                                                    giỏ
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="showmore"><a class="btn btn-default btn-sm">Xem thêm »</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
<!--                    <div class="product-buy col-lg-product-buy col-sm-3 col-xs-12">-->
<!--                        <div class="info">-->
<!--                            <p>Thương hiệu: <strong>--><?php //if (!empty($oneBrand)): ?><!--<a-->
<!--                                        href="--><?php //echo getUrlBrand($oneBrand) ?><!--"-->
<!--                                        title="--><?php //echo getTitle($oneBrand) ?><!--">--><?php //echo $oneBrand->title ?><!--</a> --><?php //endif; ?>
<!--                                </strong></p>-->
<!--                            <p>Mã sản phẩm: <strong>--><?php //echo $oneItem->model ?><!--</strong></p>-->
<!--                            <p>Mã vạch: <strong>--><?php //echo (string)$oneItem->barcode ?><!--</strong></p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="col-xs-12 col-md-8">
                        <div class="std">
                            <?php echo $oneItem->content ?>
                        </div>
                        <div class="list-tag">
                            <span>Tags: </span><?php echo getTags($oneItem->meta_keyword) ?>
                        </div>

<!--                        <div class="box-collateral box-reviews" id="customer-reviews">-->
<!--                            -->
<!--                        </div>-->
                        <ul id="product-detail-tab" class="nav nav-tabs product-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#comment" aria-controls="home" role="tab" data-toggle="tab">Bình luận</a>
                            </li>
                            <li role="presentation">
                                <a href="#review" aria-controls="profile" role="tab" data-toggle="tab">Đánh giá</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div id="productTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="comment">
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
                                    <?php if($this->session->userdata('is_logged')): ?>
                                        <?php echo form_open('product/ajax_save_comment',['class'=>'form-input form-comment']) ?>
                                        <input type="hidden" name="account_id" value="<?php echo $this->session->userdata('user_id') ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $oneItem->id ?>">
                                        <div class="clearfix">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Tên của bạn" value="<?php echo $this->_user_login->fullname ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="email" placeholder="Email" value="<?php echo $this->session->userdata('email') ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="content" placeholder="Mời bạn để lại bình luận" class="form-control"></textarea>
                                        </div>
                                        <div class="fr-photo"></div>
                                        <div class="fr-ctrl">
                                            <button type="submit" class="smooth send send_comment">Gửi bình luận</button>
                                        </div>
                                        <?php echo form_close() ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="review">
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
                                                     data-rateit-value="0"
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
                                                                       name="username" disabled value="<?php echo $this->_user_login->fullname ?>">
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
                                            <?php if(!empty($data_vote)) foreach ($data_vote as $k => $item): ?>
                                                <li class="<?php echo $k%2 == 0 ? '' : 'even'?>">
                                                    <div class="review">
                                                        <h6><a href="#">Excellent</a></h6>
                                                        <div class="rating-box">
                                                            <div class="rating" style="width:<?php echo round(($item->vote/5)*100) ?>%;"></div>
                                                        </div>
                                                        <small>
                                                            Đánh giá bởi <span><?php echo $item->name ?> </span> ngày <?php echo timeAgo($item->created_time,'d/m/Y') ?>
                                                        </small>
                                                        <div class="review-txt">
                                                            <?php echo $item->message ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-xs-12 col-md-4">
                        <?php
                        if (!empty($oneItem->post_related)) : $listId = json_decode($oneItem->post_related, true);
                            if (!empty($listId)) : $listPostRelated = getPostRelated($listId);
                                if (!empty($listPostRelated)) :
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
                                endif;
                            endif;
                        endif;
                        ?>

                        <div class="related-block">
                            <div class="home-block-inner">
                                <div class="block-title">
                                    <h2>So sánh sản phẩm tương          </h2>
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
            </div>
        </div>
    </section>

<?php endif; ?>
