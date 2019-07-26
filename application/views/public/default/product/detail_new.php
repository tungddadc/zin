
<?php
if (!empty($oneItem)):
    $url = getUrlProduct($oneItem);
    $album = !empty($oneItem->album) ? json_decode($oneItem->album) : [];
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

                    <div class="col-md-8 col-sm-7 col-xs-12">
                        <div class="row">
                            <div class="hidden-xs col-md-2" style="padding-right: 0">
                                <div class="slider-nav">
                                    <?php if (!empty($album)) foreach ($album as $item): ?>
                                        <div>
                                            <img width="100%" class="img-responsive" src="<?php echo getImageThumb($item, 140,88,true) ?>" alt="<?php echo getTitle($oneItem) ?>">
                                        </div>
                                    <?php endforeach ?>
                                </div>

                            </div>
                            <div class="col-xs-12 col-md-10" style="padding-left: 0">
                                <div class="slider-for">
                                    <?php if (!empty($album)) foreach ($album as $item): ?>
                                        <div>
                                            <img style="padding-left: 7px;margin: 0;width: 100%" class="img-responsive" src="<?php echo getImageThumb($item, 768,482, false) ?>" alt="<?php echo getTitle($oneItem) ?>">
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="product-box-right">
                            <div class="product-name">
                                <h1><?php echo $oneItem->title ?></h1>
                            </div>
                            <?php echo form_open('cart/add', ['id' => 'product_addtocart_form']) ?>
                            <input name="product_id" value="<?php echo $oneItem->id ?>" type="hidden">
                            <input name="image" value="<?php echo getImageThumb($oneItem->thumbnail, 100, 100, true) ?>"
                                   type="hidden">
                            <div class="wqp">
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
                            </div>

                            <?php if (!empty($endow) && in_array("",$endow) == FALSE) : ?>
                                <div class="special-promotion">
                                    <h2>Khuyến mại đặc biệt (Số lượng có hạn)</h2>
                                    <ul class="special-promotion-text">
                                        <?php foreach ($endow as $item) : ?>
                                            <li>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span><?php echo $item; ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="add-to-box clear-after">
                                <div class="add-to-cart clear-after" data-id="<?php echo $oneItem->id ?>">
                                    <div class="custom pull-left">
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
                                    <button class="button btn-cart" title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                            <div id="social-share"></div>
                            <?php if (!empty($feature)) : ?>
                                <div class="feature-widget widget">
                                    <h2>Đặc điểm nổi bật</h2>
                                    <ul class="special-promotion-text">
                                        <?php foreach ($feature as $item) : ?>
                                            <li>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span><?php echo $item->title; ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <ul id="product-detail-tab" class="nav nav-tabs product-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#content" aria-controls="profile" role="tab" data-toggle="tab">Giới thiệu</a>
                            </li>
                            <li role="presentation">
                                <a href="#specifications" aria-controls="profile" role="tab" data-toggle="tab">Thông số kỹ thuật</a>
                            </li>
                            <li role="presentation">
                                <a href="#comment" aria-controls="home" role="tab" data-toggle="tab">Bình luận</a>
                            </li>
                            <li role="presentation">
                                <a href="#accessories-product" aria-controls="profile" role="tab" data-toggle="tab">Sản phẩm liên quan</a>
                            </li>

                        </ul>
                        <div id="productTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="content">
                                <div class="std">
                                    <?php echo $oneItem->content ?>
                                </div>
                                <div class="list-tag">
                                    <span>Tags: </span><?php echo getTags($oneItem->meta_keyword) ?>
                                </div>
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
                                                <ul class="form-list clear-after">
                                                    <?php if($this->session->userdata('is_logged') == true): ?>
                                                        <li class="form-review-nickname">
                                                            <label class="required"
                                                                   for="nickname_field">Tài khoản</label>
                                                            <div class="input-box">
                                                                <input type="text"
                                                                       class="input-text form-control"
                                                                       id="nickname_field"
                                                                       name="username" disabled value="<?php echo $this->_user_login->fullname ?>">
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li class="form-review-name">
                                                        <label class="required"
                                                               for="fullname_field">Tên<em>*</em></label>
                                                        <div class="input-box">
                                                            <input type="text"
                                                                   class="input-text form-control"
                                                                   id="fullname_field"
                                                                   name="name">
                                                        </div>
                                                    </li>
                                                    <li class="form-review-message">
                                                        <label class="required "
                                                               for="review_field">Phản
                                                            hồi<em>*</em></label>
                                                        <div class="input-box">
                                                                                <textarea rows="3" cols="5"
                                                                                          id="review_field"
                                                                                          class="form-control"
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
                            <div role="tabpanel" class="tab-pane" id="specifications">
                                <?php echo $oneItem->specifications; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="comment">
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
                            <div role="tabpanel" class="tab-pane" id="accessories-product">
                                <div class="accessories-box">
                                    <?php if (!empty($data_related)): $totalItem = count($data_related) ?>
                                        <div class="accessories-slider">
                                            <?php foreach ($data_related as $item): ?>
                                                <div class="item add-to-cart clear-after">
                                                    <div class="accessories-left">
                                                        <a href="<?php echo getUrlProduct($item) ?>"
                                                           title="<?php echo getTitle($item) ?>">
                                                            <img src="<?php echo getImageThumb($item->thumbnail, 100, 100) ?>"
                                                                 alt="<?php echo getTitle($item) ?>" class="img-thumbnail">
                                                        </a>
                                                    </div>
                                                    <div class="accessories-right">
                                                        <h2>
                                                            <a href="<?php echo getUrlProduct($item) ?>"
                                                               title="<?php echo getTitle($item) ?>">
                                                                <?php echo $item->title ?>
                                                            </a>
                                                        </h2>
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


                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">

                        <?php if (!empty($data_similar)): ?>
                            <div class="buy-more">
                                <div class="panel panel-green border-radius-none">
                                    <div class="panel-heading panel-green">
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
                                                            <div class="custom buy-more-btn">
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
                                                                        class="button btn-cart"
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

                        <?php
                        if (!empty($oneItem->post_related)) : $listId = json_decode($oneItem->post_related, true);
                            if (!empty($listId)) : $listPostRelated = getPostRelated($listId);
                                if (!empty($listPostRelated)) :
                                    ?>
                                    <div class="post_related widget">
                                        <h2>Tin tức liên quan</h2>
                                        <?php foreach ($listPostRelated as $item): ?>
                                            <div class="item clear-after">
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
                    </div>

                </div>

                <div class="col-xs-12">
                    <div class="product-related widget">
                        <h2>So sánh sản phẩm tương  đương</h2>
                        <div id="related-products-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col4 products-grid block-content">
                                <?php $this->load->view($this->template_path . 'product/_list_product_slider', ['data' => $listProductBrand]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $this->load->view($this->template_path . 'page/page_home_review_company'); ?>

