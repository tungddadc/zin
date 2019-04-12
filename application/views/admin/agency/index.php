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
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%">
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
                  <label>Tên đại lý</label>
                  <input name="title" placeholder="Tên đại lý" class="form-control" type="text"/>
                </div>
                <div class="form-group">
                  <label>Tỉnh/Thành phố</label>
                  <select name="city_id" class="select2 form-control"  style="width: 100%"></select>
                </div>
                <div class="form-group">
                  <label>Quận huyện</label>
                  <select name="district_id" class="select2 form-control" style="width: 100%"></select>
                </div>
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input name="address" placeholder="Địa chỉ" class="form-control" type="text"/>
                </div>

                <div class="form-group">
                  <label>Kinh độ</label>
                  <input name="longitude" placeholder="Kinh độ" class="form-control" type="text"/>
                </div>
                <div class="form-group">
                  <label>Vĩ độ</label>
                  <input name="latitude" placeholder="Vĩ độ" class="form-control" type="text"/>
                </div>
                <div class="form-group">
                  <label>Giờ mở cửa</label>
                  <input name="Open_door" placeholder="Giờ mở cửa" class="form-control" type="text"/>
                </div>
                <div class="form-group">
                  <label>Hotline</label>
                  <input name="hotline" placeholder="Hotline" class="form-control" type="text"/>
                </div>
                <div class="form-group">
                  <label>Trạng thái:</label>
                  <div class="m-input">
                    <input data-switch="true" type="checkbox" name="is_status" class="switchBootstrap"
                           checked="checked">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
<!--                <div class="form-group">-->
<!--                  <label>Tiện ích</label>-->
<!--                  <textarea name="utilities" class="form-control tinymce" rows="5"></textarea>-->
<!--                </div>-->
                <div class="form-group">
                  <label>Nội dung</label>
                  <textarea name="content" class="form-control tinymce" rows="5"></textarea>
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
<script !src="">
  var url_ajax_city = '<?php echo site_url('admin/location/ajax_load_city') ?>';
  var url_ajax_district = '<?php echo site_url('admin/location/ajax_load_district') ?>';

</script>