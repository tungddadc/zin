<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 16/03/2018
 * Time: 5:26 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    if (!empty($oneItem)):
    $banner = !empty($oneItem->banner) ? json_decode($oneItem->banner) : [];
//    dd(get_defined_vars());
?>
    <?php if (!empty($banner)) : ?>
    <div class="category-banner-slider">


        <div id="category-desc-slider" class="owl-carousel owl-theme">
            <?php foreach ($banner as $item): ?>
                <!-- Item -->
                <div class="item">
                    <a href="javascript:;" title="<?php echo getTitle($oneItem) ?>">
                        <img alt="<?php echo getTitle($oneItem) ?>"
                             src="<?php echo getImageThumb($item, '', '',false,true) ?>">
                    </a>
                </div>
                <!-- End Item -->
            <?php endforeach; ?>
        </div>
        <?php if (!empty($list_category_child)) : ?>
        <div id="list-cat" class="owl-carousel owl-theme">
            <?php foreach ($list_category_child as $item) : ?>
            <div class="item">
                <div class="cat-icon">
                    <a href="<?php echo getUrlCateProduct($item); ?>" title="<?php echo $item->title; ?>">
                        <img alt="<?php echo $item->title; ?>" src="<?php echo getImageThumb($item->thumbnail,'56','56',true,false); ?>" >
                    </a>
                </div>
                <div class="cat-title">
                    <h4>
                        <a href="<?php echo getUrlCateProduct($item); ?>" title="<?php echo $item->title; ?>">
                            <?php echo $item->title; ?>
                        </a>
                    </h4>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <section class="main-container">
        <div class="container">
            <div class="row">
                <?php echo form_open('') ?>
                <div class="col-xs-12">
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs">
                        <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                    </div>
                    <!-- Breadcrumbs End -->
                    <div class="page-title">
                        <h2 class="page-heading"><?php echo $oneItem->title ?></h2>
                    </div>

                    <article id="content_ajax" class="col-main">
                        <div class="toolbar">
                            <div class="display-product-option clear-after">
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
                        <div class="category-products">
                            <?php $this->load->view($this->template_path . 'product/_list_product', ['data' => $data]) ?>
                        </div>
                    </article>

					<div class="page-title">
						<?php echo $oneItem->content ?>
					</div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
    <script>
        var urlCurrentMenu = '<?php echo !empty($oneParent) ? getUrlCateProduct($oneParent) : '' ?>';
    </script>
<?php endif; ?>
