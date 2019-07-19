<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/30/2018
 * Time: 1:10 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>
                                            Trạng thái:
                                        </label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select" name="is_status">
                                            <option value="">
                                                All
                                            </option>
                                            <option value="1">
                                                Hoạt động
                                            </option>
                                            <option value="0">
                                                Hủy
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>
                                            Danh mục:
                                        </label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select filter_category" name="filter_category" style="width: 100%"></select>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="<?php echo site_admin_url('product/export_excel') ?>" class="btn btn-default m-btn m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <i class="fa fa-file-excel-o"></i>
                                <span>
                                    Export
                                </span>
                            </span>
                        </a>
                        <a href="javascript:;" class="btn btn-primary m-btn m-btn--icon m-btn--air m-btn--pill btnAddForm">
                            <span>
                                <i class="la la-plus"></i>
                                <span>
                                    Add
                                </span>
                            </span>
                        </a>
                        <a href="javascript:;" class="btn btn-danger m-btn m-btn--icon m-btn--air m-btn--pill btnDeleteAll">
                            <span>
                                <i class="la la-remove"></i>
                                <span>
                                    Delete
                                </span>
                            </span>
                        </a>
                        <!--<a href="javascript:;" class="btn btn-info m-btn m-btn--icon m-btn--air m-btn--pill btnReload">
                            <span>
                                <i class="la la-refresh"></i>
                                <span>Refresh</span>
                            </span>
                        </a>-->
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="m_datatable" id="ajax_data"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="formModalLabel">Form</h3>
            </div>
            <div class="modal-body">
                <?php echo form_open('',['id'=>'','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed m-form--state']) ?>
                <input type="hidden" name="id" value="0">
                <div class="m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#tab_language" role="tab" aria-selected="true">
                                        <i class="la la-language"></i>Nội dung SEO
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_info" role="tab" aria-selected="false">
                                        <i class="la la-info"></i>Thông tin
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_property" role="tab" aria-selected="false">
                                        <i class="la la-info"></i>Thuộc tính sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab_language" role="tabpanel">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-tools">
                                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                                            <?php if(!empty($this->config->item('language_name'))) foreach ($this->config->item('language_name') as $lang_code => $lang_name): ?>
                                                <li class="nav-item m-tabs__item">
                                                    <a class="nav-link m-tabs__link <?php echo ($lang_code === $this->config->item('language_default')) ? 'active show' : ''?>" data-toggle="tab" href="#tab_<?php echo $lang_code;?>" role="tab" aria-selected="true">
                                                        <img src="<?php echo $this->templates_assets.'images/flag/'.$lang_code.'.png' ?>" alt="<?php echo $lang_name;?>">
                                                        <?php echo $lang_name ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div class="tab-content">
                                        <?php if(!empty($this->config->item('language_name'))) foreach ($this->config->item('language_name') as $lang_code => $lang_name): ?>
                                            <div class="tab-pane <?php echo ($lang_code === $this->config->item('language_default')) ? 'active show' : '';?>" id="tab_<?php echo $lang_code;?>" role="tabpanel">
                                                <div class="m-portlet__body">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Tiêu đề</label>
                                                                <input name="language[<?php echo $lang_code;?>][title]" placeholder="Tiêu đề (<?php echo $lang_name ?>)" class="form-control" type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tóm tắt</label>
                                                                <textarea name="language[<?php echo $lang_code;?>][description]" placeholder="Tóm tắt (<?php echo $lang_name ?>)" class="form-control" rows="5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nội dung</label>
                                                                <textarea name="language[<?php echo $lang_code;?>][content]" class="form-control tinymce"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-xs-12">
                                                            <?php $this->load->view($this->template_path.'_block/seo_meta',['lang_code'=>$lang_code]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Danh mục:</label>
                                            <div class="input-group">
                                                <select name="category_id[]" class="form-control m-select2 category" style="width: 100%;"></select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Thương hiệu:</label>
                                            <div class="input-group">
                                                <select name="brand" class="form-control m-select2 brand" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mã sản phẩm</label>
                                            <input name="model" placeholder="Mã sản phẩm" class="form-control" type="text" />
                                        </div>
                                        <div class="form-group row">
                                            <!--<div class="col">
                                                <label>Số lượng</label>
                                                <input name="quantity" placeholder="Số lượng" value="0" class="form-control" type="text" />
                                            </div>-->
                                            <div class="col">
                                                <label>Giá gốc</label>
                                                <input name="price" placeholder="Giá gốc" class="form-control" type="text" />
                                            </div>
                                            <div class="col">
                                                <label>Giá khuyến mại</label>
                                                <input name="price_sale" placeholder="Giá khuyến mại" class="form-control" type="text" />
                                            </div>

                                            <div class="col">
                                                <label>Giá đại lý</label>
                                                <input name="price_agency" placeholder="Giá đại lý" class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                        <!--<fieldset class="form-group agency-container">
                                            <legend>Giá cho đại lý</legend>
                                            <div class="quantity-range">
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label>Số lượng đến:</label>
                                                        <input name="data_detail[0][total_qty]" placeholder="Số lượng đến" class="form-control" type="text" />
                                                    </div>
                                                    <div class="col">
                                                        <label>Mức giá</label>
                                                        <input name="data_detail[0][price_agency]" placeholder="Mức giá cho số lượng này" class="form-control" type="text" />
                                                    </div>
                                                    <a href="javascript:;" title="Xoá dòng này" class="text-danger btn-remove"><i class="fa fa-remove"></i></a>
                                                </div>
                                            </div>
                                            <div class=" text-center">
                                                <button type="button" class="btn btn-info btn-add-agency">Thêm khoảng giá cho đại lý</button>
                                            </div>
                                        </fieldset>-->
                                        <div class="m-separator m-separator--dashed m-separator--lg"></div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Nổi bật:</label>
                                                <div class="m-input">
                                                    <input data-switch="true" type="checkbox" name="is_featured" class="switchBootstrap">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label>Trạng thái:</label>
                                                <div class="m-input">
                                                    <input data-switch="true" type="checkbox" name="is_status" class="switchBootstrap" checked="checked">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row option-price">
                                            <div class="col">
                                                <label>Giá Buôn:</label>
                                                <div class="input-group">
                                                    <select id="item-price" name="is_disable_price">
                                                      <option value="0">Show Giá</option>
                                                      <option value="1">Ẩn Giá</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Sản phẩm cùng loại khác màu:</label>
                                            <div class="input-group">
                                                <select name="data_similar[]" class="form-control m-select2 data_similar" style="width: 100%;"></select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Linh kiện liên quan:</label>
                                            <div class="input-group">
                                                <select name="data_related[]" class="form-control m-select2 data_related" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                      <div class="form-group">
                                        <label>Bài viết liên quan:</label>
                                        <div class="input-group">
                                          <select name="post_related[]" class="form-control m-select2 post_related" style="width: 100%;"></select>
                                        </div>
                                      </div>
                                        <div class="form-group">
                                            <label for="thumbnail">Ảnh đại diện</label>
                                            <div class="input-group m-input-group m-input-group--air">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="input_thumbnail">
                                                        <i class="la la-picture-o"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="thumbnail" onclick="FUNC.chooseImage(this)" class="form-control m-input chooseImage" placeholder="Click để chọn ảnh" aria-describedby="input_thumbnail">
                                            </div>
                                            <div class="alert m-alert m-alert--default preview text-center mt-1" role="alert">
                                                <img width="100" height="100" src="<?php echo getImageThumb('',100,100) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="thumbnail">Album sản phẩm</label>
                                            <div class="alert m-alert m-alert--default preview text-center mt-1" role="alert">
                                                <div data-id="0" id="list-album"></div>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-primary btnAddMore" onclick="FUNC.chooseMultipleImage(this)">
                                                        <i class="fa fa-plus"> Thêm ảnh </i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_property" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Màu sắc:</label>
                                            <div class="input-group">
                                                <select name="property_id[color][]" class="form-control m-select2 property_color" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kiểu loại:</label>
                                            <div class="input-group">
                                                <select name="property_id[pattern][]" class="form-control m-select2 property_pattern" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Độ phân giải:</label>
                                            <div class="input-group">
                                                <select name="property_id[resolution][]" class="form-control m-select2 property_resolution" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Đời máy:</label>
                                            <div class="input-group">
                                                <select name="property_id[machine][]" class="form-control m-select2 property_machine" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Chủng loại:</label>
                                            <div class="input-group">
                                                <select name="property_id[kind][]" class="form-control m-select2 property_kind" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Chất lượng:</label>
                                            <div class="input-group">
                                                <select name="property_id[quality][]" class="form-control m-select2 property_quality" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kiểm định chất lượng QC:</label>
                                            <div class="input-group">
                                                <select name="property_id[qc][]" class="form-control m-select2 property_qc" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bảo hành:</label>
                                            <div class="input-group">
                                                <select name="property_id[warranty][]" class="form-control m-select2 property_warranty" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Đặc tính sản phẩm:</label>
                                            <div class="input-group">
                                                <select name="property_id[feature][]" class="form-control m-select2 property_feature" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnSave">Submit</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var url_ajax_load_category = '<?php echo site_admin_url('category/ajax_load/' . $this->_controller) ?>',
        url_ajax_load_property = '<?php echo site_admin_url('property/ajax_load') ?>',
        url_ajax_load_brand = '<?php echo site_admin_url('category/ajax_load/brand') ?>',
        url_ajax_load_product = '<?php echo site_admin_url('product/ajax_load') ?>',
        url_ajax_load_post= '<?php echo site_admin_url('post/ajax_load') ?>';
</script>