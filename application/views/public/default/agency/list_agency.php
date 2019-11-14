<ul>
  <?php if (!empty($data)) foreach ($data as $item): ?>
    <li class="agency-items">
	    <h3 class="agency-name">
	        <a href="<?php echo getUrlAgency($item) ?>">
	            <?php echo $item->title ?>
	        </a>
	    </h3>
	    <div class="agency-info">
	        <i class="fa fa-map-marker"></i> <?php echo $item->address ?>
	        <?php if((!empty($location))): ?><span>(<?php echo round($item->distance,2) ?> km)</span><?php endif; ?>
	    </div>
	    <div class="agency-info">
	        <i class="fa fa-clock-o"></i> <?php echo $item->Open_door ?>
	    </div>
	    <div class="agency-info">
	        <i class="fa fa-phone"></i> <?php echo $item->hotline ?>
	    </div>
    </li>
  <?php endforeach; ?>
</ul>