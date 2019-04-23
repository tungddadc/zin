<div class="widget widget-ask">
  <form action="<?php echo site_url('faq/add_ask') ?>" class="ask_form" method="post" enctype="multipart/form-data">
    <textarea name="title" class="form-control" rows="5" data-original-title="title"></textarea>
    <div class="submit">
      <a id="spanImg" href="javascript:;"><i class="iconask-pic"></i>Gửi ảnh</a>
      <input type="file" name="thumbnail" accept="image/*" style="display: none">
      <input type="submit" value="GỬI">
    </div>
  </form>
</div>
<div class="widget newquestion">
    <h4>Câu hỏi mới nhất</h4>
  <?php
  $question=getQuestion();
  if(!empty($question)) foreach ($question as $item){
    $account=getUserById($item->account_id);
    ?>
    <a href="<?php echo getUrlQuestion($item) ?>">
      <h3><?php echo $item->title ?></h3>
      <div>
        <img src="<?php echo getImageThumb($account->avatar,20,20,true) ?>">
        <?php echo $account->fullname ?>
        <span><?php echo timeAgo($item->created_time) ?></span>
      </div>
    </a>
    <?php
  }
  ?>


</div>
<div class="widget hotweek">
  <h4>Hot nhất tuần</h4>
  <?php
    $list=getFaqFeatured();
    if(!empty($list)) foreach ($list as $key => $item){
      ?>
      <a href="<?php echo getUrlFaq($item) ?>" class="<?php if($key==0) echo 'first-child' ?>">
        <img  src="<?php echo ($key==0)?getImageThumb($item->thumbnail,300,150,true):getImageThumb($item->thumbnail,125,70,true); ?>">
        <h3><?php echo $item->title ?>
        </h3>
      </a>
      <?php
    }
  ?>

</div>