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

<div class="modal fade" id="modal_form" tabindex="-1"  role="dialog" aria-labelledby="formModalLabel" aria-hidden="true"
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
            <div class="tab-content">
              <div class="tab-pane active" id="tab_info" role="tabpanel">
                <div class="form-group">
                  <label>Mã voucher</label>
                  <div class="input-group">

                    <input name="code" placeholder="Mã voucher" class="form-control generator_code" type="text"/>
                    <div class="input-group-addon" style="padding: 0">
                      <button class="generator btn btn-primary" type="button">Tạo mã</button>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Giá trị(Nếu là giảm theo % thì nhập: 20%)</label>
                      <input type="text" name="value" class="form-control" placeholder="Giá trị khuyến mãi">
                    </div>
                    <div class="col-md-6">
                      <label>Người sử dụng</label>
                      <select name="user_use" class="form-control m-select2 user_use" style="width: 100%"></select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Áp dụng từ ngày</label>
                      <input type="date" name="start_time" class="form-control" placeholder="Áp dụng từ ngày ">
                    </div>

                    <div class="col-md-6">
                      <label>Đến ngày</label>
                      <input type="date" name="end_time" class="form-control" placeholder="Ngày hết hạn">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Trạng thái</label>
                      <select name="is_status" class="form-control">
                        <option value="1">Hoạt động</option>
                        <option value="2">Hủy</option>
                        <option value="3">Hết hạn</option>
                      </select>
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
<script>
  var url_ajax_load = '<?php echo site_url('admin/category/ajax_load') ?>';
  var ajax_check_code = '<?php echo site_url('admin/voucher/ajax_check_code') ?>';
  var url_ajax_load_user = '<?php echo site_url('admin/user/ajax_load') ?>';
</script>