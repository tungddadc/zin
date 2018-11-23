<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/30/2018
 * Time: 1:10 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">

                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="javascript:;"
                           class="btn btn-primary m-btn m-btn--icon m-btn--air m-btn--pill btnAddForm">
              <span>
                  <i class="la la-plus"></i>
                  <span>
                      Add
                  </span>
              </span>
                        </a>
                        <a href="javascript:;"
                           class="btn btn-danger m-btn m-btn--icon m-btn--air m-btn--pill btnDeleteAll">
              <span>
                <i class="la la-remove"></i>
                <span>
                    Delete
                </span>
              </span>
                        </a>
                        <a href="javascript:;" class="btn btn-info m-btn m-btn--icon m-btn--air m-btn--pill btnReload">
                            <span>
                                <i class="la la-refresh"></i>
                                <span>Refresh</span>
                            </span>
                        </a>
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

<div class="modal fade" id="modal_form" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg" role="document" style="max-width:690px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="formModalLabel">Form</h3>
            </div>
            <div class="modal-body">
                <?php echo form_open('', ['id' => '', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed m-form--state']) ?>
                <input type="hidden" name="id" value="0">
                <div class="m-portlet--tabs">
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input name="name" placeholder="Tên người Feedback" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>Công ty</label>
                                    <input name="company" placeholder="Tên công ty" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea name="content" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái:</label>
                                    <div class="m-input">
                                        <input data-switch="true" type="checkbox" name="is_status" class="switchBootstrap" checked="checked">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
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
<script>
    var url_ajax_load = '<?php echo site_url('admin/category/ajax_load') ?>';
    var ajax_check_code = '<?php echo site_url('admin/voucher/ajax_check_code') ?>';
    var url_ajax_load_user = '<?php echo site_url('admin/user/ajax_load') ?>';
</script>