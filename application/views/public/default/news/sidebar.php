<aside class="sidebar col-sm-3 col-xs-12 ">
  <div class="widget_wrapper13" id="secondary" role="complementary">
    <div class="popular-posts widget widget__sidebar widget__event wow bounceInUp animated" id="recent-posts-4">
      <h3 class="widget-title"><span>Sự kiện</span></h3>
      <div class="widget-content">
        <?php
        $list_post = getPostByCatNews('event', 2);
        if (!empty($list_post)) foreach ($list_post as $item):
          ?>
          <div class="item">
            <div class="date">
              <?php echo date('m/y', strtotime($item->date_event)) ?>
            </div>
            <div class="info">
              <h3><?php echo $item->title ?></h3>
              <div class="location"><i class="fa fa-map-marker"
                                       aria-hidden="true"></i> <?php echo $item->address_event ?></div>
            </div>
          </div>
        <?php
        endforeach;
        ?>
      </div>
      <!--widget-content-->
    </div>
    <div class="popular-posts widget widget_categories widget_product_new wow bounceInUp animated" id="categories-2">
      <h3 class="widget-title"><span>Sản phẩm mới</span></h3>
      <div class="widget-content">
        <?php
        $listProduct = getProductNew();
        if (!empty($listProduct)) foreach ($listProduct as $item) {
          ?>
          <div class="item">
            <div class="img">
              <a href="<?php echo getUrlProduct($item) ?>">
                <img src="<?php echo getImageThumb($item->thumbnail, 105, 105, false) ?>"
                     alt="<?php echo $item->title ?>">
              </a>
            </div>
            <div class="info">
              <a href="<?php echo getUrlProduct($item) ?>">
                <h3><?php echo $item->title ?></h3>
              </a>
              <div class="price">
                <?php echo formatMoney($item->price) ?>
              </div>
              <?php
              if (!empty($post_related)) {
                $count = count(json_decode($item->post_related));
                echo '<div class="count_news">' . $count . ' bài viết</div>';
              }
              ?>

            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
    <!-- Banner Ad Block -->

    <div class="popular-posts widget widget_categories widget_sale wow bounceInUp animated" id="categories-3">
      <h3 class="widget-title"><span>Khuyến mại</span></h3>
      <div class="widget-content">
        <?php
        $list_post = getPostByCatNews('sale', 5);
        if (!empty($list_post)) foreach ($list_post as $key => $item) {
          $img = ($key == 0) ? getImageThumb($item->thumbnail, 570, 320,true) : getImageThumb($item->thumbnail, 280, 150,true);
          ?>
          <div class="item">
            <div class="img">
              <a href="<?php echo getUrlNews($item) ?>" title="<?php echo $item->title ?>">
                <img src="<?php echo $img ?>" alt="<?php echo $item->title ?>">
              </a>
              <a href="<?php echo getUrlNews($item) ?>" title="<?php echo $item->title ?>">
                <h3><?php echo $item->title ?></h3>
              </a>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>

  </div>
</aside>