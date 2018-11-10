<?php if(!empty($oneItem)):
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
                            <div class="product-essential">
                                <?php echo form_open('',['id' => 'product_addtocart_form']) ?>
                                    <input name="id" value="<?php echo $oneItem->id ?>" type="hidden">
                                    <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                                        <?php echo !empty($oneItem->is_new) ? '<div class="new-label new-top-left"> New </div>' : '' ?>
                                        <div class="product-image">
                                            <div class="product-full">
                                                <img id="product-zoom" src="<?php echo getImageThumb($album[0],375,375, true) ?>" data-zoom-image="<?php echo getImageThumb($album[0]) ?>" alt="<?php echo getTitle($oneItem) ?>"/>
                                            </div>
                                            <div class="more-views">
                                                <div class="slider-items-products">
                                                    <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                                                        <div class="slider-items slider-width-col4 block-content">
                                                            <?php if(!empty($album)) foreach ($album as $item): ?>
                                                                <div class="more-views-items">
                                                                    <a href="javascript:;" data-image="<?php echo getImageThumb($item,375,375, true) ?>" data-zoom-image="<?php echo getImageThumb($item) ?>" title="<?php echo getTitle($oneItem) ?>">
                                                                        <img id="product-zoom"  src="<?php echo getImageThumb($item,76,76) ?>" alt="<?php echo getTitle($oneItem) ?>"/>
                                                                    </a>
                                                                </div>
                                                            <?php endforeach ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end: more-images -->
                                    </div>
                                    <div class="product-shop col-lg-5 col-sm-5 col-xs-12">
                                        <div class="product-next-prev">
                                            <?php if(!empty($oneNext)): ?>
                                                <a class="product-next" href="<?php echo getUrlProduct($oneNext) ?>" title="<?php echo getTitle($oneNext) ?>"><span></span></a>
                                            <?php endif; ?>
                                            <?php if(!empty($onePrev)): ?>
                                                <a class="product-prev" href="<?php echo getUrlProduct($onePrev) ?>" title="<?php echo getTitle($onePrev) ?>"><span></span></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-name">
                                            <h1><?php echo $oneItem->title ?></h1>
                                        </div>
                                        <div class="ratings">
                                            <div class="rating-box">
                                                <div style="width:60%" class="rating"></div>
                                            </div>
                                            <p class="rating-links">
                                                <a href="#">1 lượt phản hồi về sản phẩm này</a>
                                            </p>
                                            <div class="email-addto-box">
                                                <ul class="add-to-links">
                                                    <li> <a class="link-wishlist" href="javascript:;" title="Yêu thích sản phẩm này" rel="nofollow"><span>Yêu thích sản phẩm này</span></a></li>
                                                    <li><span class="separator">|</span> <a class="link-compare" href="javascript:;" title="So sánh sản phẩm này" rel="nofollow"><span>So sánh sản phẩm này</span></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="price-block">
                                            <div class="price-box">
                                                <p class="special-price"> <span class="price-label">Giá khuyến mại</span> <span id="product-price-48" class="price"> 99.000 đ </span> </p>
                                                <p class="old-price"> <span class="price-label">Giá gốc:</span> <span class="price"> 130.000 đ </span> </p>
                                                <p class="availability in-stock pull-right"><span>Còn hàng</span></p>
                                                <p class="sold">Đã có <strong>0</strong> sản phẩm bán ra trong tháng này</p>
                                            </div>
                                        </div>
                                        <div class="add-to-box">
                                            <div class="add-to-cart">
                                                <div class="pull-left">
                                                    <div class="custom pull-left"> <span class="qty-label">Số lượng:</span>
                                                        <button onClick="let result = document.getElementById('qty'); let qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                                                        <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                                                        <button onClick="let result = document.getElementById('qty'); let qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                                                    </div>
                                                </div>
                                                <button class="button btn-cart" title="Thêm vào giỏ hàng" type="submit">Thêm vào giỏ</button>
                                            </div>

                                        </div>
                                        <div class="short-description">
                                            <h2>Khuyến mãi</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. </p>
                                        </div>
                                        <div id="social-share"></div>
                                    </div>
                                <div class="product-buy col-lg-3 col-sm-2 col-xs-12">
                                    <div>
                                        <h3>Hãng: Apple</h3>
                                        <h3>Mã sản phẩm: ZIN111</h3>
                                    </div>
                                    <?php $this->load->view($this->template_path . 'product/_box_features') ?>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                            <div class="product-collateral">
                                <div class="add_info">
                                    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                                        <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
                                        <li><a href="#product_tabs_tags" data-toggle="tab">Tags</a></li>
                                        <li> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                                        <li> <a href="#product_tabs_custom" data-toggle="tab">Custom Tab</a> </li>
                                        <li> <a href="#product_tabs_custom1" data-toggle="tab">Custom Tab1</a> </li>
                                    </ul>
                                    <div id="productTabContent" class="tab-content">
                                        <div class="tab-pane fade in active" id="product_tabs_description">
                                            <div class="std">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam erat mi, rutrum at sollicitudin rhoncus, ultricies posuere erat. Duis convallis, arcu nec aliquam consequat, purus felis vehicula felis, a dapibus enim lorem nec augue.</p>
                                                <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum. Quisque in arcu id dui vulputate mollis eget non arcu. Aenean et nulla purus. Mauris vel tellus non nunc mattis lobortis.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product_tabs_tags">
                                            <div class="box-collateral box-tags">
                                                <div class="tags">
                                                    <form id="addTagForm" action="#" method="get">
                                                        <div class="form-add-tags">
                                                            <label for="productTagName">Add Tags:</label>
                                                            <div class="input-box">
                                                                <input class="input-text" name="productTagName" id="productTagName" type="text">
                                                                <button type="button" title="Add Tags" class=" button btn-add" onClick="submitTagForm()"> <span>Add Tags</span> </button>
                                                            </div>
                                                            <!--input-box-->
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--tags-->
                                                <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="reviews_tabs">
                                            <div class="box-collateral box-reviews" id="customer-reviews">
                                                <div class="box-reviews1">
                                                    <div class="form-add">
                                                        <form id="review-form" method="post" action="http://www.magikcommerce.com/review/product/post/id/176/">
                                                            <h3>Write Your Own Review</h3>
                                                            <fieldset>
                                                                <h4>How do you rate this product? <em class="required">*</em></h4>
                                                                <span id="input-message-box"></span>
                                                                <div class="rateit" data-id="<?php echo $oneItem->id ?>" data-rateit-value="<?php echo !empty($vote->avg) ? $vote->avg : 0 ?>" data-rateit-starwidth="16" data-rateit-starheight="16" data-rateit-min="0" data-rateit-max="10"></div>
                                                                <input type="hidden" value="" class="validate-rating" name="validate_rating">
                                                                <div class="review1">
                                                                    <ul class="form-list">
                                                                        <li>
                                                                            <label class="required" for="nickname_field">Nickname<em>*</em></label>
                                                                            <div class="input-box">
                                                                                <input type="text" class="input-text" id="nickname_field" name="nickname">
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <label class="required" for="summary_field">Summary<em>*</em></label>
                                                                            <div class="input-box">
                                                                                <input type="text" class="input-text" id="summary_field" name="title">
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="review2">
                                                                    <ul>
                                                                        <li>
                                                                            <label class="required " for="review_field">Review<em>*</em></label>
                                                                            <div class="input-box">
                                                                                <textarea rows="3" cols="5" id="review_field" name="detail"></textarea>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="buttons-set">
                                                                        <button class="button submit" title="Submit Review" type="submit"><span>Submit Review</span></button>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="box-reviews2">
                                                    <h3>Customer Reviews</h3>
                                                    <div class="box visible">
                                                        <ul>
                                                            <li>
                                                                <table class="ratings-table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>Value</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Quality</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Price</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="review">
                                                                    <h6><a href="#">Excellent</a></h6>
                                                                    <small>Review by <span>Leslie Prichard </span>on 1/3/2014 </small>
                                                                    <div class="review-txt"> I have purchased shirts from Minimalism a few times and am never disappointed. The quality is excellent and the shipping is amazing. It seems like it's at your front door the minute you get off your pc. I have received my purchases within two days - amazing.</div>
                                                                </div>
                                                            </li>
                                                            <li class="even">
                                                                <table class="ratings-table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>Value</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Quality</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Price</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:80%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="review">
                                                                    <h6><a href="#/catalog/product/view/id/60/">Amazing</a></h6>
                                                                    <small>Review by <span>Sandra Parker</span>on 1/3/2014 </small>
                                                                    <div class="review-txt"> Minimalism is the online ! </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <table class="ratings-table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>Value</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Quality</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Price</th>
                                                                        <td><div class="rating-box">
                                                                                <div class="rating" style="width:80%;"></div>
                                                                            </div></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="review">
                                                                    <h6><a href="#/catalog/product/view/id/59/">Nicely</a></h6>
                                                                    <small>Review by <span>Anthony  Lewis</span>on 1/3/2014 </small>
                                                                    <div class="review-txt last"> Unbeatable service and selection. This store has the best business model I have seen on the net. They are true to their word, and go the extra mile for their customers. I felt like a purchasing partner more than a customer. You have a lifetime client in me. </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product_tabs_custom">
                                            <div class="product-tabs-content-inner clearfix">
                                                <p><strong>Lorem Ipsum</strong><span>&nbsp;is
                          simply dummy text of the printing and typesetting industry. Lorem Ipsum
                          has been the industry's standard dummy text ever since the 1500s, when 
                          an unknown printer took a galley of type and scrambled it to make a type
                          specimen book. It has survived not only five centuries, but also the 
                          leap into electronic typesetting, remaining essentially unchanged. It 
                          was popularised in the 1960s with the release of Letraset sheets 
                          containing Lorem Ipsum passages, and more recently with desktop 
                          publishing software like Aldus PageMaker including versions of Lorem 
                          Ipsum.</span></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product_tabs_custom1">
                                            <div class="product-tabs-content-inner clearfix">
                                                <p> <strong> Comfortable </strong><span>&nbsp;preshrunk shirts. Highest Quality Printing.  6.1 oz. 100% preshrunk heavyweight cotton Shoulder-to-shoulder taping Double-needle sleeves and bottom hem     
                          
                          Lorem Ipsumis
                          simply dummy text of the printing and typesetting industry. Lorem Ipsum
                          has been the industry's standard dummy text ever since the 1500s, when 
                          an unknown printer took a galley of type and scrambled it to make a type
                          specimen book. It has survived not only five centuries, but also the 
                          leap into electronic typesetting, remaining essentially unchanged. It 
                          was popularised in the 1960s with the release of Letraset sheets 
                          containing Lorem Ipsum passages, and more recently with desktop 
                          publishing software like Aldus PageMaker including versions of Lorem 
                          Ipsum.</span></p>
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
                                                <h2>Related Products</h2>
                                            </div>
                                        </div>
                                        <div id="related-products-slider" class="product-flexslider hidden-buttons">
                                            <div class="slider-items slider-width-col4 products-grid block-content">
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product1.jpg"> </a>
                                                                <div class="new-label new-top-right">new</div>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="rating">
                                                                    <div class="ratings">
                                                                        <div class="rating-box">
                                                                            <div style="width:80%" class="rating"></div>
                                                                        </div>
                                                                        <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                    </div>
                                                                </div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo getImageThumb($item) ?>"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$235.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->

                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product3.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$325.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->

                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product4.jpg"> </a>
                                                                <div class="new-label new-top-left">new</div>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$425.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product5.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$525.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product6.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$225.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product7.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$185.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->

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
                                                <h2>Upsell Product</h2>
                                            </div>
                                        </div>
                                        <div id="upsell-products-slider" class="product-flexslider hidden-buttons">
                                            <div class="slider-items slider-width-col4 products-grid block-content">
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product10.jpg"> </a>
                                                                <div class="new-label new-top-right">new</div>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="rating">
                                                                    <div class="ratings">
                                                                        <div class="rating-box">
                                                                            <div style="width:80%" class="rating"></div>
                                                                        </div>
                                                                        <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                    </div>
                                                                </div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$245.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product11.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$155.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->

                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product12.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$185.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->

                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product13.jpg"> </a>
                                                                <div class="new-label new-top-left">new</div>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$235.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product14.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$225.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product16.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$335.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Item -->
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="<?php echo $this->templates_assets ?>products-images/product10.jpg"> </a>
                                                                <div class="box-hover">
                                                                    <ul class="add-to-links">
                                                                        <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                                        <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                                        <li><a class="link-compare" href="compare.html"></a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                <div style="width:80%" class="rating"></div>
                                                                            </div>
                                                                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                                                                    </div>
                                                                    <div class="action">
                                                                        <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item -->

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

