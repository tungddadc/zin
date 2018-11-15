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

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width: 100%; max-width: 850px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="title-form">Chi tiết đơn hàng</h3>
      </div>
      <div class="modal-body form">
        <form id="form">

          <table class="table">
            <tr>
              <th><?php echo lang('col_firstname'); ?> :</th>
              <td id="fullname"></td>
            </tr>
            <tr>
              <th>Địa chỉ nhận hàng :</th>
              <td id="address"></td>
            </tr>
            <tr>
              <th>Số điện thoại :</th>
              <td id="phone"></td>
            </tr>
            <tr>
              <th>Email :</th>
              <td id="email"></td>
            </tr>
            <tr>
              <th><?php echo lang('col_total_amount'); ?> :</th>
              <td id="total_amount"></td>
            </tr>
            <tr>
              <th>Mã đơn hàng :</th>
              <td id="code"></td>
            </tr>
            <tr>
              <th>Ngày giao hàng :</th>
              <td>
                <input type="hidden" name="id" value="">
                <div class="input-group">
                  <input name="shipped_time" placeholder="Ngày hiển thị" class="form-control datepicker" type="text">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th><?php echo lang('col_created_or_at'); ?> :</th>
              <td id="created_time"></td>
            </tr>
            <tr>
              <th>Mã giảm giá :</th>
              <td id="voucher_id"></td>
            </tr>
            <tr>
              <th>Gía trị mã giảm giá :</th>
              <td id="total_voucher"></td>
            </tr>
            <tr>
              <th>Đơn hàng chuyển về : </th>
              <td id="is_status_sendmail"></td>
            </tr>
            <tr>
              <th>Trạng thái đơn hàng :</th>
              <td>
                <select class="form-control" name="is_status">
                  <option value="">Lựa chọn</option>
                  <option value="1">Đơn hàng chờ xử lý</option>
                  <option value="2">Chờ thanh toán</option>
                  <option value="3">Xác nhận đơn hàng</option>
                  <option value="0">Đã hủy đơn hàng</option>
                </select>
              </td>

            </tr>
            <?php if ($this->session->userdata['admin_group_id']==1 || $this->session->userdata['admin_group_id']==19): ?>
              <tr>
                <th>Công việc giao sale : </th>
                <td>
                  <select name="users_sale" class="form-control">
                    <option value="">Lựa chọn nhân viên sale</option>
                    <?php  if(!empty($list_sale)) foreach ($list_sale as $value):?>
                      <option value="<?php echo $value->user_id ?>" ><?php echo $value->username ?></option>
                    <?php endforeach;?>
                  </select>
                </td>
              </tr>
            <?php endif; ?>
            <tr>
              <th>Note:</th>
              <td id="note"></td>
            </tr>
          </table>
        </form>

        <style>
          table.list-detail th,table.list-detail tr td{text-align: center}
        </style>
        <table class="table list-detail">
          <thead>
          <tr style="background:orange;color: #fff">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
            <th>Lựa chọn</th>
          </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary pull-left"><?php echo lang('btn_save');?></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('btn_cancel');?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
  var url_ajax_list = '<?php echo site_url('admin/order/ajax_list')?>',
    url_ajax_view = '<?php echo site_url('admin/order/ajax_view')?>',
    url_ajax_update = '<?php echo site_url('admin/order/ajax_update')?>',
    url_ajax_add = '<?php echo site_url('admin/order/ajax_add')?>',
    url_ajax_delete = '<?php echo site_url('admin/order/ajax_delete')?>';
  url_ajax_remove_item = '<?php echo site_url('admin/order/ajax_removeItem')?>';
</script>