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
                            <div class="col-md-6">
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
                                            <option value="2">
                                                Chờ duyệt
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
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
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
                                    <input name="name" placeholder="Tên người đánh giá" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" placeholder="Email" class="form-control" type="email" />
                                </div>

                                <div class="form-group">
                                    <label>Bình luận</label>
                                    <textarea name="message" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Thành viên</label>
                                    <div class="input-group">
                                        <select name="user_id" class="form-control m-select2" style="width: 100%;"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Đánh giá</label>
                                    <input name="vote" class="form-control" type="number" max="5" min="1" />
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái:</label>
                                    <div class="m-input">
                                        <input data-switch="true" type="checkbox" name="is_status" class="switchBootstrap" checked="checked">
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
    var url_ajax_load_user = '<?php echo site_url('admin/user/ajax_load') ?>';
</script>