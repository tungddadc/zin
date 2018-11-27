<div class="side-banner">
    <?php $bannerSidebarTop = listBannerByPosition(2);if(!empty($bannerSidebarTop)) foreach ($bannerSidebarTop as $item): ?>
        <a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
            <img src="<?php echo getImageThumb($item->thumbnail,265,425) ?>" alt="banner sidebar">
        </a>
    <?php endforeach; ?>
</div>
<?php if(!empty($listProductViewed)): ?>
    <div class="block block-list block-viewed">
        <div class="block-title"> Sản phẩm vừa xem</div>
        <div class="block-content">
            <ol id="recently-viewed-items">
                <?php foreach ($listProductViewed as $k => $item): ?>
                    <li class="item <?php echo $k%2 == 0 ? 'odd' : 'event' ?> <?php echo count($listProductViewed) - 1 == $k ? 'last' : '' ?>">
                        <p class="product-name"><a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
<?php endif; ?>
<div class="side-banner">
    <?php $bannerSidebar = listBannerByPosition(3);if(!empty($bannerSidebar)) foreach ($bannerSidebar as $item): ?>
        <a href="<?php echo $item->url ?>" title="banner center home" rel="nofollow">
            <img class="hidden-xs" src="<?php echo getImageThumb($item->thumbnail,265,500) ?>" alt="banner center home">
        </a>
    <?php endforeach; ?>
</div>
