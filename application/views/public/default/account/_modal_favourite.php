
<!-- Popup Love -->
<div class="modal fade popuplove-primary" id="popupAddLove" tabindex="-1" role="dialog" aria-labelledby="popupAddLoveTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupAddLoveTitle">Thêm vào mục yêu thích</h5>
                <button type="button" class="close-popupLove" data-dismiss="modal" aria-label="Close">
                    <span class="lnr lnr-cross"></span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" id="btn-create-love" class="btn btn-love-primary" data-toggle="modal" data-target="#popupCreateLove">Tạo bộ sưu tập</button>
            </div>
        </div>
    </div>
</div>
<!-- Popup Love -->

<!-- Popup Creat Love -->
<div class="modal fade popuplove-primary" id="popupCreateLove" tabindex="-1" role="dialog" aria-labelledby="popupCreateLoveTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupCreateLoveTitle">Tạo bộ sưu tập</h5>
                <button type="button" class="close-popupLove" data-dismiss="modal" aria-label="Close">
                    <span class="lnr lnr-cross"></span>
                </button>
            </div>
            <?php echo form_open('product/ajax_add_collection',array('id' => 'form_add_collection')) ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Tên bộ sưu tập">
                </div>
                <!--<p class="note">Đã tạo tự động được lưu trong thư mục này</p>-->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-love-primary">Tạo bộ sưu tập</button>
                <button type="reset" class="btn btn-love-primary cancel" data-dismiss="modal">Hủy bỏ</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- Popup Create Love -->