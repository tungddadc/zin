<div class="side-banner">
    <img src="<?php echo $this->templates_assets ?>images/side-banner.jpg" alt="banner">
</div>
<div class="custom-slider-wrap">
    <div class="custom-slider-inner">
        <div class="home-custom-slider">
            <div>
                <div class="sideoffer-banner">

                    <a href="#" title="Side Offer Banner">

                        <img class="hidden-xs"
                             src="<?php echo $this->templates_assets ?>images/custom-slide1.jpg"
                             alt="Side Offer Banner"></a>


                </div>
            </div>
        </div>
    </div>
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
<div>
    <div class="featured-add-box">
        <div class="featured-add-inner"><a href="#"> <img
                    src="<?php echo $this->templates_assets ?>images/hot-trends-banner.jpg"
                    alt="f-img"></a>
            <div class="banner-content">
                <div class="banner-text">Electronic's</div>
                <div class="banner-text1">20% off</div>
                <p>limited time offer</p>
                <a href="#" class="view-bnt">Shop now</a></div>
        </div>
    </div>
</div>