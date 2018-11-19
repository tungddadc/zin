<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
  .modal-footer-top-button {
    position: unset !important;
  }
</style>
<div class="m-content">
  <div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__body">
      <!--begin: Search Form -->
      <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
        <div class="row align-items-center">
          <div class="col-xl-8 order-2 order-xl-1">
            <div class="form-group m-form__group row align-items-center">
              <div class="col-md-8">
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
  <div class="modal-dialog" style="width: 70%; max-width: max-content">
    <div class="modal-content">
      <div class="modal-header" style="flex-direction: column">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="title-form">XEM BÌNH LUẬN</h3>
      </div>
      <div class="modal-body form modalbody">

        <div class="comments-container">
          <ul id="comments-list" class="comments-list">
            <li>
              <div class="comment-main-level">
                <!-- Avatar -->
                <div class="comment-avatar"><img
                    src="https://gravatar.com/avatar/412c0b0ec99008245d902e6ed0b264ee?s=80" alt=""></div>
                <!-- Contenedor del Comentario -->
                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name by-author" name="account_id"><a href="#"></a></h6>
                    <span name="created_time"></span>
                  </div>
                  <div class="comment-content" name="content">

                  </div>
                  <div class="ctrl">
                    <a class="smooth reply-btn" data-id="" onclick="repcomments()" style="padding-left: 12px;">Trả
                      lời</a>
                  </div>
                  <form class="form-input form-input2 upload_comments" style="display: none"
                        action="javascript:void(0);" role="form" method="POST" enctype="multipart/form-data">
                        <textarea placeholder="Mời bạn để lại bình luận" class="binhluan" data-id=""
                                  data-product=""></textarea>
                    <div class="fr-photo"></div>
                    <div class="fr-ctrl">

                      <a class="smooth" style="visibility: hidden;">Quy định đăng bình luận</a>
                      <button type="submit" class="smooth send rep_cm">Gửi</button>
                    </div>
                  </form>
                </div>

              </div>
              <!-- Respuestas de los comentarios -->
              <ul class="comments-list reply-list">
              </ul>
            </li>

          </ul>


        </div>
        <!-- nav-tabs-custom -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  var url_ajax_repcomment = '<?php echo site_url('admin/comments/ajax_ListRepCommnet') ?>';
  var url_ajax_rep = '<?php echo site_url('admin/comments/ajax_ListRep') ?>';
</script>