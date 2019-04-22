<div class="widget widget-ask">
  <form action="#">
    <textarea name="question" class="form-control" rows="5"></textarea>
    <div class="submit">
      <a id="spanImg" href="javascript:;"><i class="iconask-pic"></i>Gửi ảnh</a>
      <input type="file" name="thumbnail" style="display: none">
      <input type="submit" value="GỬI">
    </div>
  </form>
</div>
<div class="widget newquestion">
    <h4>Câu hỏi mới nhất</h4>
    <a href="">
      <h3>mình đăng ký facebook bằng mail yahoo ..mail vẫn</h3>
      <div>
        <img width="20" height="20" src="https://graph.facebook.com/564317740572441/picture">

        Trần Quân
        <span>44 phút trước</span>
      </div>
    </a>
    <a href="">
      <h3>Tài khoản facebook của em bị tạm khoá để xác min</h3>
      <div>
        <img width="20" height="20" src="https://lh4.googleusercontent.com/-Duh_s6XEmhI/AAAAAAAAAAI/AAAAAAAAAfM/_13NTozO_Yc/s32-c/photo.jpg">

        Hùng Burberry
        <span>46 phút trước</span>
      </div>
    </a>
    <a href="">
      <h3>ad cho mình hỏi chip helio p60 với helio x30 cái</h3>
      <div>
        <img width="20" height="20" src="https://lh6.googleusercontent.com/-RDSGC6PgNF0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdgVqVlReCKiPymqpud8Ai1CXmA9A/mo/s32-c/photo.jpg">

        Hiếu Nguyễn Quang
        <span>58 phút trước</span>
      </div>
    </a>

</div>
<div class="widget hotweek">
  <h4>Hot nhất tuần</h4>
  <?php
    $list=getFaqFeatured();
    if(!empty($list)) foreach ($list as $key => $item){
      ?>
      <a href="<?php echo getUrlFaq($item) ?>" class="<?php if($key==0) echo 'first-child' ?>">
        <img  src="<?php echo getImageThumb($item->thumbnail,125,70,true) ?>">
        <h3><?php echo $item->title ?>
        </h3>
      </a>
      <?php
    }
  ?>

</div>