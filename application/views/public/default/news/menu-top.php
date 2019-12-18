<div class="top-news">
  <ul>
<!--    <li><a href="--><?php //echo site_url('tin-moi.html') ?><!--">Tin mới</a></li>-->
    <?php
      $listCats=getCategoryByType(0,'post');
      if(!empty($listCats)) foreach ($listCats as $item){
        echo '<li><a href="'.getUrlCateNews($item).'">'.$item->title.'</a></li>';
      }
    ?>
  </ul>
</div>