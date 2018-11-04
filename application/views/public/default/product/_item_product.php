<div class="col-lg-3 col-md-6">
    <div class="item-home-primary">
        <a href="<?php echo getUrlProduct($item); ?>" title="<?php echo getTitle($item, $this->settings) ?>" class="img">
            <img src="<?php echo getImageThumb($item->thumbnail, 270, 356); ?>" alt="<?php echo getTitle($item, $this->settings) ?>">
            <div class="bg-black"><span>Chi tiết</span></div>
        </a>
        <a href="javascript:;" data-id="<?php echo $item->id ?>" class="icon-love"><i class="lnr lnr-heart"></i></a>
        <h3 class="title">
            <a href="<?php echo getUrlProduct($item); ?>" title="<?php echo getTitle($item, $this->settings) ?>"><?php echo $item->title ?></a>
            <div class="info-absolute">
                <span><i class="lnr lnr-download"></i><?php echo $item->total_download ?></span>
                <span><i class="lnr lnr-heart"></i><?php echo $item->total_favourite ?></span>
            </div>
        </h3>
    </div>
</div>