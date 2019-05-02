<?php
/**
 * Created by PhpStorm.
 * User: askeyh3t
 * Date: 4/12/2019
 * Time: 9:28 AM
 */
?>
<section class="main-container detail-agc" >
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="breadcrumb"><?php echo $breadcrumb ?></div>
        <h1><?php echo $oneItem->title . ', ' . $oneItem->address ?></h1>
        <div id="maps-location" class="branches-map"></div>
        <div class="content">
          <?php echo $oneItem->content ?>
          <?php
            if(!empty($agencyNear))
              echo $this->load->view($this->template_path . 'agency/list_agency', array('data' => $agencyNear, 'location' => true), true);

          ?>
        </div>
        <div class="clearfix"></div>
        <div class="fb-comments" data-href="<?php echo current_url() ?>" width="100%" data-numposts="5"></div>

        <div class="clearfix"></div>
        <div id="comments" data-id="<?php echo $oneItem->id ?>" class="comment-fr">
          <div class="cmt-head">
            <div class="table">
              <div class="cell">
                <strong>Bình Luận từ hệ thống</strong>
              </div>
              <div class="cell text-right">
                <select name="comment_sort" style="width: 100px">
                  <option>Mới nhất</option>
                  <option>Cũ nhất</option>
                </select>
              </div>
            </div>
          </div>
          <div class="cmt-list"></div>
          <?php if($this->session->userdata('is_logged')): ?>
            <?php echo form_open('agency/ajax_save_comment',['class'=>'form-input form-comment']) ?>
            <input type="hidden" name="account_id" value="<?php echo $this->session->userdata('user_id') ?>">
            <input type="hidden" name="product_id" value="<?php echo $oneItem->id ?>">
            <div class="clearfix">
              <div class="form-group">
                <input type="text" name="name" placeholder="Tên của bạn" value="<?php echo $this->_user_login->fullname ?>" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="email" placeholder="Email" value="<?php echo $this->session->userdata('email') ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <textarea name="content" placeholder="Mời bạn để lại bình luận" class="form-control"></textarea>
            </div>
            <div class="fr-photo"></div>
            <div class="fr-ctrl">
              <button type="submit" class="smooth send send_comment">Gửi bình luận</button>
            </div>
            <?php echo form_close() ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="sidebar">
          <div class="top">
            <ul>
              <li>
                <i class="iconshop-onelocal"></i>&nbsp;Địa chỉ: <?php echo $oneItem->address ?>.
              </li>
              <li>
                <i class="iconshop-open"></i>&nbsp;Giờ mở cửa: <?php echo $oneItem->Open_door ?>.
              </li>
              <li>
                <i class="iconshop-consult"></i>&nbsp;Tư vấn miễn phí: <?php echo $oneItem->hotline ?>.
              </li>
            </ul>
          </div>
          <div class="list-agency__un"><h2>CÁC TIỆN ÍCH Ở CỬA HÀNG, ĐẠI LÝ</h2>
            <ul>
              <li><i class="iconshop-parking"></i>&nbsp;Giữ xe miễn phí</li>
              <li><i class="iconshop-wifi"></i>&nbsp;Wifi miễn phí</li>
              <li><i class="iconshop-guide"></i>&nbsp;Hướng dẫn dùng sản phẩm, tải nhạc, game, app miễn phí</li>
              <li><i class="iconshop-trial"></i>&nbsp;Xem và dùng thử sản phẩm miễn phí</li>
              <li><i class="iconshop-staff"></i>&nbsp;Nhân viên thân thiện, nhiệt tình</li>
              <li>
                <i class="iconshop-return"></i><a href="/chinh-sach-doi-tra-san-pham.html">&nbsp;Đổi trả sản phẩm trong 1
                  tháng</a>
              </li>
              <li>
                <i class="iconshop-guarantee"></i><a href="/chinh-sach-bao-hanh.html">&nbsp;Hỗ trợ bảo hành chính hãng</a>
              </li>
              <li>
                <i class="iconshop-ship"></i><a href="/don-vi-van-chuyen.html">&nbsp;Có giao hàng tận nơi</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script !src="">
  var google_maps_lat = "<?php echo $oneItem->latitude ?>";
  var google_maps_long = "<?php echo $oneItem->longitude ?>";
  var site_name = "<?php echo $oneItem->title . ', ' . $oneItem->address ?>";
  var phone_number = "<?php echo $oneItem->hotline ?>";
  var Open_door = "<?php echo $oneItem->Open_door ?>";
</script>
