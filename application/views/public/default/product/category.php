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
                            <div class="row">
                                <?php if(!empty($data_property)) foreach ($data_property as $type => $property):
                                    switch ($type){
                                        case 'color':
                                            $nameProperty = 'Màu sắc';
                                            break;
                                        case 'pattern':
                                            $nameProperty = 'Kiểu loại';
                                            break;
                                        case 'resolution':
                                            $nameProperty = 'Độ phân giải';
                                            break;
                                        case 'machine':
                                            $nameProperty = 'Đời máy';
                                            break;
                                        case 'kind':
                                            $nameProperty = 'Chủng loại';
                                            break;
                                        case 'quality':
                                            $nameProperty = 'Chất lượng';
                                            break;
                                        case 'qc':
                                            $nameProperty = 'Kiểm định chất lượng';
                                            break;
                                        case 'warranty':
                                            $nameProperty = 'Bảo hành';
                                            break;
                                        case 'feature':
                                            $nameProperty = 'Đặc tính sản phẩm';
                                            break;
                                        default:
                                            $nameProperty = '';
                                    }
                                    if(!empty($nameProperty)):
                                        ?>
                                        <div class="col-sm-3 filter filter_<?php echo $type ?>">
                                            <label class="left"><?php echo $nameProperty ?>: </label>
                                            <select name="filter_<?php echo $type ?>" title="<?php echo $nameProperty ?>" class="form-control">
                                                <option value="0">Tất cả</option>
                                                <?php if(!empty($property)) foreach ($property as $item): ?>
                                                    <option value="<?php echo $item->id ?>" <?php echo $this->input->get('filter_'.$type) === $item->id ? 'selected' : '' ?>><?php echo $item->title ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; endforeach; ?>
                                <div class="col-sm-3">
                                    <label class="left"></label>
                                    <a style="    margin-top: 35px;" href="<?php echo getUrlCateProduct($oneItem) ?>" class="btn btn-danger" rel="nofollow" title="Xóa lọc">Xóa tất cả lọc</a>
                                </div>
                            </div>
                        </div>
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
                    <?php $this->load->view($this->template_path . '_block/_sidebar_product') ?>
                </aside>
            </div>
        </div>
    </section>
    <script>
        var urlCurrentMenu = '<?php echo !empty($oneParent) ? getUrlCateProduct($oneParent) : '' ?>';
    </script>
<?php endif; ?>