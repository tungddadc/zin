<?php if (!empty($oneItem)):
  $url = getUrlPage($oneItem);
  ?>
  <div class="clearfix"></div>
  <!-- Main Container -->
  <section class="main-container" style="margin-top: 0">
    <div class="container">
      <div class="top-agency">
        <img width="100%" src="<?php echo !empty($oneItem->banner)?getImageThumb($oneItem->banner): $this->templates_assets.'images/background_sieu_thi_large.jpg'; ?>"
             alt="Hệ thống siêu thị">
        <div class="top-agency__abs">
          <ul>
            <li>
              <b><?php echo $this->settings['total_agency'] ?></b> CỬA HÀNG
              <p>Trên toàn quốc</p>
            </li>
            <li>
              <b><?php echo $this->settings['serve_customer'] ?></b> KHÁCH
              <p>được phục vụ mỗi ngày</p>
            </li>
            <li>
              <b><?php echo $this->settings['open_door'] ?></b> MỞ CỬA
              <p>kể cả chủ nhật & ngày lễ</p>
            </li>
          </ul>
        </div>
      </div>
      <div class="main-agency">
        <form action="#" class="form_filter">
          <h2>TÌM CỬA HÀNG, ĐẠI LÝ</h2>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select name="city_id" class="form-control select2"></select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select name="district_id" class="form-control select2"></select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="search_key">
                <input type="text" name="text_search" class="form-control"
                       placeholder="Nhập tên đường, tỉnh thành, quận huyện" onkeyup="live_search(this.value)">
                <ul class="result ">
                </ul>
              </div>
            </div>
          </div>
        </form>
        <div class="list-agency">
          <div class="list-agency__title">
            <a href="javascript:;"><i class="fa fa-map-marker" aria-hidden="true"></i> Xem siêu thị gần bạn</a>
          </div>
          <div class="list-agency__content">
            <h2>DANH SÁCH CỬA HÀNG, ĐẠI LÝ</h2>
            <ul>
              <?php if (!empty($data)) foreach ($data as $item): ?>
                <li>
                  <a href="<?php echo getUrlAgency($item) ?>"><?php echo $item->title ?>, <?php echo $item->address ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="list-agency__un">
            <h2>CÁC TIỆN ÍCH Ở CỬA HÀNG, ĐẠI LÝ</h2>
            <ul>
              <li>
                <i class="iconshop-parking"></i>&nbsp;Giữ xe miễn phí
              </li>
              <li>
                <i class="iconshop-wifi"></i>&nbsp;Wifi miễn phí
              </li>
              <li>
                <i class="iconshop-guide"></i>&nbsp;Hướng dẫn dùng sản phẩm, tải nhạc, game, app miễn phí
              </li>
              <li>
                <i class="iconshop-trial"></i>&nbsp;Xem và dùng thử sản phẩm miễn phí
              </li>
              <li>
                <i class="iconshop-staff"></i>&nbsp;Nhân viên thân thiện, nhiệt tình
              </li>
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

            <div class="clearfix"></div>
            <div class="fb-comments" data-href="<?php echo current_url() ?>" width="100%" data-numposts="5"></div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End -->
<?php endif; ?>
<script !src="">
  var ddgannhat='<?php if(!empty($this->input->get('near'))) echo 1 ?>';
</script>
