<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 16/03/2018
 * Time: 5:26 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if (!empty($oneItem)):
    ?>
    <div class="heading-poster">
        <div class="container">
            <div class="content">
                <h2 class="title">
                    Dẫn đầu lĩnh vực thiết kế với thư viện lên đến 2,000,000 ảnh, vector, video
                    <span>1 triệu người dùng đăng nhập thường xuyên</span>
                </h2>
                <div class="cart-primary">
                    <a href="<?php echo base_url('cart') ?>" title="Giỏ hàng">
                        <i class="icon_bag_alt"></i>
                        <span>giỏ hàng</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="ads-primary">
        <div class="container">
            <a href="" title=""><img src="<?php echo $this->templates_assets ?>images/ads1.jpg" alt=""></a>
        </div>
    </div>
    <?php echo form_open(getUrlSearch($oneItem), array('method' => 'GET','id' => 'filter_category')) ?>
    <input type="hidden" name="search_category_id" value="<?php echo $this->input->get('search_category_id') ?>">
    <div id="content_ajax_html">
        <div id="to_anchor" class="info-poster-cate">
            <div class="container">
                <p>
                    <strong>Tìm kiếm từ khóa</strong>:
                    <a href="<?php echo getUrlSearch($oneItem) ?>" title="<?php echo $oneItem->title ?>"><strong><?php echo $oneItem->title ?></strong></a>
                    <span>Hiển thị <strong><?php echo !empty($total) ? $total : 0 ?></strong> kết quả</span>
                </p>
                <div class="item">
                    <b>Định dạng:</b>
                    <ul>
                        <li>
                            <div class="check_box">
                                <div class="checkboxFive">
                                    <input type="checkbox" value="0" id="checkboxFiveInputAll" name="filter_format" <?php echo empty($this->input->get('filter_format'))? 'checked' : ''  ?>>
                                    <label for="checkboxFiveInputAll"></label>
                                </div>
                                <span>Tất cả</span>
                            </div>
                        </li>
                        <?php if(!empty($property_format)) foreach ($property_format as $item): ?>
                            <li>
                                <div class="check_box">
                                    <div class="checkboxFive">
                                        <input type="checkbox" value="<?php echo $item->id ?>" <?php echo !empty($this->input->get('filter_format')) && in_array($item->id,$this->input->get('filter_format')) ? 'checked' :'' ?> id="checkboxFiveInput<?php echo $item->id ?>" name="filter_format[]">
                                        <label for="checkboxFiveInput<?php echo $item->id ?>"></label>
                                    </div>
                                    <span><?php echo $item->title ?></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="filter-poster-cate">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="filter-select">
                            <div class="form-group">
                                <select name="filter_type" class="form-control">
                                    <option value="0">Loại ảnh</option>
                                    <?php if(!empty($property_type)) foreach ($property_type as $item): ?>
                                        <option value="<?php echo $item->id ?>" <?php echo $item->id == $this->input->get('filter_type')? 'selected' : ''  ?>><?php echo $item->title ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="icon-select arrow_carrot-down"></span>
                            </div>
                            <div class="form-group">
                                <select name="filter_color" class="form-control">
                                    <option value="0">Màu sắc</option>
                                    <?php if(!empty($property_color)) foreach ($property_color as $item): ?>
                                        <option value="<?php echo $item->id ?>" <?php echo $item->id == $this->input->get('filter_color')? 'selected' : ''  ?>><?php echo $item->title ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="icon-select arrow_carrot-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="filter-cate filter-sort">
                            <span>Sắp xếp theo:</span>
                            <input type="hidden" name="filter_sort" value="newest">
                            <ul>
                                <li class="<?php echo ($this->input->get('filter_sort') === 'newest' || $this->input->get('filter_sort') === null) ? 'active' : '' ?>"><a data-value="newest" href="javascript:;" title="Mới nhất">Mới nhất</a></li>
                                <li class="<?php echo ($this->input->get('filter_sort') === 'most_download') ? 'active' : '' ?>"><a data-value="most_download" href="javascript:;" title="Tải nhiều nhất">Tải nhiều nhất</a></li>
                                <li class="<?php echo ($this->input->get('filter_sort') === 'most_favourite') ? 'active' : '' ?>"><a data-value="most_favourite" href="javascript:;" title="Yêu thích nhất">Yêu thích nhất</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="filter-pagi">
                            <div class="number">
                                <b><?php echo !empty($page) ? $page : 1 ?></b>/<span><?php echo !empty($total) ? ceil($total/$limit) : 0 ?></span>
                            </div>
                            <div class="nav">
                                <a href="javascript:;" title="Trang trước" data-url="<?php echo getUrlSearch($oneItem) ?>" class="btnPrevPage"><i class="arrow_triangle-left"></i></a>
                                <a href="javascript:;" title="Trang tiếp" data-url="<?php echo getUrlSearch($oneItem) ?>" class="btnNextPage"><i class="arrow_triangle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-item-primary">
            <div class="container">
                <div class="row">
                    <?php if(!empty($data)) foreach ($data as $item): ?>
                        <?php $this->load->view($this->template_path . "product/_item_product", array('item' => $item)) ?>
                    <?php endforeach;else echo "<div class='text-center col-md-12'>".lang('text_data_empty')."</div>"; ?>
                </div>
                <div class="pagination-primary">
                    <?php echo !empty($pagination) ? $pagination : '' ?>
                    <?php if(!empty($total) && $total > $limit): ?>
                        <div class="goto-page">
                            Tới trang
                            <input type="text" class="form-control" value="<?php echo !empty($page) ? $page : 1 ?>">
                            <button data-url="<?php echo getUrlSearch($oneItem) ?>" class="btn btnGoToPage">OK</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
    <div class="ads-primary">
        <div class="container">
            <a href="" title=""><img src="<?php echo $this->templates_assets ?>images/ads2.jpg" alt=""></a>
        </div>
    </div>
    <?php $this->load->view($this->template_path . '_block/block_faqs') ?>
<?php endif; ?>