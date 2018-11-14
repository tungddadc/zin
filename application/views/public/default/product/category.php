<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 16/03/2018
 * Time: 5:26 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($oneItem)): ?>
    <section class="main-container col2-left-layout">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-sm-push-3">
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs">
                        <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                    </div>
                    <!-- Breadcrumbs End -->
                    <div class="page-title">
                        <h2 class="page-heading"><span class="page-heading-title"><?php echo $oneItem->title ?></span>
                        </h2>
                    </div>
                    <div class="category-description std">
                        <div class="slider-items-products">
                            <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col1 owl-carousel owl-theme">
                                    <?php if (!empty($oneItem->banner)) foreach (json_decode($oneItem->banner) as $item): ?>
                                        <!-- Item -->
                                        <div class="item">
                                            <a href="javascript:;" title="<?php echo getTitle($oneItem) ?>">
                                                <img alt="<?php echo getTitle($oneItem) ?>"
                                                     src="<?php echo getImageThumb($item, 850, 200) ?>">
                                            </a>
                                        </div>
                                        <!-- End Item -->
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article id="content_ajax" class="col-main">
                        <?php echo form_open('') ?>
                        <div class="toolbar">
                            <div class="display-product-option">
                                <?php if (!empty($pagination)): ?>
                                    <div class="pages">
                                        <label>Trang:</label>
                                        <?php echo $pagination ?>
                                    </div>
                                <?php endif; ?>
                                <div class="product-option-right">
                                    <div id="sort-by" class="filter">
                                        <label class="left">Sắp xếp: </label>
                                        <select name="filter_sort" title="Sắp xếp">
                                            <option value="newest" <?php echo $this->input->get('filter_sort') === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                                            <option value="oldest" <?php echo $this->input->get('filter_sort') === 'oldest' ? 'selected' : '' ?>>Cũ nhất</option>
                                            <option value="highest" <?php echo $this->input->get('filter_sort') === 'highest' ? 'selected' : '' ?>>Giá cao nhất</option>
                                            <option value="lowest" <?php echo $this->input->get('filter_sort') === 'lowest' ? 'selected' : '' ?>>Giá thấp nhất</option>
                                        </select>
                                    </div>
                                    <div class="pager">
                                        <div id="limiter" class="filter">
                                            <label>Xem: </label>
                                            <select name="filter_limit" title="Số sản phẩm">
                                                <option value="12" <?php echo $this->input->get('filter_limit') === '12' ? 'selected' : '' ?>>12</option>
                                                <option value="24" <?php echo $this->input->get('filter_limit') === '24' ? 'selected' : '' ?>>24</option>
                                                <option value="36" <?php echo $this->input->get('filter_limit') === '36' ? 'selected' : '' ?>>36</option>
                                                <option value="48" <?php echo $this->input->get('filter_limit') === '48' ? 'selected' : '' ?>>48</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                        <div class="category-products">
                            <?php $this->load->view($this->template_path . 'product/_list_product', ['data' => $data]) ?>
                        </div>
                        <?php echo form_open('') ?>
                        <div class="toolbar">
                            <div class="display-product-option">
                                <?php if (!empty($pagination)): ?>
                                    <div class="pages">
                                        <label>Trang:</label>
                                        <?php echo $pagination ?>
                                    </div>
                                <?php endif; ?>
                                <div class="product-option-right">
                                    <div id="sort-by" class="filter">
                                        <label class="left">Sắp xếp: </label>
                                        <select name="filter_sort" title="Sắp xếp">
                                            <option value="newest" <?php echo $this->input->get('filter_sort') === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                                            <option value="oldest" <?php echo $this->input->get('filter_sort') === 'oldest' ? 'selected' : '' ?>>Cũ nhất</option>
                                            <option value="highest" <?php echo $this->input->get('filter_sort') === 'highest' ? 'selected' : '' ?>>Giá cao nhất</option>
                                            <option value="lowest" <?php echo $this->input->get('filter_sort') === 'lowest' ? 'selected' : '' ?>>Giá thấp nhất</option>
                                        </select>
                                    </div>
                                    <div class="pager">
                                        <div id="limiter" class="filter">
                                            <label>Xem: </label>
                                            <select name="filter_limit" title="Số sản phẩm">
                                                <option value="12" <?php echo $this->input->get('filter_limit') === '12' ? 'selected' : '' ?>>12</option>
                                                <option value="24" <?php echo $this->input->get('filter_limit') === '24' ? 'selected' : '' ?>>24</option>
                                                <option value="36" <?php echo $this->input->get('filter_limit') === '36' ? 'selected' : '' ?>>36</option>
                                                <option value="48" <?php echo $this->input->get('filter_limit') === '48' ? 'selected' : '' ?>>48</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </article>
                </div>
                <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                    <div class="side-banner"><img src="<?php echo $this->templates_assets ?>images/side-banner.jpg"
                                                  alt="banner"></div>
                    <div class="block block-layered-nav">
                        <div class="block-title">Shop By</div>
                        <div class="block-content">
                            <p class="block-subtitle">Shopping Options</p>
                            <dl id="narrow-by-list">
                                <dt class="odd">Price</dt>
                                <dd class="odd">
                                    <ol>
                                        <li><a href="#"><span class="price">$0.00</span> - <span
                                                        class="price">$99.99</span></a> (6)
                                        </li>
                                        <li><a href="#"><span class="price">$100.00</span> and above</a> (6)</li>
                                    </ol>
                                </dd>
                                <dt class="even">Manufacturer</dt>
                                <dd class="even">
                                    <ol>
                                        <li><a href="#">TheBrand</a> (9)</li>
                                        <li><a href="#">Company</a> (4)</li>
                                        <li><a href="#">LogoFashion</a> (1)</li>
                                    </ol>
                                </dd>
                                <dt class="odd">Color</dt>
                                <dd class="odd">
                                    <ol>
                                        <li><a href="#">Green</a> (1)</li>
                                        <li><a href="#">White</a> (5)</li>
                                        <li><a href="#">Black</a> (5)</li>
                                        <li><a href="#">Gray</a> (4)</li>
                                        <li><a href="#">Dark Gray</a> (3)</li>
                                        <li><a href="#">Blue</a> (1)</li>
                                    </ol>
                                </dd>
                                <dt class="last even">Size</dt>
                                <dd class="last even">
                                    <ol>
                                        <li><a href="#">S</a> (6)</li>
                                        <li><a href="#">M</a> (6)</li>
                                        <li><a href="#">L</a> (4)</li>
                                        <li><a href="#">XL</a> (4)</li>
                                    </ol>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="block block-compare">
                        <div class="block-title ">Compare Products (2)</div>
                        <div class="block-content">
                            <ol id="compare-items">
                                <li class="item odd">
                                    <input type="hidden" value="2173" class="compare-item-id">
                                    <a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#"
                                                                                                     class="product-name">
                                        Retis lapen casen...</a></li>
                                <li class="item last even">
                                    <input type="hidden" value="2174" class="compare-item-id">
                                    <a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#"
                                                                                                     class="product-name">
                                        Retis lapen casen...</a></li>
                            </ol>
                            <div class="ajax-checkout">
                                <button type="submit" title="Submit" class="button button-compare"><span>Compare</span>
                                </button>
                                <button type="submit" title="Submit" class="button button-clear"><span>Clear</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="custom-slider-wrap">
                        <div class="custom-slider-inner">
                            <div class="home-custom-slider">
                                <div>
                                    <div class="sideoffer-banner">

                                        <a href="#" title="Side Offer Banner">

                                            <img class="hidden-xs"
                                                 src="<?php echo $this->templates_assets ?>images/custom-slide1.jpg"
                                                 alt="Side Offer Banner"></a>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($listProductViewed)): ?>
                    <div class="block block-list block-viewed">
                        <div class="block-title"> Sản phẩm vừa xem</div>
                        <div class="block-content">
                            <ol id="recently-viewed-items">
                                <?php foreach ($listProductViewed as $k => $item): ?>
                                <li class="item <?php echo $k%2 == 0 ? 'odd' : 'event' ?> <?php echo count($listProductViewed) - 1 == $k ? 'last' : '' ?>">
                                    <p class="product-name"><a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a></p>
                                </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div>
                        <div class="featured-add-box">
                            <div class="featured-add-inner"><a href="#"> <img
                                            src="<?php echo $this->templates_assets ?>images/hot-trends-banner.jpg"
                                            alt="f-img"></a>
                                <div class="banner-content">
                                    <div class="banner-text">Electronic's</div>
                                    <div class="banner-text1">20% off</div>
                                    <p>limited time offer</p>
                                    <a href="#" class="view-bnt">Shop now</a></div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
<?php endif; ?>