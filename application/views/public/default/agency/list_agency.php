<h2><?php echo (!empty($location))?'DANH SÁCH CỬA HÀNG, ĐẠI LÝ GẦN ĐÂY':'DANH SÁCH CỬA HÀNG, ĐẠI LÝ'; ?></h2>
<ul>
  <?php if (!empty($data)) foreach ($data as $item): ?>
    <li>
      <a href="<?php echo getUrlAgency($item) ?>"><?php echo $item->title ?>, <?php echo $item->address ?> <?php if((!empty($location))): ?><span>(<?php echo round($item->distance,2) ?> km)</span><?php endif; ?></a>
    </li>
  <?php endforeach; ?>
</ul>