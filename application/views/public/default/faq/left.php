<div class="widget left-widget">
  <h3>CHỦ ĐỀ NỔI BẬT</h3>
  <ul>
    <?php
      $listCat=getCategoryByType(0,'faq');
      if(!empty($listCat)) foreach ($listCat as $item):
    ?>
    <li>
      <a href="<?php echo getUrlCateFaq($item) ?>"><i class="<?php echo $item->class ?>"></i><?php echo $item->title ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>