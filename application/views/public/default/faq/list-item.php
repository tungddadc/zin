<ul class="listask">
  <?php
if(!empty($data)) foreach ($data as $item){
  ?>
  <li>
    <a href="<?php echo getUrlFaq($item) ?>">
      <img class="" alt="<?php echo $item->title ?>" src="<?php echo getImageThumb($item->thumbnail,320,200,true) ?>">
      <h3><?php echo $item->title ?></h3>
      <p><?php echo character_limiter($item->description,100,'...') ?></p>
    </a>
  </li>
  <?php
}
?>
</ul>